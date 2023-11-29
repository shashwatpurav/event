<?php

namespace Drupal\test_custom_events;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a Events entity.
 * @ingroup test_custom_events
 */
interface EventsInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
