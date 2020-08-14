<?php

namespace Drupal\health\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

class HealthController extends ControllerBase
{

  public function content()
  {

    // Prepare response message
    $host = gethostname();
    $time = time();
    $r = sprintf("host:%s time:%s", $host, $time);

    // Prepare response object
    $response = new Response();
    $response->headers->set('Content-Type', 'text/plain');
    $response->setContent($r);

    // Return response
    return $response;

  }

}
