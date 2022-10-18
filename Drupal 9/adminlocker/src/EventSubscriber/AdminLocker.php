<?php
namespace Drupal\adminlocker\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Drupal\Core\Url;

class AdminLocker implements EventSubscriberInterface {

  private $paths = [];

  public function __construct()
  {
    $this->setPaths();
  }

  /**
  * Redirect pattern based url
  * @param GetResponseEvent $event
  */
  public function checkAccess(GetResponseEvent $event) {
    if (!\Drupal::currentUser()->isAuthenticated()) { return; } // Only block authenticated users.
    /** if (\Drupal::currentUser()->hasPermission('bypass adminlocker')) { return; } **/
    $deny = $this->denyAccess($this->getCurrentPath(), $this->getPaths());
    if ($deny) { $this->exit(); }
  }

  /**
  * Listen to kernel.request events and call customRedirection.
  * {@inheritdoc}
  * @return array Event names to listen to (key) and methods to call (value)
  */
  public static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = ['checkAccess'];
    return $events;
  }

  /**
   * Get the value of paths
   */
  private function getPaths()
  {
    return $this->paths;
  }

  /**
   * Set the value of paths
   *
   * @return  self
   */
  private function setPaths()
  {
    $config =  \Drupal::config('adminlocker.settings')->get('adminlocker.adminlocker_settings');
    $paths = explode(PHP_EOL, $config);
    $paths = array_map('trim', $paths);

    $this->paths = $paths;

    return $this;
  }

  private function getCurrentPath()
  {
    $request = \Drupal::request();
    return $request->server->get('REQUEST_URI', null);
  }

  private function exit()
  {
    $url = Url::fromRoute('system.403');
    $response = new RedirectResponse($url->toString());
    $response->send();
    exit();
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