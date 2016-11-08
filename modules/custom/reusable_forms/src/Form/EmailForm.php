<?php

namespace Drupal\reusable_forms\Form;

use Drupal\Core\Form\FormStateInterface;

/**
 * Defines the EmailForm class.
 */
class EmailForm extends ReusableFormBase {

    /**
     * {@inheritdoc}.
     */
    public function getFormId() {
        return 'email_form';
    }

    /**
     * {@inheritdoc}.
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['email'] = array(
            '#type' => 'email',
            '#title' => t('Email'),
            '#description' => t('Suscribe to this article'),
        );

        $form = parent::buildForm($form, $form_state);

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $database = \Drupal::database();

        $database->insert('article_email')
            ->fields(array(
                'uid' => \Drupal::currentUser()->id(),
                'email' => $form_state->getValue('email'),
                'timestamp' => time(),
            ))
            ->execute();
    }

    public function validateForm(array &$form, FormStateInterface $form_state){
        !(\Drupal::service('email.validator')->isValid($form_state->getValues('email')));
        parent::validateForm($form, $form_state);
    }
}
