<?php
/**
 * @file
 * Contains \Drupal\event_registartion\EventInterface.
 */

namespace Drupal\event_registration;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Interface EventInterface
 * @ingroup event
 */

interface EventInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
?>
