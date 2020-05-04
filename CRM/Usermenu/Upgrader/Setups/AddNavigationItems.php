<?php

/**
 * User Menu Add Navigation Items setup.
 */
class CRM_Usermenu_Upgrader_Setups_AddNavigationItems {

  /**
   * Adds the base navigation items required by the user menu extension.
   *
   * @return bool
   *   True when the setup is applied successfully.
   */
  public function apply() {
    $userMenuValues = [
      'label' => 'User Menu',
      'name' => 'user-menu-ext__user-menu',
      'icon' => 'fa fa-user',
      'url' => '',
      'permission' => 'access CiviCRM',
      'is_active' => 1,
    ];
    $homeMenuValues = [
      'label' => 'Home',
      'name' => 'user-menu-ext__home-menu',
      'icon' => 'fa fa-home',
      'url' => '/civicrm/dashboard?reset=1',
      'permission' => 'access CiviCRM',
      'is_active' => 1,
    ];
    $userMenuChildItemsValues = [
      [
        'label' => 'My Account',
        'name' => 'user-menu-ext__user-menu__my-account',
        'icon' => 'fa fa-edit',
        'url' => '/user/',
        'is_active' => 1,
      ],
      [
        'label' => 'Hide Menu',
        'name' => 'user-menu-ext__user-menu__hide-menu',
        'icon' => 'fa fa-eye-slash',
        'url' => '#hidemenu',
        'is_active' => 1,
      ],
      [
        'label' => 'Log Out',
        'name' => 'user-menu-ext__user-menu__log-out',
        'icon' => 'fa fa-sign-out',
        'url' => '/user/logout',
        'is_active' => 1,
      ],
    ];

    $userMenu = $this->createMenuItemIfItDoesntExist($userMenuValues);

    $this->createMenuItemIfItDoesntExist($homeMenuValues);
    CRM_Core_PseudoConstant::flush();

    foreach ($userMenuChildItemsValues as $userMenuChildItemValue) {
      $userMenuChildItemValue['parent_id'] = $userMenu['id'];

      $this->createMenuItemIfItDoesntExist($userMenuChildItemValue);
    }

    return TRUE;
  }

  /**
   * Creates a navigation menu item if it does not exist.
   *
   * @param array $values
   *   The value to use when creating the navigation item.
   *
   * @return array
   *   The navigation item data.
   */
  private function createMenuItemIfItDoesntExist(array $values) {
    $menuItem = civicrm_api3('Navigation', 'get', [
      'name' => $values['name'],
    ]);

    if ($menuItem['count'] > 0) {
      return CRM_Utils_Array::first($menuItem['values']);
    }

    return civicrm_api3('Navigation', 'create', $values);
  }

}
