<?php

/**
 * @file
 * Contains \Drupal\hello\Form\HelloBlockColorsForm
 */
namespace Drupal\hello\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

/**
 * Implements an Hello Block Colors form
 */
class HelloBlockColorsForm extends ConfigFormBase{

    /**
     * {@inheritdoc}
     */
    public function getFormId(){
        return 'hello_block_colors_form';
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames(){
        return ['hello.config'];
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state){

        $form['champ_select'] = [
            '#type' => 'select',
            '#title' => t('Colors'),
            '#options' => [
                'green-class' => t('Green'),
                'orange-class' => t('Orange'),
                'blue-class' => t('Blue'),
            ],
            '#default_value' => $this->config('hello.config')->get('color'),
        ];

        return parent::buildForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state){
        $field_value_select = $form_state->getValue('champ_select');

        /*switch ($field_value_select) {
            case 'green-class':
                $block_color = 'Green';
                break;
            case 'orange-class':
                $block_color = 'Orange';
                break;
            case 'blue-class':
                $block_color = 'Blue';
                break;
        }*/
        $tab_result = array(
            'color' => $field_value_select,
        );

        $state = \Drupal::state();
        $state->set('hello.block_colors_last', REQUEST_TIME);

        $this->config('hello.config')->set('color', $field_value_select)->save();
        \Drupal::entityTypeManager()->getViewBuilder('block')->resetCache();

        $form_state->setTemporary($tab_result);
        $form_state->setRebuild();

        parent::submitForm($form, $form_state);
    }

    public function validateForm(array &$form, FormStateInterface $form_state){

    }
}