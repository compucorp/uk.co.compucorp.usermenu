<?php

/**
 * Home Menu Core ResourceList hook.
 */
class CRM_Usermenu_Hooks_CoreResourceList_HomeMenu {

  /** Home Menu Item */
  private $homeMenu;

  /**
   * Appends the home menu JS asset and adds the home menu navigation data to
   * the global settings object so it can be accessed by JS.
   */
  public function run () {
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
   * Runs when appending assets to the HTML header region, and when the
   * Home Menu navigation item is set to active.
   *
   * @param Array $items
   * @param String $region
   * @return Bool
   */
  public function shouldRun(array &$items, $region) {
    $homeMenu = $this->getHomeMenu();
    $isHeaderRegion = $region === 'html-header';
    $isUserMenuActive = $homeMenu && $homeMenu['is_active'] == 1;

    return $isHeaderRegion && $isUserMenuActive;
  }

  /**
   * Returns the Home Menu navigation item. Stores it in a local variable to avoid
   * repeated calls to the database. Returns NULL when the navigation item is not
   * found.
   *
   * @return Array|Null
   */
  private function getHomeMenu() {
    if (!$this->homeMenu) {
      $response = civicrm_api3('Navigation', 'get', [
        'sequential' => 1,
        'name' => 'user-menu-ext__home-menu',
        'options' => ['limit' => 1],
      ]);

      $this->homeMenu = CRM_Utils_Array::first($response['values']);
    }

    return $this->homeMenu;
  }

}

