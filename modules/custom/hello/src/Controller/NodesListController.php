<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class NodesList.
 *
 */
class NodesListController extends ControllerBase {

    /*public function content() {
        //$name = \Drupal::currentUser()->getAccountName();
        $name = $this->currentUser()->getAccountName();
        return array('#markup' => t("Vous êtes sur la page Hello. Votre nom d'utilisateur est $name"));
    }*/

    public function content($param) {
        $storage = \Drupal::entityTypeManager()->getStorage('node');


        /*$nids = \Drupal::entityQuery('node')
            ->condition('type', 'NODETYPE')
            ->execute();

        echo($nids);

        $nodes = \Drupal::entityTypeManager()
            ->getStorage('node')
            ->loadMultiple($nids);*/
        //kint($entities);
        echo $param;
        if($param != ''){

            $ids = \Drupal::entityQuery('node')
                ->condition('type', $param)
                ->pager('10')
                ->execute();
            $entities = $storage->loadMultiple($ids);

            foreach ($entities as $key) {
                //$node_list[] = $key->getTitle();
                $node_list[] = $key->toLink();
            }
        } else{

            $ids = \Drupal::entityQuery('node')
                ->pager('10')
                ->execute();
            $entities = $storage->loadMultiple($ids);

            foreach ($entities as $key) {
                //$node_list[] = $key->getTitle();
                $node_list[] = $key->toLink();
            }
        }

        $list = array('#theme' => 'item_list',
            '#items' => $node_list,
        );

        $pager = array('#type' => 'pager'
        );

        return array($pager, $list, $pager);
    }

}