<?php

use Civi\Api4\Activity;
use Civi\Api4\Contact;
use CRM_Mautic_Connection as MC;
use CRM_Mautic_ExtensionUtil as E;
use CRM_Mautic_Utils as U;

/**
 * Functionality for processing Mautic Webhooks.
 *
 * For each individual trigger event, tries to Match to a contact and creates a webhook entity and/or activity.
 */
class CRM_Mautic_Webhook_Handler extends CRM_Mautic_Webhook {

  /**
   * Get corresponding CiviCRM contact from Mautic contact.
   *
   * @param array $mauticContact
   *
   * @return int|NULL
   */
  public function identifyContact($mauticContact) {
    return CRM_Mautic_Contact_ContactMatch::getCiviContactIDFromMauticContact($mauticContact);
  }

  /**
   * @param array $webhook
   *
   * @throws \CiviCRM_API3_Exception
   */
  public function processEvent($webhook) {
    $data = json_decode($webhook['data'], TRUE);
    // Data may include lead and contact properties - they appear to be the same.
    $contact = $data['contact'] ?? NULL;
    U::checkDebug("webhook trigger", ['id' => $webhook['id'], 'type' => $webhook['webhook_trigger_type']]);
    if (!$webhook['webhook_trigger_type'] || !$contact) {
      U::checkDebug("Processing Mautic webhook: trigger or contact not found exiting.");
      // Use a direct SQL query to bypass hooks (as we don't want to trigger civirules)
      $query = 'UPDATE civicrm_mauticwebhook SET processed_date=%1 WHERE id=%2';
      $queryParams = [
        1 => [date('YmdHis'), 'Timestamp'],
        2 => [$webhook['id'], 'Integer'],
      ];
      CRM_Core_DAO::executeQuery($query, $queryParams);
      return;
    }

    // Don't act on updates being pushed from Civi.
    // We detect this from the connected user, which should be reserved by the extension.
    $modifiedBy = !empty($contact['modifiedBy']) ? $contact['modifiedBy'] : $contact['createdBy'];
    $ignoreTriggersIfCiviModified = ['mautic.lead_post_save_new', 'mautic.lead_post_save_update'];
    if (in_array($webhook['webhook_trigger_type'], $ignoreTriggersIfCiviModified)) {
      $connectedUserId = MC::singleton()->getConnectedUser()['id'] ?? NULL;
      if ($connectedUserId == $contact['id'] || $connectedUserId == $modifiedBy) {
        U::checkDebug("Webhook: " . $webhook['webhook_trigger_type'] . " - Mautic Contact last modified by CiviCRM - no further processing required." );
        $civicrmContactID = CRM_Mautic_Contact_FieldMapping::lookupMauticValue('civicrm_contact_id', $contact);
        if (empty($civicrmContactID)) {
          // This usually happens because a contact on the CiviCRM side has been deleted or merged
          \Civi::log(E::SHORT_NAME)->warning("Mautic Webhook: no CiviCRM contact ID for Mautic contact: " . $contact['id'] . ': ' . $webhook['webhook_trigger_type']);
          return;
        }
        // Use a direct SQL query to bypass hooks (as we don't want to trigger civirules)
        $query = 'UPDATE civicrm_mauticwebhook SET processed_date=%1,contact_id=%3 WHERE id=%2';
        $queryParams = [
          1 => [date('YmdHis'), 'Timestamp'],
          2 => [$webhook['id'], 'Integer'],
          3 => [$civicrmContactID, 'Integer']
        ];
        CRM_Core_DAO::executeQuery($query, $queryParams);
        return;
      }
    }

    $civicrmContactID = $this->identifyContact($contact);
    $activityID = NULL;
    // We have extracted enough information for an action.
    if ($civicrmContactID) {
      // Create an activity for this contact.
      $activityID = $this->createActivity($webhook['webhook_trigger_type'], $civicrmContactID, $webhook['id']);
    }
    else {
      U::checkDebug("Webhook: no matching contact found for trigger: " . $webhook['webhook_trigger_type']);
    }
    $params = [
      'id' => $webhook['id'],
      'contact_id' => $civicrmContactID,
      'activity_id' => $activityID,
      'processed_date' => date('YmdHis'),
    ];
    // Update the Webhook entity to store the data.
    // This will trigger the MauticWebhook in CiviRules.
    civicrm_api3('MauticWebhook', 'create', $params);
  }

  /**
   * Process incoming webhook.
   *
   * @param string $rawData
   *
   * @throws \CiviCRM_API3_Exception
   */
  public function process($rawData) {
    $data = json_decode($rawData, TRUE);
    $triggers = static::getEnabledTriggers();
    foreach ($triggers as $trigger) {
      if (!empty($data[$trigger])) {
        // We received one of the webhook triggers that we have enabled.
        if (!is_array($data[$trigger])) {
          \Civi::log()->error("Mautic: {$trigger} is not an array");
          continue;
        }

        foreach ($data[$trigger] as $item) {
          // Don't process webhooks immediately because Mautic waits for the webhook to complete before continuing
          //   and this makes most batch actions hang quickly.
          civicrm_api3('MauticWebhook', 'create', [
            'data' => json_encode($item),
            'webhook_trigger_type' => $trigger,
          ]);
        }
      }
    }
  }

  /**
   * @param string $trigger
   * @param int $contactID
   * @param int $mauticWebhookEntityID
   *
   * @return int|null
   * @throws \CiviCRM_API3_Exception
   */
  public function createActivity($trigger, $contactID, $mauticWebhookEntityID) {
    // Source contact must exist. For a post_delete webhook that contact ID might not so we use the logged in user.
    if (Contact::get(FALSE)
      ->addWhere('id', '=', $contactID)
      ->execute()->rowCount == 0) {
      $contactID = CRM_Core_Session::getLoggedInContactID();
    }
    $result = Activity::create(FALSE)
      ->addValue('activity_type_id:name', 'Mautic_Webhook_Triggered')
      ->addValue('subject', E::ts('Webhook: %1', [1 => static::getTriggerLabel($trigger)]))
      ->addValue('source_contact_id', $contactID)
      ->addValue('target_contact_id', $contactID)
      ->addValue('status_id:name', 'Completed')
      ->addValue('Mautic_Webhook_Data.Trigger_Event', str_replace('mautic.', '', $trigger))
      ->addValue('Mautic_Webhook_Data.Data', "MauticWebhook Entity ID: {$mauticWebhookEntityID}")
      ->execute()
      ->first();
    U::checkDebug('Created mautic webhook activity');
    return $result['id'] ?? NULL;
  }

}
