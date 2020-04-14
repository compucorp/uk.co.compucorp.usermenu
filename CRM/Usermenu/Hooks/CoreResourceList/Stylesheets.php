<?php

use CRM_Usermenu_Hooks_CoreResourceList_Base as BaseHook;

/**
 * User Menu Stylesheets Core Resource List hook.
 */
class CRM_Usermenu_Hooks_CoreResourceList_Stylesheets extends BaseHook {

  /**
   * Appends the user menu stylesheet.
   */
  protected function appendResources() {
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
   * @return bool
   *   True when the hook should run.
   */
  protected function shouldRun() {
    $isHeaderRegion = $this->region === 'html-header';

    return $isHeaderRegion;
  }

}
