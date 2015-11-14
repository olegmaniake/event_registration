<?php
/*
 * @file
 * Contains Drupal\event_registration\Form\RegisteredSettingsForm.
 */

namespace Drupal\event_registration\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * @ingroup event_registration
 */

class RegisteredSettingsForm extends FormBase {

  /**
   * {@inheritdoc}
   */

  public function getFormId() {
    return 'event_registration_setings';
  }

  /**
   * {@inheritdoc}
   */

  public function buildForm(array $form, FormStateInterface $form_state){
    $form['registered_setings']['#markup'] = 'Settings form for Registered. Manege field settings here.';

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

  }
}
