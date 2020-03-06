<?php

return [
  'allowCivicrmUserMenu' => [
    'group_name' => 'CiviCRM Preferences',
    'group' => 'core',
    'name' => 'allowCivicrmUserMenu',
    'type' => 'Boolean',
    'quick_form_type' => 'YesNo',
    'default' => TRUE,
    'html_type' => 'radio',
    'add' => '4.7',
    'title' => 'Show user menu',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'The user menu is optional to aid navigation; if you would like to show the user menu, select yes, otherwise select no.',
    'help_text' => '',
  ],
];
