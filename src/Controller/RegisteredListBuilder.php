<?php
/*
 * @file
 * Contains \Drupal\event_registration\Controller\RegisteredListBuilder
 */

namespace Drupal\event_registration\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;

/**
 * @ingroup event
 */

class RegisteredListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */

  public function render() {
    $build['description'] = array(
      '#markup' => $this->t('Registered entity list. You can manage the fields on the
       <a href="@adminlink"> Registered admin page</a>.',
        array(
          '@adminlink' => \Drupal::urlGenerator()->generateFromRoute('registered.registered_settings'),
        )),
    );
    $build['table'] = parent::render();
    return $build;
  }

  /**
   * {@inheritdoc}
   */

  public function buildHeader() {
    $header['id'] = $this->t('EventID');
    $header['first_name'] = $this->t('First Name');
    $header['surname'] = $this->t('Surname');
    $header['event_registered'] = $this->t('Event');
    $header['number'] = $this->t('Number of tickets');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */

  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\event_registration\Entity\Registered */
    $row['id'] = $entity->id();;
    $row['first_name'] = $entity->first_name->value;
    $row['surname'] = $entity->surname->value;
    $row['event_registered'] = $entity->getEventRegistered();
    $row['number'] = $entity->number->value;;

    return $row + parent::buildRow($entity);
  }
}
