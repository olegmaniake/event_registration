<?php
/**
 * @file
 * Contain Drupal\event_registered\Plugin\Block\EventListBlock.
 */

namespace Drupal\event_registration\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\event_registration\Controller\EventListBuilder;
use Drupal\event_registration\Entity\Event;

/**
 * @Block(
 *   id = "event_list_block",
 *   admin_label = @Translation("Event List"),
 * )
 */

class EventListBlock extends BlockBase {

  public function getUserId(){
    return \Drupal::currentUser()->id();
  }
  /**
   * @return array
   */
  public function build() {
    /* @var $entity \Drupal\event_registration\Entity\Event*/


   return \Drupal::entityManager()->getStorage('event')->loadByProperties(array('user_id' =>  $this->getUserId()));
  }
}
