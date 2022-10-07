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
 * Implements hook_civicrm_coreResourceList().
 */
function usermenu_civicrm_coreResourceList(&$items, $region) {
  $hooks = [
    new CRM_Usermenu_Hooks_CoreResourceList_HomeMenu($items, $region),
    new CRM_Usermenu_Hooks_CoreResourceList_Stylesheets($items, $region),
    new CRM_Usermenu_Hooks_CoreResourceList_UserMenu($items, $region),
  ];

  foreach ($hooks as $hook) {
    $hook->run();
  }
}
