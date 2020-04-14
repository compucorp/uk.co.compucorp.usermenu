<?php

/**
 * @file
 * Usermenu extension file.
 */

require_once 'usermenu.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function usermenu_civicrm_config(&$config) {
  _usermenu_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function usermenu_civicrm_xmlMenu(&$files) {
  _usermenu_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function usermenu_civicrm_install() {
  _usermenu_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function usermenu_civicrm_postInstall() {
  _usermenu_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function usermenu_civicrm_uninstall() {
  _usermenu_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function usermenu_civicrm_enable() {
  _usermenu_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function usermenu_civicrm_disable() {
  _usermenu_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function usermenu_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _usermenu_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function usermenu_civicrm_managed(&$entities) {
  _usermenu_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function usermenu_civicrm_caseTypes(&$caseTypes) {
  _usermenu_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function usermenu_civicrm_angularModules(&$angularModules) {
  _usermenu_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function usermenu_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _usermenu_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function usermenu_civicrm_entityTypes(&$entityTypes) {
  _usermenu_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_themes().
 */
function usermenu_civicrm_themes(&$themes) {
  _usermenu_civix_civicrm_themes($themes);
}

/**
 * Implements hook_civicrm_coreResourceList().
 */
function usermenu_civicrm_coreResourceList(&$items, $region) {
  $hooks = [
    new CRM_Usermenu_Hooks_CoreResourceList_Stylesheets($items, $region),
    new CRM_Usermenu_Hooks_CoreResourceList_UserMenu($items, $region),
  ];

  foreach ($hooks as $hook) {
    $hook->run();
  }
}
