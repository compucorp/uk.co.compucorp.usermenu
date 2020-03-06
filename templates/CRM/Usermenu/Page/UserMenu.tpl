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
      <li>
        <a href="{$editLink}">
          <i class="fa fa-edit"></i>{ts}My Account{/ts}
        </a>
      </li>
      <li>
        <a href="{$logoutLink}">
          <i class="fa fa-sign-out"></i>{ts}Log Out{/ts}
        </a>
      </li>
    </ul>
  </nav>
</div>
