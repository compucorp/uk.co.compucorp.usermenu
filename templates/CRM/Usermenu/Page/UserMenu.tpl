<div class="civicrm-usermenu">
  <div class="civicrm-usermenu__data">
    <div class="civicrm-usermenu__card">
      <div class="civicrm-usermenu__card__picture civicrm-usermenu__card__picture--small">
        <img src="{$image}" alt="{$username|escape}">
      </div>
    </div>
    <i class="civicrm-usermenu__arrow fa fa-caret-down"></i>
  </div>
  <nav class="civicrm-usermenu__dropdown">
    <ul>
      <li class="civicrm-usermenu__dropdown__username">
        <span>Signed in as <strong>{$username|escape}</strong></span>
      </li>
      {foreach from=$menuItems item=menuItem}
        <li data-user-menu-item-name="{$menuItem.name}">
          <a href="{$menuItem.url}">
            <i class="{$menuItem.icon}"></i>
            {$menuItem.label}
          </a>
        </li>
      {/foreach}
    </ul>
  </nav>
</div>
