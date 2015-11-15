<?php
/*
 * @file
 * Contains \Drupal\event_registration\Controller\EventListBuilder
 */

namespace Drupal\event_registration\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;

/**
 * @ingroup event
 */

class EventListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */

  public function render() {
    $build['description'] = array(
      '#markup' => $this->t('Event entity list. You can manage the fields on the
       <a href="@adminlink"> Event admin page</a>.',
      array(
        '@adminlink' => \Drupal::urlGenerator()->generateFromRoute('event.event_settings'),
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
    $header['name'] = $this->t('Name');
    $header['description'] = $this->t('Description');

    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */

  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\event_registration\Entity\Event*/
    $row['id'] = $entity->id();
    $row['name'] = $entity->link();
    $row['description'] = $entity->getDescription();

    return $row + parent::buildRow($entity);
  }
}
