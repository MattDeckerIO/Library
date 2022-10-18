<?php

namespace Drupal\adminlocker\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Defines AdminLockerController class.
 */
class AdminLockerController extends ControllerBase {

  /**
   * Display the markup.
   *
   * @return array
   *   Return markup array.
   */
  public function content() {
    return [
      '#type' => 'markup',
      '#markup' => $this->output(),
    ];
  }

  private function output()
  {
    $o  = '';
    $o .= sprintf('<p><a href="%s">Configure paths</a></p>','/admin/adminlocker/edit');
    $o .= sprintf("<p><strong>Blocked Paths:</strong><br />%s</p>",$this->getBlockedPaths());
    $o .= sprintf("<p><strong>Allowed Paths:</strong><br />%s</p>",$this->getAllowedPaths());
    $o .= sprintf('<p><a href="%s">Configure paths</a></p>','/admin/adminlocker/edit');
    return $o;
  }

  private function getBlockedPaths()
  {
    $config =  \Drupal::config('adminlocker.settings')->get('adminlocker.adminlocker_block');
    return $this->formatPaths($config);
  }

  private function getAllowedPaths()
  {
    $config = \Drupal::config('adminlocker.settings')->get('adminlocker.adminlocker_allow');
    return $this->formatPaths($config);
  }

  private function formatPaths($p)
  {
    $paths = explode(PHP_EOL, $p);
    $paths = array_map('trim', $paths);
    $paths = implode('<br />', $paths);
    return $paths;
  }

}