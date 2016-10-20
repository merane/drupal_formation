<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Hello.
 *
 */
class HelloRssController extends ControllerBase {

    public function content() {
        $response = new Response();
        $response->setContent("<?xml version=\"1.0\" encoding=\"UTF-8\" ?><rss version=\"2.0\"><hello><title>Hello !</title><text> Ceci est un flux RSS.</text></hello></rss>");
        return $response;
    }

}