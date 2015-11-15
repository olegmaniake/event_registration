<?php
/*
 * @file registered
 * Contains \Drupal\event_registration\Entity\Registered.
 */

namespace Drupal\event_registration\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\event_registration\RegisteredInterface;
use Drupal\user\UserInterface;
use Drupal\Core\Entity\EntityChangedTrait
  ;


/**
 * @ingroup event_registration
 *
 * @ContentEntityType(
 *   id = "registered",
 *   label = @Translation("Registered entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\event_registration\Controller\RegisteredListBuilder",
 *     "form" = {
 *       "add" = "Drupal\event_registration\Form\RegisteredForm",
 *       "edit" = "Drupal\event_registration\Form\RegisteredForm",
 *       "delete" = "Drupal\event_registration\Form\RegisteredDeleteForm",
 *      },
 *     "access" = "Drupal\event_registration\RegisteredAccessControlHandler",
 *   },
 *   list_cache_contexts = { "user" },
 *   base_table = "registered",
 *   admin_permission = "administer event_registration entity",
 *   fildable = TRUE,
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "UUID",
 *     "first_name" = "first_name",
 *     "surname" = "surname",
 *     "event_registered" = "event_registered",
 *     "number" = "number",
 *   },
 *   links = {
 *     "canonical" = "/registered/{registered}",
 *     "edit-form" = "/registered/{registered}/edit",
 *     "delete-form" = "/registered/{registered}/delete",
 *     "collection" = "/registered/list",
 *   },
 *   field_ui_base_route = "registered.registered_settings",
 * )
 */

class Registered extends ContentEntityBase implements RegisteredInterface {
  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $entityStorageInterface, array &$values){
    parent::preCreate($entityStorageInterface, $values);
    $values += array(
      'user_id' => \Drupal::currentUser()->id(),
    );
  }

  /**
   * {@inheritdoc}
   */

  public function getCreatedTime(){
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */

  public function getChangedTime() {
    return $this->get('changed')->value;
  }

  /**
   * {@inheritdoc}
   */

  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */

  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */

  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */

  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  public function getEventRegistered(){
    $event_id = $this->get('event_registered')->target_id;
    $event = Event::load($event_id);

    return $event->get('name')->value;
  }




  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Registered entity'))
      ->setReadOnly(TRUE);

    $fields['UUID'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Registered entity.'))
      ->setReadOnly(TRUE);


    $fields['first_name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('First Name'))
      ->setDescription(t('The First Name of the registered entity.'))
      ->setSettings(array(
        'default_value' => '',
        'max_length' => 255,
        'text_processing' => 0,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -6,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string',
        'weight' => -6,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['surname'] = BaseFieldDefinition::create('string')
      ->setLabel(t('surename'))
      ->setDescription(t('The Surname of the registered entity.'))
      ->setSettings(array(
        'default_value' => '',
        'max_length' => 255,
        'text_processing' => 0,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -5,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string',
        'weight' => -5,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['event_registered'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Event'))
      ->setDescription(t('The event to which the user is logged in.'))
      ->setSetting('target_type', 'event')
      ->setSetting('handler', 'default')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'entity_reference',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'entity_reference_autocomplete',
        'settings' => array(
          'match_operator' => 'CONTAINS',
          'size' => 60,
          'placeholder' => '',
        ),
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['number'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Number'))
      ->setDescription(t('The Number of tickets'))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'integer',
        'weight' => -3,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'integer',
        'weight' => -3,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['langcode'] = BaseFieldDefinition::create('language')
      ->setLabel(t('Language code'))
      ->setDescription(t('The language code of ContentEntityExample entity.'));

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;

  }
}
