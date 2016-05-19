<?php

namespace Drupal\example_event_subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
// The event we want to subscribe to.
use Drupal\usasearch\IndependenceDayApiEvents;
use Drupal\usasearch\IndependenceDayApiRequestEvent;

/**
 * Subscribe to a usasearch.request event.
 */
class Subscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    return array(IndependenceDayApiEvents::REQUEST => array('onApiRequest', 0));
  }

  /**
   * This method is called whenever the IndependenceDayApiEvents::REQUEST event is
   * dispatched.
   *
   * @param Drupal\usasearch\IndependenceDayApiRequestEvent
   *   Event object.
   */
  public function onApiRequest(IndependenceDayApiRequestEvent $event) {
    $options = $event->getOptions();
    $body = json_decode($options['body']);
    drupal_set_message($body->title . ' was indexed.');
  }
}
