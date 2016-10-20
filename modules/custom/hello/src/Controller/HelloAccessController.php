<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class Hello Access
 *
 */
class HelloAccessController extends ControllerBase {

    public function content() {
        return array('#markup' => t("Access page"));
    }

}