<?php
/**
 * @file
 * Contains \Drupal\event_registartion\RegisteredInterface.
 */

namespace Drupal\event_registration;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Interface EventInterface
 * @ingroup event
 */

interface RegisteredInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
?>
