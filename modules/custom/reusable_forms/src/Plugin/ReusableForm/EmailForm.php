<?php

namespace Drupal\reusable_forms\Plugin\ReusableForm;

use Drupal\reusable_forms\ReusableFormPluginBase;

/**
 * Provides an email form.
 *
 * @ReusableForm(
 *   id = "email_form",
 *   name = @Translation("Email Form"),
 *   form = "Drupal\reusable_forms\Form\EmailForm"
 * )
 */
class EmailForm extends ReusableFormPluginBase {

}