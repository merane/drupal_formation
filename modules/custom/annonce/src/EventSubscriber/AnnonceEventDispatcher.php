<?php

namespace Drupal\annonce\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;
use Drupal\Core\Session\AccountProxy;
use Symfony\Component\HttpKernel\KernelEvents;
use Drupal\Core\Routing\CurrentRouteMatch;
use Drupal\Core\Database\Connection;

/**
 * Class AnnonceEventDispatcher.
 *
 * @package Drupal\annonce
 */
class AnnonceEventDispatcher implements EventSubscriberInterface {

    protected $current_user;
    protected $current_route_match;
    protected $database;

  /**
   * Constructor.
   */
  public function __construct(AccountProxy $current_user, CurrentRouteMatch $current_route_match, Connection $database) {
      $this->current_user = $current_user;
      $this->current_route_match = $current_route_match;
      $this->database = $database;
  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = array('displayMessage',1000);
    return $events;
  }

  function displayMessage(){
      if($this->current_route_match->getCurrentRouteMatch()->getRouteName() == 'entity.annonce.canonical'){
          drupal_set_message(t('Entité annonce'));
          if($this->current_route_match->getRawParameter('annonce') != NULL){
              $this->database->insert('annonce_history')
                  ->fields(array(
                      'aid' => $this->current_route_match->getRawParameter('annonce'),
                      'update_time' => time(),
                      'uid' => $this->current_user->id()
                  ))
                  ->execute();
          }
      }
  }


}
