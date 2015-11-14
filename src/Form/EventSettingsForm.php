<?php
/*
 * @file
 * Contains Drupal\event_registration\Form\EventSettingsForm.
 */

namespace Drupal\event_registration\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * @ingroup event_registration
 */

class EventSettingsForm extends FormBase {

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
    $form['event_setings']['#markup'] = 'Settings form for Event. Manege field settings here.';

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

  }
}
