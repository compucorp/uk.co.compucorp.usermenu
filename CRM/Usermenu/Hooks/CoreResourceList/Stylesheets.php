<?php

/**
 * User Menu Stylesheets Core Resource List hook.
 */
class CRM_Usermenu_Hooks_CoreResourceList_Stylesheets {

  /**
   * Appends the user menu stylesheet.
   */
  public function run () {
    CRM_Core_Resources::singleton()
      ->addStyleFile(
        'uk.co.compucorp.usermenu',
        'css/usermenu.min.css',
        100,
        'html-header'
      );

  }

  /**
   * Determines if the hook should run.
   *
   * Runs when appending assets to the HTML header region.
   *
   * @param Array $items
   * @param String $region
   * @return Bool
   */
  public function shouldRun(&$items, $region) {
    $isHeaderRegion = $region === 'html-header';

    return $isHeaderRegion;
  }

}
