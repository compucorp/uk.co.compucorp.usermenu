DELETE FROM `civicrm_navigation`
WHERE `name` IN (
  'user-menu-ext__user-menu',
  'user-menu-ext__home-menu',
  'user-menu-ext__user-menu__my-account',
  'user-menu-ext__user-menu__civicrm-home',
  'user-menu-ext__user-menu__hide-menu',
  'user-menu-ext__user-menu__log-out'
);
