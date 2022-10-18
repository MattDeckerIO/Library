<?php
namespace Drupal\adminlocker\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Drupal\Core\Url;

class AdminLocker implements EventSubscriberInterface {

  private $paths_block = [];
  private $paths_allow = [];

  public function __construct()
  {
    $this->setBlockPaths();
    $this->setAllowPaths();
  }

  /**
  * Redirect pattern based url
  * @param GetResponseEvent $event
  */
  public function checkAccess(FilterResponseEvent $event) {
    if (!\Drupal::currentUser()->isAuthenticated()) { return; } // Only block authenticated users.

    /** if (\Drupal::currentUser()->hasPermission('bypass adminlocker')) { return; } **/

    $deny = $this->denyAccess($this->getCurrentPath(), $this->getAllowPaths());
    if ($deny) { return; }

    $deny = $this->denyAccess($this->getCurrentPath(), $this->getBlockPaths());
    if ($deny) { $this->exit($event); }
  }

  /**
  * Listen to kernel.request events and call customRedirection.
  * {@inheritdoc}
  * @return array Event names to listen to (key) and methods to call (value)
  */
  public static function getSubscribedEvents() {
    $events[KernelEvents::RESPONSE][] = ['checkAccess'];
    return $events;
  }

  /**
   * Get the value of allowed paths
   */
  private function getAllowPaths()
  {
    return $this->paths_allow;
  }

  /**
   * Get the value of blocked paths
   */
  private function getBlockPaths()
  {
    return $this->paths_block;
  }

  /**
   * Set the value of blocked paths
   *
   * @return  self
   */
  private function setBlockPaths()
  {
    $config =  \Drupal::config('adminlocker.settings')->get('adminlocker.adminlocker_block');
    $paths = explode(PHP_EOL, $config);
    $paths = array_map('trim', $paths);

    $this->paths_block = $paths;

    return $this;
  }

  /**
   * Set the value of allowed paths
   *
   * @return  self
   */
  private function setAllowPaths()
  {
    $config =  \Drupal::config('adminlocker.settings')->get('adminlocker.adminlocker_allow');
    $paths = explode(PHP_EOL, $config);
    $paths = array_map('trim', $paths);

    $this->paths_allow = $paths;

    return $this;
  }

  private function getCurrentPath()
  {
    $request = \Drupal::request();
    return $request->server->get('REQUEST_URI', null);
  }

  private function exit($e)
  {
    if ($e->getRequestType() === HttpKernelInterface::MASTER_REQUEST) {
      throw new AccessDeniedHttpException();
    }
  }

  /**
   * Compares teh current url to the
   *
   * @source https://blog.shaharia.com/check-whether-url-match-wildcard-pattern
   *
   * @param String $url
   * @param array $whiteListUrls
   * @return void
   */
  private function denyAccess($current_url, $allowList = [])
  {
      foreach ($allowList as $url) {
          $pattern = preg_quote($url, '/');
          $pattern = str_replace('\*', '.*', $pattern);
          $matched = preg_match('/^' . $pattern . '$/i', $current_url);
          if ($matched > 0) {
              return true;
          }
      }

      return false;
  }
}