<?php

require_once 'usermenu.civix.php';
use CRM_Usermenu_ExtensionUtil as E;

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
 * Implements hook_civicrm_thems().
 */
function usermenu_civicrm_themes(&$themes) {
  _usermenu_civix_civicrm_themes($themes);
}

/**
 * Implements hook_civicrm_alterContent().
 * Adds extra settings fields to the Civicase Admin Settings form.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterContent/
 */
function usermenu_civicrm_alterContent (&$content, $context, $templateName, $object) {
  $isViewingMiscSettingsForm = get_class($object) === CRM_Admin_Form_Setting_Miscellaneous::class;

  if (!$isViewingMiscSettingsForm) {
    return;
  }

  $settingsTemplate = &CRM_Core_Smarty::singleton();
  $settingsTemplateHtml = $settingsTemplate->fetchWith('CRM/Usermenu/Admin/Form/Settings.tpl', []);

  $doc = phpQuery::newDocumentHTML($content);
  $doc->find('table.form-layout:eq(1) tr:last')->append($settingsTemplateHtml);

  $content = $doc->getDocument();
}

/**
 * Implements hook_civicrm_coreResourceList().
 */
function usermenu_civicrm_coreResourceList(&$items, $region) {
  $allowCiviCrmUserMenu = (bool) Civi::settings()->get('allowCivicrmUserMenu');
  $isHeaderRegion = $region === 'html-header';

  if ($isHeaderRegion && $allowCiviCrmUserMenu) {
    CRM_Core_Resources::singleton()->addScriptFile('uk.co.compucorp.usermenu', 'js/usermenu.js', 1010);
    CRM_Core_Resources::singleton()->addStyleFile('uk.co.compucorp.usermenu', 'css/usermenu.min.css', 100, 'html-header');
  }
}

/**
 * Implements hook_civicrm_preProcess().
 */
function usermenu_civicrm_preProcess($formName, &$form) {
  $isViewingMiscSettingsForm = $formName === CRM_Admin_Form_Setting_Miscellaneous::class;

  if (!$isViewingMiscSettingsForm) {
    return;
  }

  $settings = $form->getVar('_settings');
  $settings['allowCivicrmUserMenu'] = CRM_Core_BAO_Setting::SYSTEM_PREFERENCES_NAME;

  $form->setVar('_settings', $settings);
}
