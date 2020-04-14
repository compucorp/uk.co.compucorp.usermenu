<?php

/**
 * User Menu Stylesheets Core Resource List hook.
 */
class CRM_Usermenu_Hooks_CoreResourceList_Stylesheets {

  /**
   * Appends the user menu stylesheet.
   */
  public function run() {
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
   * @param array $items
   *   A list of core assets that will be included.
   * @param string $region
   *   The region the assets will be appended to.
   *
   * @return bool
   *   True when the hook should run.
   */
  public function shouldRun(array &$items, $region) {
    $isHeaderRegion = $region === 'html-header';

    return $isHeaderRegion;
  }

}
