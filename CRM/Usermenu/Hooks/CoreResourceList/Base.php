<?php

/**
 * Base Core Resource List hook.
 */
abstract class CRM_Usermenu_Hooks_CoreResourceList_Base {

  /**
   * Stores the items and regions parameters of the hook.
   *
   * @param array $items
   *   A list of core assets that will be included.
   * @param string $region
   *   The region the assets will be appended to.
   */
  public function __construct(array &$items, $region) {
    $this->items = $items;
    $this->region = $region;
  }

  /**
   * Appends the resources as long as the hook can run.
   */
  public function run() {
    if (!$this->shouldRun()) {
      return;
    }

    $this->appendResources();
  }

  /**
   * Adds resources including Javascript and Stylesheet files.
   */
  abstract protected function appendResources();

  /**
   * Determines if the hook should run.
   */
  abstract protected function shouldRun();

}
