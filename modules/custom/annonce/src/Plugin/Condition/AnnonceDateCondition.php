<?php
namespace Drupal\annonce\Plugin\Condition;

use Drupal\Core\Condition\Annotation\Condition;
use Drupal\Core\Condition\ConditionPluginBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;

/**
 * Provides a date condition
 *
 * @condition(
 *     id = "annonce_date_condition",
 *     label = @Translation("Date"),
 * )
 */
class AnnonceDateCondition extends ConditionPluginBase implements ContainerFactoryPluginInterface {
    public function __construct(array $configuration, $plugin_id, $plugin_definition) {
        parent::__construct($configuration, $plugin_id, $plugin_definition);
    }

    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition){
        return new static(
            $configuration,
            $plugin_id,
            $plugin_definition
        );
    }

    public function buildConfigurationForm(array $form, FormStateInterface $form_state){

        $form['begin_date'] = array(
            '#type' => 'date',
            '#title' => t('Begin date'),
            '#default_value' => $this->configuration['begin_date'],
            '#description' => t('Select the begin date of the block display'),
            //'#attributes' => array('type'=> 'date', 'min'=> '-25 years', 'max' => '+5 years' ), //Restrict date range
        );

        $form['end_date'] = array(
            '#type' => 'date',
            '#title' => t('End date'),
            '#default_value' => $this->configuration['end_date'],
            '#description' => t('Select the end date of the block display'),
        );

        //$form['negate']['#access'] = FALSE;

        //return parent::buildConfigurationForm($form, $form_state);
        return $form;
    }

    public function submitConfigurationForm(array &$form, FormStateInterface $form_state){
        $this->configuration['begin_date'] = $form_state->getValue('begin_date');
        $this->configuration['end_date'] = $form_state->getValue('end_date');
        parent::submitConfigurationForm($form, $form_state);
    }

    public function validateConfigurationForm(array &$form, FormStateInterface $form_state) {
        $begin_date_value = strtotime($form_state->getValue('begin_date'));
        $end_date_value = strtotime($form_state->getValue('end_date'));

        if($begin_date_value != "" && $end_date_value != "" && $begin_date_value > $end_date_value){
            $form_state->setErrorByName('begin_date', t('Error ! Begin date must be before end date.'));
            $form_state->setErrorByName('end_date');
        }
    }

    public function summary(){
        //return $this->t('Manage blocks display with dates');
        return array();
    }

    public function evaluate(){
        $begin_date = $this->configuration['begin_date'];
        $end_date = $this->configuration['end_date'];

        // No date
        if((!(isset($begin_date)) || $begin_date == "") && ((!(isset($end_date))) || $end_date == "")){
            return TRUE;
        }
        // Only begin date
        elseif(isset($begin_date) && $begin_date != "" && strtotime($begin_date) <= time() && ((!(isset($end_date))) || $end_date == "")) {
            return TRUE;
        }
        // Only end date
        elseif(isset($end_date) && $end_date != "" && strtotime($end_date) >= time() && ((!(isset($begin_date))) || $begin_date == "")) {
            return TRUE;
        }
        // Begin and end dates
        elseif(isset($begin_date) && $begin_date != "" && isset($end_date) && $end_date != "" && strtotime($begin_date) <= time() && strtotime($end_date) >= time()) {
            return TRUE;
        }
        else{
            return FALSE;
        }

        return FALSE;
    }

    public function defaultConfiguration(){
        return array('test' => array()) + parent::defaultConfiguration();
    }
}