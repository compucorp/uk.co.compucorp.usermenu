<?php

/**
 * User Menu Core Resource List hook.
 */
class CRM_Usermenu_Hooks_CoreResourceList_UserMenu {

  /**
   * Appends the user menu JS asset.
   */
  public function run () {
    CRM_Core_Resources::singleton()
      ->addScriptFile('uk.co.compucorp.usermenu', 'js/usermenu.js', 1010);
  }

  /**
   * Determines if the hook should run.
   *
   * Runs when appending assets to the HTML header region and the user menu
   * navigation item is active.
   *
   * @param Array $items
   * @param String $region
   * @return Bool
   */
  public function shouldRun(&$items, $region) {
    $activeUserMenuItem = $this->getActiveUserMenu();
    $isHeaderRegion = $region === 'html-header';
    $isUserMenuActive = $activeUserMenuItem['count'] > 0;

    return $isHeaderRegion && $isUserMenuActive;
  }

  /**
   * Returns the User Menu navigation item if it's active.
   *
   * @return Array.
   */
  private function getActiveUserMenu() {
    return civicrm_api3('Navigation', 'get', [
      'sequential' => 1,
      'is_active' => 1,
      'name' => 'user-menu-ext__user-menu',
      'options' => ['limit' => 1],
    ]);
  }
}

