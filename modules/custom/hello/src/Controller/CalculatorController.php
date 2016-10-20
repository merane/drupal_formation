<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class Calculator.
 *
 */
class CalculatorController extends ControllerBase {

    public function content($value1, $value2, $operation, $result) {

        switch ($operation) {
            case 0:
                $operation = '+';
                break;
            case 1:
                $operation = '-';
                break;
            case 2:
                $operation = 'x';
                break;
            case 3:
                $operation = '/';
                break;
        }

        return array(
            '#markup' => $value1.' '.$operation.' '.$value2.' = '.$result,
        );
    }

}