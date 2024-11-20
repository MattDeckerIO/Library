<?php
namespace Drupal\health\Controller;

use Symfony\Component\HttpFoundation\Response;

class Health {
  public function check() {
    $host = gethostname();
    $time = time();
    $response = sprintf("host:%s time:%s", $host, $time);

    return new Response($response);
  }
}
