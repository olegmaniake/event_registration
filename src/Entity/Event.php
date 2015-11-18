<?php
/*
 * @file
 * Contains \Drupal\event_registration\Entity\Event.
 */

namespace Drupal\event_registration\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\event_registration\EventInterface;
use Drupal\user\UserInterface;
use Drupal\Core\Entity\EntityChangedTrait
;


/**
 * @ingroup event_registration
 *
 * @ContentEntityType(
 *   id = "event",
 *   label = @Translation("Event entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\event_registration\Controller\EventListBuilder",
 *     "form" = {
 *       "add" = "Drupal\event_registration\Form\EventForm",
 *       "edit" = "Drupal\event_registration\Form\EventForm",
 *       "delete" = "Drupal\event_registration\Form\EventDeleteForm",
 *      },
 *     "access" = "Drupal\event_registration\EventAccessControlHandler",
 *   },
 *   list_cache_contexts = { "user" },
 *   base_table = "event",
 *   admin_permission = "administer event_registration entity",
 *   fildable = TRUE,
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "UUID",
 *     "user_id" = "user_id",
 *   },
 *   links = {
 *     "canonical" = "/event/{event}",
 *     "edit-form" = "/event/{event}/edit",
 *     "delete-form" = "/event/{event}/delete",
 *     "collection" = "/event/list",
 *   },
 *   field_ui_base_route = "event.event_settings",
 * )
 */

class Event extends ContentEntityBase implements EventInterface {
  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   * @param \Drupal\Core\Entity\EntityStorageInterface $entityStorageInterface
   * @param array $values
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

  public function getDescription(){
    $description = $this->get('description')->value;
    return strip_tags($description);
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Event entity'))
      ->setReadOnly(TRUE);

    $fields['UUID'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Event entity.'))
      ->setReadOnly(TRUE);


    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Event entity.'))
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

    $fields['description'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Description'))
      ->setDescription(t('The description of Event.'))
      ->setSetting('type', 'text')
      ->setSetting('size', 'big')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -5,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'text_long',
        'settings' => array(
          'placeholder' => 'Enter Description of event in this field.'
        ),
        'weight' => -5,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('User Name'))
      ->setDescription(t('The Name of the associated user.'))
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -3,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'entity_reference_autocomplete',
        'settings' => array(
          'match_operator' => 'CONTAINS',
          'size' => 60,
          'placeholder' => '',
        ),
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
