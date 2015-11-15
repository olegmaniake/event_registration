<?php

/**
 * @file
 * Contains \Drupal\event_registration\EventAccessControlHandler;
 */

namespace Drupal\event_registration;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * @ingroup event_registration
 */

class EventAccessControlHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entityInterface, $operation, AccountInterface $accountInterface){
    switch ($operation) {
      case 'view' :
        return AccessResult::allowedIfHasPermission($accountInterface, 'view event entity');

      case 'edit' :
        return AccessResult::allowedIfHasPermission($accountInterface, 'edit event entity');

      case 'delete':
        return AccessResult::allowedIfHasPermission($accountInterface, 'delete event entity');

      case 'update':
        return AccessResult::allowedIfHasPermission($accountInterface, 'edit event entity');

    }
    return AccessResult::isAllowed();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess (AccountInterface $accountInterface, array $context, $entity_bundle = NULL){
    return AccessResult::allowedIfHasPermission($accountInterface, 'add event entity');
  }
}
