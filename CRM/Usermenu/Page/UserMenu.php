<?php

/**
 * User Menu page class.
 */
class CRM_Usermenu_Page_UserMenu extends CRM_Core_Page {

  /**
   * The default user image path.
   *
   * @const string
   */
  const DEFAULT_USER_IMAGE_PATH = '%{base}/images/profile-default.png';

  /**
   * The contact data used to build the menu.
   *
   * @var array
   */
  private $contactData = [];

  /**
   * Appends the data for the menu navigation items, user name, and user image.
   */
  public function run() {
    $this->contactData();

    $this->assign('menuItems', $this->getMenuItems());
    $this->assign('username', $this->getUserName());
    $this->assign('image', $this->getUserImagePath());

    return parent::run();
  }

  /**
   * Returns the default user image URL path.
   *
   * @return string
   *   The user's default image path.
   */
  private function getDefaultImagePath() {
    $modulePath = (new CRM_Extension_System())
      ->getFullContainer()
      ->getResUrl('uk.co.compucorp.usermenu');

    return str_replace('%{base}', $modulePath, self::DEFAULT_USER_IMAGE_PATH);
  }

  /**
   * Returns the user menu navigation items.
   *
   * Each menu item needs to support the following conditions:
   * - Be active.
   * - The current logged in user needs to have permissions to access the item.
   *
   * @return array
   *   The user menu navigation items.
   */
  private function getMenuItems() {
    $menuItems = civicrm_api3('Navigation', 'get', [
      'is_active' => 1,
      'parent_id' => 'user-menu-ext__user-menu',
      'options' => ['sort' => 'weight ASC'],
    ]);

    return $this->filterMenuItemsByPermission($menuItems['values']);
  }

  /**
   * Filter the given menu items by permission.
   *
   * Only the menu items the user has permission to see will be returned.
   *
   * @param array $menuItems
   *   A list of menu items and their permissions.
   *
   * @return array
   *   A filtered list of menu items.
   */
  private function filterMenuItemsByPermission(array $menuItems) {
    return array_filter($menuItems, 'CRM_Core_BAO_Navigation::checkPermission');
  }

  /**
   * Returns the contact data.
   *
   * It fetches it from the api if it's not yet available.
   *
   * @return array
   *   The contact data.
   */
  private function contactData() {
    if (empty($this->contactData)) {
      $this->contactData = $this->getContactDataFromApi();
    }

    return $this->contactData;
  }

  /**
   * Fetches the contact data from the API and then normalizes the response.
   *
   * @return array
   *   The contact data.
   */
  private function getContactDataFromApi() {
    $rawContactData = civicrm_api3('Contact', 'getsingle', [
      'return' => ['id', 'display_name', 'image_URL'],
      'id' => CRM_Core_Session::getLoggedInContactID(),
      'api.User.getsingle' => ['contact_id' => '$value.contact_id'],
    ]);

    return $this->normalizeContactDataApiResponse($rawContactData);
  }

  /**
   * Normalizes the given contact data.
   *
   * It removes any odd structure
   * related to the API response.
   *
   * @param array $rawData
   *   The contact data as returned by the API.
   *
   * @return array
   *   The normalized contact data.
   */
  private function normalizeContactDataApiResponse(array $rawData) {
    $rawData['cmsId'] = $rawData['api.User.getsingle']['id'];
    unset($rawData['api.User.getsingle']);

    return $rawData;
  }

  /**
   * Returns the user name.
   *
   * It falls back to a generic name if the user
   * doesn't have one.
   *
   * @return string
   *   The user name.
   */
  private function getUserName() {
    if (!empty($this->contactData()['display_name'])) {
      return $this->contactData()['display_name'];
    }

    return 'Anonymous';
  }

  /**
   * Returns the path of the user's image.
   *
   * It falls back to the CMS's default
   * image if the user doesn't have one.
   *
   * @return string
   *   The user image's path.
   */
  private function getUserImagePath() {
    if (!empty($this->contactData()['image_URL'])) {
      return $this->contactData()['image_URL'];
    }

    return $this->getDefaultImagePath();
  }

}
