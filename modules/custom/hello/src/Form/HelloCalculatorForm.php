<?php

/**
 * @file
 * Contains \Drupal\hello\Form\HelloCalculatorForm
 */
namespace Drupal\hello\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements an Hello Calculator form
 */
class HelloCalculatorForm extends FormBase{

    /**
     * {@inheritdoc}
     */
    public function getFormId(){
        return 'hello_calculator_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state){
        $form['champ_texte_1'] = array(
            '#type' => 'textfield',
            '#title' => t('First value*'),
            '#description' => t('Enter the first value'),
            '#size' => '40',
            '#maxlengh' => '128',
            '#default_value' => '0',
            '#attributes' => array('placeholder' => 0),
            '#ajax' => array(
                'callback' => array($this, 'validateNumericFieldAjax'),
                'event' => 'change',
            ),
            '#suffix' => '<span class="text-message1"></span>',
            //'#element_validate' => array('element_validate_number'),
        );

        $form['champ_radios'] = array(
            '#type' => 'radios',
            '#title' => t('Operation'),
            '#default_value' => 1,
            '#options' => array(0 => t('Add'), 1 => t('Soustract'), 2 => t('Multiply'), 3 => t('Divide')),
            '#description' => t('Choose operation for processing'),
        );

        $form['champ_texte_2'] = array(
            '#type' => 'textfield',
            '#title' => t('Second value*'),
            '#description' => t('Enter the second value'),
            '#size' => '40',
            '#maxlengh' => '128',
            '#default_value' => '0',
            '#attributes' => array('placeholder' => 0),
            '#ajax' => array(
                'callback' => array($this, 'validateNumericFieldAjax'),
                'event' => 'change',
            ),
            '#suffix' => '<span class="text-message2"></span>',
            //'#element_validate' => array('element_validate_number'),
        );

        $form['champ_select'] = [
            '#type' => 'select',
            '#title' => t('View results on ...'),
            '#description' => t('Choose the display of results'),
            '#options' => [
                '0' => t('Redirect page'),
                '1' => t('Reload form'),
            ],
            '#default_value' => '0',
        ];

        if($form_state->isSubmitted() /*&& !isEmpty($form_state->getTemporary())*/){
            echo 'Test ';
            //kint($form_state->getTemporary());
            $form['champ_texte_result'] = array(
                '#markup' => "Résultat : ".$form_state->getTemporary()['result'] ."</br>",
                //'#element_validate' => array('element_validate_number'),
            );
        }

        $form['bouton_submit'] = array(
            '#type' => 'submit',
            '#value' => t('Calculate'),
        );


        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state){
        $field_value_first = $form_state->getValue('champ_texte_1');
        $field_value_second = $form_state->getValue('champ_texte_2');
        $field_value_operations = $form_state->getValue('champ_radios');
        $field_value_display_results = $form_state->getValue('champ_select');

        switch ($field_value_operations) {
            case 0:
                $result = $field_value_first + $field_value_second;
                break;
            case 1:
                $result = $field_value_first - $field_value_second;
                break;
            case 2:
                $result = $field_value_first * $field_value_second;
                break;
            case 3:
                $result = $field_value_first / $field_value_second;
                break;
        }
        $tab_result = array(
          'value1' => $field_value_first,
          'value2' => $field_value_second,
          'operation' => $field_value_operations,
          'result' => $result,
        );

        if($field_value_display_results == 0){
            $form_state->setRedirect('hello.calculator_result', $tab_result);
        } else {
            $form_state->setTemporary($tab_result);
            $form_state->setRebuild();
        }
    }

    public function validateForm(array &$form, FormStateInterface $form_state){
        $field_value_first = $form_state->getValue('champ_texte_1');
        $field_value_second = $form_state->getValue('champ_texte_2');
        $field_value_operations = $form_state->getValue('champ_radios');

        if(!is_numeric($field_value_first)){
            $form_state->setErrorByName('champ_texte_1', t('Field must be numeric'));
        }

        if(!is_numeric($field_value_second)){
            $form_state->setErrorByName('champ_texte_2', t('Field must be numeric'));
        }

        if($field_value_second == 0 && $field_value_operations == 3){
            $form_state->setErrorByName('champ_texte_2', t('No division by 0'));
        }
    }

    public function validateNumericFieldAjax(array &$form, FormStateInterface $form_state){
        $field_value_first = $form_state->getValue('champ_texte_1');
        $field_value_second = $form_state->getValue('champ_texte_2');

        $response = new AjaxResponse();

        if(!is_numeric($field_value_first)){
            $css1 = ['border' => '2px solid red'];
            $message1 = 'Field must be numeric';
        } else{
            $css1 = ['border' => '2px solid green'];
            $message1 = '';
        }

        $response->addCommand(new HtmlCommand('.text-message1', $message1));
        $response->addCommand(new CssCommand('#edit-champ-texte-1', $css1));

        if(!is_numeric($field_value_second)){
            $css2 = ['border' => '2px solid red'];
            $message2 = 'Field must be numeric';
        } else{
            $css2 = ['border' => '2px solid green'];
            $message2 = '';
        }

        $response->addCommand(new HtmlCommand('.text-message2', $message2));
        $response->addCommand(new CssCommand('#edit-champ-texte-2', $css2));

        return $response;
    }
}