<?php

use CRM_Usermenu_Hooks_CoreResourceList_Base as BaseHook;

/**
 * User Menu Core Resource List hook.
 */
class CRM_Usermenu_Hooks_CoreResourceList_UserMenu extends BaseHook {

  /**
   * Appends the user menu JS asset.
   */
  protected function appendResources() {
    CRM_Core_Resources::singleton()
      ->addScriptFile('uk.co.compucorp.usermenu', 'js/usermenu.js', 1010);
  }

  /**
   * Determines if the hook should run.
   *
   * Runs given the following conditions:
   * - When appending assets to the HTML header region.
   * - The User Menu navigation item is set to active.
   * - The user can access the User Menu navigation item.
   *
   * @return bool
   *   True when the hook should run.
   */
  protected function shouldRun() {
    $activeUserMenuItem = $this->getActiveUserMenu();
    $isHeaderRegion = $this->region === 'html-header';
    $isUserMenuActive = $activeUserMenuItem !== NULL;
    $canAccessUserMenu = CRM_Core_BAO_Navigation::checkPermission($activeUserMenuItem);

    return $isHeaderRegion && $isUserMenuActive && $canAccessUserMenu;
  }

  /**
   * Returns the User Menu navigation item if it's active.
   *
   * @return array|null
   *   The active user menu or null when not found.
   */
  private function getActiveUserMenu() {
    $activeUserMenu = civicrm_api3('Navigation', 'get', [
      'is_active' => 1,
      'name' => 'user-menu-ext__user-menu',
      'options' => ['limit' => 1],
    ]);

    return CRM_Utils_Array::first($activeUserMenu['values']);
  }

}
