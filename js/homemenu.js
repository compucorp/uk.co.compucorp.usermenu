(function ($, _, homeMenuItem) {
  var $homeMenu, $homeMenuLink, isHomeMenuReplaced;

  /**
   * We run the home menu replacing both on document ready and when the
   * CiviCRM Menu has loaded because CiviCRM appends the menu at different times
   * and we can't determine when it was appended.
   *
   * See: https://github.com/civicrm/civicrm-core/blob/master/js/crm.menubar.js#L28-L44
   */
  (function init () {
    $(document).ready(runHomeMenuReplacing);
    $(document).on('crmLoad', '#civicrm-menu', runHomeMenuReplacing);
  })();

  /**
   * Replaces the home menu with a custom one with the following features:
   *
   * - Removes the dropdown menu.
   * - Adds a custom label next to the CiviCRM icon.
   * - Adds a link to the URL configured for the home menu item.
   */
  function replaceHomeMenu () {
    var $homeMenuLinkClone = $homeMenuLink.clone();
    var homMenuLabelMarkup = '<span class="crm-logo-label">' +
      homeMenuItem.label + '</span>';

    $homeMenuLink.remove();
    $homeMenuLinkClone
      .append(homMenuLabelMarkup)
      .attr('href', homeMenuItem.url)
      .appendTo($homeMenu);
  }

  /**
   * Run the home menu replacing functions as long as the following is true:
   *
   * - The home menu is ready to be replaced. IE: it exists in the DOM.
   * - The home menu has not been replaced already.
   */
  function runHomeMenuReplacing () {
    var isHomeMenuReady;

    $homeMenu = $('#civicrm-menu [data-name="Home"]');
    $homeMenuLink = $homeMenu.find('> a');
    isHomeMenuReady = $homeMenu.length > 0;

    if (!isHomeMenuReady || isHomeMenuReplaced) {
      return;
    }

    isHomeMenuReplaced = true;

    replaceHomeMenu();
  }
})(CRM.$, CRM._, CRM['usermenu-ext__home-menu']);
