<?php

/**
 * @file
 * Contains \Drupal\event_registration\RegisteredAccessControlHandler;
 */

namespace Drupal\event_registration;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * @ingroup event_registration
 */

class RegisteredAccessControlHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entityInterface, $operation, AccountInterface $accountInterface){
    switch ($operation) {
      case 'view' :
        return AccessResult::allowedIfHasPermission($accountInterface, 'view registered entity');

      case 'edit' :
        return AccessResult::allowedIfHasPermission($accountInterface, 'edit registered entity');

      case 'delete':
        return AccessResult::allowedIfHasPermission($accountInterface, 'delete registered entity');

    }
    return AccessResult::allowed();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess (AccountInterface $accountInterface, array $context, $entity_bundle = NULL){
    return AccessResult::allowedIfHasPermission($accountInterface, 'add registered entity');
  }
}
