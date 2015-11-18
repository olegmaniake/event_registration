<?php
/**
 * @file
 * Contain Drupal\event_registered\Plugin\Block\EventListBlock.
 */

namespace Drupal\event_registration\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\event_registration\Entity\Event;

/**
 * @Block(
 *   id = "event_list_block",
 *   admin_label = @Translation("Event List"),
 * )
 */

class EventListBlock extends BlockBase {

  private function getEvents (){
    $events = \Drupal::entityManager()->getStorage('event')->loadMultiple();
    $return = array();

    foreach ($events as $event) {
      $return[$event->name->value]= $event->name->value;
    }
    return $return;
  }

  public function build() {

   return array(
     '#theme' => 'events',
     '#events' => $this-> getEvents(),
   );
  }
}
