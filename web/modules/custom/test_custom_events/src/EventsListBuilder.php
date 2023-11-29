<?php

namespace Drupal\test_custom_events;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;
use Drupal\taxonomy\Entity\Term;

/**
 * Provides a list controller for test_custom_events_event entity.
 *
 * @ingroup test_custom_events
 */
class EventsListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   *
   * We override ::render() so that we can add our own content above the table.
   * parent::render() is where EntityListBuilder creates the table using our
   * buildHeader() and buildRow() implementations.
   */
  public function render() {

    $build['description'] = [
      '#markup' => $this->t('Content Entity implements a Event model. These events are fieldable entities. You can manage the fields on the <a href="@adminlink">Events admin page</a>.', array(
        '@adminlink' => Url::fromRoute('test_custom_events.event_settings', [], ['absolute' => 'true'])->toString(),
      )),
    ];

    $build += parent::render();

    return $build;
  }

  /**
   * {@inheritdoc}
   *
   * Building the header and content lines for the event list.
   *
   * Calling the parent::buildHeader() adds a column for the possible actions
   * and inserts the 'edit' and 'delete' links as defined for the entity type.
   */
  public function buildHeader() {

    $header['id'] = $this->t('Event ID');
    $header['title'] = $this->t('Title');
    $header['event_type'] = $this->t('Event Type');
    $header['event_date'] = $this->t('Event Date');

    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {

    // Get term name from term ID.
    $eventType = '';
    $eventTypeTargetId = $entity->event_type->target_id;

    if ($eventTypeTargetId) {
      $eventType = $this->getTermNameFromId($eventTypeTargetId);
    }

    /* @var $entity \Drupal\test_custom_events\Entity\Events */
    $row['id'] = $entity->id();
    $row['title'] = $entity->title->value;
    $row['event_type'] = !empty($eventType) ? $eventType : '';
    $row['event_date'] = $entity->event_date->value;

    return $row + parent::buildRow($entity);
  }

  /**
   * Helper function to get term name from term ID.
   *
   * @param int $termId
   *   The ID of the term.
   *
   * @return string|null
   *   The term name or NULL if the term does not exist.
   */
  public function getTermNameFromId($termId) {

    // Load the term using TermStorageInterface.
    $term_storage = \Drupal::entityTypeManager()->getStorage('taxonomy_term');
    $term = $term_storage->load($termId);

    // Check if the term exists.
    if ($term instanceof Term) {
      // Get the term name.
      return $term->getName();
    }

    // Return NULL if the term does not exist.
    return NULL;
  }

}
