<?php

namespace Drupal\annonce\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides the views data for the Annonce entity type.
 */
class AnnonceViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['annonce_history']['table']['group'] = t('Annonce history');

    $data['annonce']['table']['base'] = array(
      'field' => 'id',
      'title' => t('Annonce'),
      'help' => t('The annonce entity ID.'),
    );

    // Add annonce_history table in base
    $data['annonce_history']['table']['base'] = array(
      'field' => 'hid',
      'title' => t('Annonce history'),
      'help' => t('The annonce history ID.'),
    );

    // Add the hid annonce_history field
    $data['annonce_history']['hid'] = array(
      'title' => t('Annonce history id'),
      'help' => t('Annonce history id'),

      'field' => array(
          // ID of field handler plugin to use.
          'id' => 'numeric',
      ),

      'sort' => array(
          // ID of sort handler plugin to use.
          'id' => 'standard',
      ),

      'filter' => array(
          // ID of filter handler plugin to use.
          'id' => 'numeric',
      ),

      'argument' => array(
          // ID of argument handler plugin to use.
          'id' => 'numeric',
      ),
    );

    // Add the aid annonce_history field
    $data['annonce_history']['aid'] = array(
      'title' => t('Annonce id'),
      'help' => t('Annonce id'),

      'field' => array(
          // ID of field handler plugin to use.
          'id' => 'numeric',
      ),

      'sort' => array(
          // ID of sort handler plugin to use.
          'id' => 'standard',
      ),

      'filter' => array(
          // ID of filter handler plugin to use.
          'id' => 'numeric',
      ),

      'argument' => array(
          // ID of argument handler plugin to use.
          'id' => 'numeric',
      ),
    );

    // Add the uid annonce_history field
    $data['annonce_history']['uid'] = array(
      'title' => t('User id'),
      'help' => t('User id'),

      'field' => array(
          // ID of field handler plugin to use.
          'id' => 'numeric',
      ),

      'sort' => array(
          // ID of sort handler plugin to use.
          'id' => 'standard',
      ),

      'filter' => array(
          // ID of filter handler plugin to use.
          'id' => 'numeric',
      ),

      'argument' => array(
          // ID of argument handler plugin to use.
          'id' => 'numeric',
      ),
    );

    // Add the update_time annonce_history field
    $data['annonce_history']['update_time'] = array(
      'title' => t('View time'),
      'help' => t('View time'),

      'field' => array(
          // ID of field handler plugin to use.
          'id' => 'date',
      ),

      'sort' => array(
          // ID of sort handler plugin to use.
          'id' => 'date',
      ),

      'filter' => array(
          // ID of filter handler plugin to use.
          'id' => 'date',
      ),
    );

    return $data;
  }

}
