<?php

/**
 * User Menu Core Resource List hook.
 */
class CRM_Usermenu_Hooks_CoreResourceList_UserMenu {

  /**
   * Appends the user menu JS asset.
   */
  public function run() {
    CRM_Core_Resources::singleton()
      ->addScriptFile('uk.co.compucorp.usermenu', 'js/usermenu.js', 1010);
  }

  /**
   * Determines if the hook should run.
   *
   * Runs when appending assets to the HTML header region and the user menu
   * navigation item is active.
   *
   * @param array $items
   *   A list of core assets that will be included.
   * @param string $region
   *   The region the assets will be appended to.
   *
   * @return bool
   *   True when the hook should run.
   */
  public function shouldRun(array &$items, $region) {
    $activeUserMenuItem = $this->getActiveUserMenu();
    $isHeaderRegion = $region === 'html-header';
    $isUserMenuActive = $activeUserMenuItem['count'] > 0;

    return $isHeaderRegion && $isUserMenuActive;
  }

  /**
   * Returns the User Menu navigation item if it's active.
   *
   * @return array
   *   The active user menu.
   */
  private function getActiveUserMenu() {
    return civicrm_api3('Navigation', 'get', [
      'is_active' => 1,
      'name' => 'user-menu-ext__user-menu',
      'options' => ['limit' => 1],
    ]);
  }

}
