<?php

/**
 * User Menu Add Navigation Items setup.
 */
class CRM_Usermenu_Upgrader_Setups_AddNavigationItems {

  /**
   * Adds the base navigation items required by the user menu extension.
   *
   * @return Bool
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
      'url' => '/civicrm/dashboard?reset=1',
      'permission' => 'access CiviCRM',
      'is_active' => 1,
    ];
    $userMenuChildItemsValues = [
      [
        'label' => 'CiviCRM Home',
        'name' => 'user-menu-ext__user-menu__civicrm-home',
        'icon' => 'fa fa-home',
        'url' => '/civicrm/dashboard?reset=1',
        'is_active' => 1,
      ],
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

    foreach ($userMenuChildItemsValues as $userMenuChildItemValue) {
      $userMenuChildItemValue['parent_id'] = $userMenu['id'];

      $this->createMenuItemIfItDoesntExist($userMenuChildItemValue);
    }

    return TRUE;
  }

  /**
   * Creates a navigation menu item if it does not exist.
   *
   * @param Array $values
   * @return Array
   */
  private function createMenuItemIfItDoesntExist($values) {
    $menuItem = civicrm_api3('Navigation', 'get', [
      'name' => $values['name'],
    ]);

    if ($menuItem['count'] > 0) {
      return CRM_Utils_Array::first($menuItem['values']);
    }

    return civicrm_api3('Navigation', 'create', $values);
  }

}
