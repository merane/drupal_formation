<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;

/**
 * Class UpdateHistory.
 *
 */
class UpdateHistoryController extends ControllerBase {

    public function content(NodeInterface $node) {
        $database = \Drupal::database();

        $node_history = $database->select('hello_node_history', 'histo')
            ->fields('histo', array('uid', 'update_time'))
            ->condition('nid', $node->id(), '=')
            ->execute()
            ->fetchAll();

        $count =count($node_history);

        $storage = \Drupal::entityTypeManager()->getStorage('user');

        foreach ($node_history as $key) {
            //$node_list[] = $key->getTitle();
            //$node_history_tab .= $key;
            $rows[] = array($storage->load($key->uid)->getAccountName(), \Drupal::service('date.formatter')->format($key->update_time, 'medium'));
            //[uid] => 1 [update_time] => 1476355004
        }

        $header = array(
            array('data' => 'Update author'),
            array('data' => 'Update time'),
        );

        $render_array['history_table'] = array(
            '#theme' => 'table',
            '#header' => $header,
            '#rows' => $rows,
        );

        $output = array('#theme' => 'hello-node-history', '#node' => $node, '#count' => $count);

        return array($output,
            $render_array,
            '#cache' => array(
                'max-age' => '10',
            ),
        );
    }

}