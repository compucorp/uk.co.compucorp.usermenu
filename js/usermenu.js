(function ($, _, ts) {
  $(document)
    .ready(function () {
      addUserMenuToMainMenu();
    });

  /**
   * Adds the user menu by fetching the user menu page
   */
  function addUserMenuToMainMenu () {
    $.ajax('/civicrm/user-menu?snippet=4', {
      dataType: 'html',
      success: function (menuMarkup) {
        injectUserMenuInAMainMenuWrapper(menuMarkup, 'civicrm-usermenu-wrapper');
      }
    });
  }
  /**
   * Injects the given markup in a menu wrapper with the given id
   * created to contain both the original menu and the user one
   *
   * @param {string} menuMarkup
   * @param {string} wrapperId
   */
  function injectUserMenuInAMainMenuWrapper (menuMarkup, wrapperId) {
    var $menuMarkup = $(menuMarkup);
    var $menuWrapper = $('<div>');

    $menuWrapper.attr('id', wrapperId);
    $menuWrapper.append($('#civicrm-menu-nav'));
    $menuWrapper.append($menuMarkup);
    $menuWrapper.insertAfter('#page');
  }
}(CRM.$, CRM._, ts));
