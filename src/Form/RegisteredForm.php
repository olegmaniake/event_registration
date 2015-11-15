<?php
/**
 * @file
 * Contains Drupal\event_registration\Form\RegisteredForm.
 */

namespace Drupal\event_registration\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Language\Language;
use Drupal\Core\Form\FormStateInterface;
use Drupal\event_registration\EventInterface;

/**
 * Form controller for the content_entity_example entity edit forms.
 *
 * @ingroup event_registration
 */
class RegisteredForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\event_registration\Entity\Registered */
    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;

    $event_id = \Drupal::request()->attributes->get('event');
    $event = \Drupal::entityManager()->getStorage('event')->load($event_id);


    $form['event_registered']['widget'][0]['target_id']['#default_value'] = $event;
    $form['langcode'] = array(
      '#title' => $this->t('Language'),
      '#type' => 'language_select',
      '#default_value' => $entity->getUntranslated()->language()->getId(),
      '#languages' => Language::STATE_ALL,
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $form_state->setRedirect('entity.registered.collection');
    $entity = $this->getEntity();
    $entity->save();
  }
}
