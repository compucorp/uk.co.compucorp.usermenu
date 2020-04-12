(function ($, homeMenuItem) {
  var $homeMenu, $homeMenuLink;

  $(document).ready(function () {
    $homeMenu =  $('#civicrm-menu [data-name="Home"]');
    $homeMenuLink = $homeMenu.find('> a');

    replaceHomeMenu();
  });

  /**
   * Replaces the home menu with a custom one with the following features:
   *
   * - Removes the dropdown menu.
   * - Adds a custom label next to the CiviCRM icon.
   * - Adds a link to the URL configured for the home menu item.
   */
  function replaceHomeMenu () {
    var $homeMenuLinkClone = $homeMenuLink.clone();
    $homeMenuLink.remove();

    $homeMenuLinkClone
      .append('<span class="crm-logo-label">' + homeMenuItem.label + '</span>')
      .attr('href', homeMenuItem.url)
      .appendTo($homeMenu);
  }
})(CRM.$, CRM['usermenu-ext__home-menu']);
