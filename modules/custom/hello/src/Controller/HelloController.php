<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class Hello.
 *
 */
class HelloController extends ControllerBase {

    /*public function content() {
        //$name = \Drupal::currentUser()->getAccountName();
        $name = $this->currentUser()->getAccountName();
        return array('#markup' => t("Vous êtes sur la page Hello. Votre nom d'utilisateur est $name"));
    }*/

    public function content($param) {
        //$name = \Drupal::currentUser()->getAccountName();
        //$name = $this->currentUser()->getAccountName();
        return array('#markup' => t("Vous êtes sur la page Hello. Votre nom d'utilisateur est @name, et voici le paramètre dans l'URL : @parameter", array('@name' => $this->currentUser()->getAccountName(), '@parameter' => $param)));
    }

}