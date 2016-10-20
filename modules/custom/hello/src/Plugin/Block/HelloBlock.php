<?php

/**
 * @file
 * Contains \Drupal\hello\Plugin\Block\HelloBlock
 */

namespace Drupal\hello\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Datetime;

/**
 * Provides a hello block
 *
 * @Block(
 *  id = "hello_block",
 *  admin_label = @Translation("Hello!")
 * )
 */
class HelloBlock extends BlockBase{

    /**
     * Implements Drupal\Core\Block\BlockBase::build()
     */
    public function build(){
        //$date_hour = date("H:i:s");

        $date_tmp = time();
        $markup = $this->t('Welcome to our site. It is '. \Drupal::service('date.formatter')->format($date_tmp, 'date_hour')/*$date_hour*/);

        return array(
            '#markup' => $markup,
            '#cache' => array(
                'max-age' => '10',
            ),
            );
    }
}