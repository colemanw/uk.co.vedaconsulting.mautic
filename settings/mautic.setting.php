<?php

return [
  'mautic_connection_url' => [
    'group_name' => 'Mautic Settings',
    'group' => 'mautic',
    'name' => 'mautic_connection_url',
    'type' => 'String',
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'URL to the Mautic installation, without a trailing slash.',
    'title' => 'Mautic Base URL',
    'is_required' => TRUE,
    'help_text' => '',
    'html_type' => 'text',
    'html_attributes' => [
      'size' => 50,
      'placeholder' => 'http://example.com',
      'required' => TRUE,
    ],
  ],
  'mautic_connection_authentication_method' => [
    'group_name' => 'Mautic Settings',
    'group' => 'mautic',
    'name' => 'mautic_connection_authentication_method',
    'type' => 'String',
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'The Authentication method used to connect to the Mautic installation.',
    'title' => 'Authentication method',
    'is_required' => TRUE,
    'help_text' => '',
    'html_type' => 'select',
    'html_attributes' => [
      'required' => TRUE,
    ],
    'options' => [
      0 => 'Select',
      'basic' => 'Basic Authentication',
      'oauth1' => 'OAuth 1',
      'oauth2' => 'OAuth 2',
    ],
  ],
  'mautic_basic_username' => [
    'group_name' => 'Mautic Settings',
    'group' => 'mautic',
    'name' => 'mautic_basic_username',
    'type' => 'String',
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Mautic Basic Authentication User Name',
    'title' => 'User Name',
    'help_text' => '',
    'html_type' => 'text',
    'html_attributes' => [
      'size' => 50,
    ],
  ],
  'mautic_basic_password' => [
    'group_name' => 'Mautic Settings',
    'group' => 'mautic',
    'name' => 'mautic_basic_password',
    'type' => 'String',
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Mautic Basic Authentication Password.',
    'title' => 'Password.',
    'help_text' => '',
    'html_type' => 'password',
    'html_attributes' => [
      'size' => 50,
    ],
  ],
  // OAuth 1 Settings.
  'mautic_oauth1_consumer_key' => [
    'group_name' => 'Mautic Settings',
    'group' => 'mautic',
    'name' => 'mautic_oauth1_consumer_key',
    'type' => 'String',
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Mautic Consumer Key',
    'title' => 'Consumer Key',
    'help_text' => '',
    'html_type' => 'text',
    'html_attributes' => [
      'size' => 50,
    ],
  ],
  // OAuth 1.0 mautic (Consumer) Secret
  'mautic_oauth1_consumer_secret' => [
    'group_name' => 'Mautic Settings',
    'group' => 'mautic',
    'name' => 'mautic_oauth1_consumer_secret',
    'type' => 'String',
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'The OAuth 1.0 Consumer Secret from your Mautic installation',
    'title' => 'Consumer Secret',
    'help_text' => '',
    'html_type' => 'password',
    'html_attributes' => [
      'size' => 50,
    ],
  ],
  // End OAuth 1 settings.
  // OAuth 2.0 Settings.
  'mautic_oauth2_client_id' => [
    'group_name' => 'Mautic Settings',
    'group' => 'mautic',
    'name' => 'mautic_oauth2_client_id',
    'type' => 'String',
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Mautic Client ID',
    'title' => 'Client ID',
    'help_text' => '',
    'html_type' => 'text',
    'html_attributes' => [
      'size' => 50,
    ],
  ],
  // OAuth 2.0 mautic (Client) Secret
  'mautic_oauth2_client_secret' => [
    'group_name' => 'Mautic Settings',
    'group' => 'mautic',
    'name' => 'mautic_oauth2_client_secret',
    'type' => 'String',
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'The OAuth 2.0 Client Secret from your Mautic installation',
    'title' => 'Client Secret',
    'help_text' => '',
    'html_type' => 'password',
    'html_attributes' => [
      'size' => 50,
    ],
  ],
  'mautic_enable_debugging' => [
    'group_name' => 'Mautic Settings',
    'group' => 'mautic',
    'name' => 'mautic_enable_debugging',
    'type' => 'Boolean',
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'If set then debugging messages will be added to the log.',
    'title' => 'Enable Debugging',
    'help_text' => '',
    'html_type' => 'checkbox',
    'html_attributes' => [
      'size' => 50,
    ],
  ],
  'mautic_enable_debugging_api' => [
    'group_name' => 'Mautic Settings',
    'group' => 'mautic',
    'name' => 'mautic_enable_debugging_api',
    'type' => 'Boolean',
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'default' => FALSE,
    'description' => 'Enables the Mautic API debug logging to the main CiviCRM log file. This outputs a lot of data and should not normally be enabled.',
    'title' => 'Enable API Debugging',
    'help_text' => '',
    'html_type' => 'checkbox',
    'html_attributes' => [
      'size' => 50,
    ],
  ],
  'mautic_webhook_trigger_events' => [
    'group_name' => 'Mautic Settings',
    'group' => 'mautic',
    'name' => 'mautic_webhook_trigger_events',
    'type' => 'checkboxes',
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Events on Mautic to listen for.',
    'title' => 'Webhook trigger events',
    'help_text' => '',
    'html_type' => 'checkboxes',
    'is_multiple' => TRUE,
    'multiple' => TRUE,
    'html_attributes' => [
      'size' => 50,
    ],
    'pseudoconstant' => ['callback' => 'CRM_Mautic_WebHook::getAllTriggerOptions'],
    'default' => [
      'mautic.lead_post_delete',
      // Contact Identified Event.
      'mautic.lead_post_save_new',
      // Contact Points Changed Event
      'mautic.lead_points_change',
      // Contact Updated Event.
      'mautic.lead_post_save_update',
    ],
  ],
  'mautic_sync_tag_method' => [
    'group_name' => 'Mautic Settings',
    'group' => 'mautic',
    'name' => 'mautic_sync_tags',
    'type' => 'string',
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'How to synchronize tags.',
    'title' => 'Tag synchronization',
    'help_text' => '',
    'html_type' => 'radio',
    'html_attributes' => [
      'size' => 50,
    ],
    'options' => [
      'none' => ts('No tag synchronization'),
      'sync_tag_children' => ts('Restrict tag synchronization to a tag-set'),
      'no_remove' => ts('Push and pull without removing any tags'),
    ],
  ],
  'mautic_sync_tag_parent' => [
    'group_name' => 'Mautic Settings',
    'group' => 'mautic',
    'name' => 'mautic_sync_tag_parent',
    'type' => 'Integer',
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Select a tag to contain the tags synched between Mautic and CiviCRM. Leave blank to create a new "Mautic" tag',
    'title' => ts('Parent Tag'),
    'help_text' => '',
    'html_type' => 'entity_reference',
    'html_attributes' => [
    ],
    'entity_reference_options' => [
      'entity' => 'Tag',
      'multiple' => false,
    ],
  ],
  // Settings below here are not included in settings form.
  'mautic_contact_field_mapping' => [
    'group_name' => 'Mautic Settings',
    'group' => 'mautic',
    'name' => 'mautic_contact_field_mapping',
    'type' => 'String',
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Mapping between CiviCRM and Mautic fields',
    'title' => ts('Field Mapping'),
    'serialize' => CRM_Core_DAO::SERIALIZE_JSON,
  ],
  // OAuth Access token data.
  'mautic_access_token' => [
    'group_name' => 'Mautic Settings',
    'group' => 'mautic',
    'name' => 'mautic_access_token',
    'type' => 'String',
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => ts('Mautic Access Token'),
    'title' => ts('Mautic Access Token'),
    'help_text' => '',
    // No form element
  ],
  // OAuth 2.0. Obtained during Mautic authentication.
  'mautic_tenant_id' => [
    'group_name' => 'Mautic Settings',
    'group' => 'mautic',
    'name' => 'mautic_tenant_id',
    'type' => 'String',
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Mautic Tenant ID (Organization)',
    'title' => 'Mautic Tenant ID',
    'help_text' => '',
    // No form element
  ],
  'mautic_webhook_security_key' => [
    'group_name' => 'Mautic Settings',
    'group' => 'mautic',
    'name' => 'mautic_webhook_security_key',
    'type' => 'String',
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Security key used to verify webhook requests.',
    'title' => 'Webhook Security Key',
    'help_text' => '',
    // No form element
  ],
  'mautic_webhook_dedupe_rule' => [
    'group_name' => 'Mautic Settings',
    'group' => 'mautic',
    'name' => 'mautic_webhook_dedupe_rule',
    'type' => 'String',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Dedupe rule used to match contacts when processing webhooks. Before this is applied, custom fields are looked up on the mautic contact and in CiviCRM.',
    'title' => 'Webhook Dedupe Fallback Rule',
    'pseudoconstant' => ['callback' => 'CRM_Mautic_Contact_ContactMatch::getDedupeRules'],
    'html_type' => 'select',
    'help_text' => '',
  ],
  'mautic_push_stats' => [
    'group_name' => 'Mautic Settings',
    'group' => 'mautic',
    'name' => 'mautic_push_stats',
    'type' => 'String',
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Information about the last push operation.',
    'title' => 'Push Stats',
    'help_text' => '',
    // No form element
  ],
  'mautic_pull_stats' => [
    'group_name' => 'Mautic Settings',
    'group' => 'mautic',
    'name' => 'mautic_pull_stats',
    'type' => 'String',
    'add' => '5.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Information about the last pull operation.',
    'title' => 'Pull Stats',
    'help_text' => '',
    // No form element
  ],

];
