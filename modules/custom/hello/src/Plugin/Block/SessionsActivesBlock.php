<?php

/**
 * @file
 * Contains \Drupal\hello\Plugin\Block\SessionsActivesBlock
 */

namespace Drupal\hello\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides number of active sessions
 *
 * @Block(
 *  id = "sessions_actives_block",
 *  admin_label = @Translation("Sessions actives")
 * )
 */
class SessionsActivesBlock extends BlockBase{

    protected function blockAccess(AccountInterface $account){
        if($account->hasPermission('access_hello')){
            return AccessResult::allowed();
        } else {
            return AccessResult::forbidden();
        }
    }

    /**
     * Implements Drupal\Core\Block\BlockBase::build()
     */
    public function build(){
        $database = \Drupal::database();

        $sessions_num = $database->select('sessions', 's')
            ->fields('s', array())
            ->countQuery()
            ->execute();

        $sessions_num = $sessions_num->fetchField();

        if($sessions_num <= 1){
            $markup = $this->t('There is '. $sessions_num . ' session.');
        } else {
            $markup = $this->t('There are '. $sessions_num . ' sessions.');
        }

        return array(
            '#markup' => $markup,
        );
    }
}