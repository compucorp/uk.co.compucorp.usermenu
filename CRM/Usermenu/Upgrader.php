<?php

/**
 * Collection of upgrade steps.
 */
class CRM_Usermenu_Upgrader extends CRM_Extension_Upgrader_Base {

  /**
   * Runs install scripts.
   */
  public function install() {
    $setups = [
      new CRM_Usermenu_Upgrader_Setups_AddNavigationItems(),
    ];

    foreach ($setups as $setup) {
      $setup->apply();
    }
  }

}
