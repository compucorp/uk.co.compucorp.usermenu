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
        handleHideMenuEvent();
      }
    });
  }

  /**
   * Hides the CiviCRM menu when clicking "Hide Menu" anchor elements.
   */
  function handleHideMenuEvent () {
    $('.civicrm-usermenu a[href="#hidemenu"]')
      .on('click', function (event) {
        event.preventDefault();
        CRM.menubar.hide(250, true);
      });
  }

  /**
   * Injects the given markup in a menu wrapper with the given id
   * created to contain both the original menu and the user one
   *
   * @param {string} menuMarkup menu markup to inject.
   * @param {string} wrapperId id for menu markup container.
   */
  function injectUserMenuInAMainMenuWrapper (menuMarkup, wrapperId) {
    var $menuMarkup = $(menuMarkup);
    var $menuWrapper = $('<div>');
    var prevSibling = CRM.$('#civicrm-menu-nav').prev();

    $menuWrapper.attr('id', wrapperId);
    $menuWrapper.append($('#civicrm-menu-nav'));
    $menuWrapper.append($menuMarkup);
    $menuWrapper.insertAfter(prevSibling);
  }
}(CRM.$, CRM._, ts));
