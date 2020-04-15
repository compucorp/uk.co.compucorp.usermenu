<?php

use CRM_Usermenu_Hooks_CoreResourceList_Base as BaseHook;

/**
 * Home Menu Core ResourceList hook.
 */
class CRM_Usermenu_Hooks_CoreResourceList_HomeMenu extends BaseHook {

  /**
   * Home Menu Item.
   *
   * @var object
   */
  private $homeMenu;

  /**
   * Appends the home menu JS asset.
   *
   * It also adds the home menu navigation data to the global settings object
   * so it can be accessed by JS.
   */
  protected function appendResources() {
    $homeMenu = $this->getHomeMenu();

    CRM_Core_Resources::singleton()
      ->addScriptFile('uk.co.compucorp.usermenu', 'js/homemenu.js', 1010)
      ->addSetting([
        'usermenu-ext__home-menu' => $homeMenu,
      ]);
  }

  /**
   * Determines if the function should run.
   *
   * Runs given the following conditions:
   * - When appending assets to the HTML header region.
   * - The Home Menu navigation item is set to active.
   * - The user can access the Home Menu navigation item.
   *
   * @return bool
   *   True when the hook should run.
   */
  protected function shouldRun() {
    $homeMenu = $this->getHomeMenu();
    $isHeaderRegion = $this->region === 'html-header';
    $isHomeMenuActive = $homeMenu && $homeMenu['is_active'] == 1;
    $canAccessHomeMenu = CRM_Core_BAO_Navigation::checkPermission($homeMenu);

    return $isHeaderRegion && $isHomeMenuActive && $canAccessHomeMenu;
  }

  /**
   * Returns the Home Menu navigation item.
   *
   * It Stores it in a local variable to avoid repeated calls to the database.
   * Returns NULL when the navigation item is not found.
   *
   * @return array|null
   *   The home menu item or null.
   */
  private function getHomeMenu() {
    if (!$this->homeMenu) {
      $response = civicrm_api3('Navigation', 'get', [
        'name' => 'user-menu-ext__home-menu',
        'options' => ['limit' => 1],
      ]);

      $this->homeMenu = CRM_Utils_Array::first($response['values']);
    }

    return $this->homeMenu;
  }

}
