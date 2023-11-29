# This is a custom module with following functionalities:

1. A custom entity called "Events" with "title" and "event_date" fields.
2. A taxonomy vocabulary named "EventType" with the following terms:
  a. Charity
  b. Sports
  c. Music
3. An "event_type" field to the Events entity. This field is a reference to EventType vocabulary.
4. Validation to the events entity add/edit form with "event_date" required and it should be a future date. Highlight the event_date field in red if valdiation fails using JavaScript.
5. Views and REST export of Events entities with "Entity" format.
6. JSON response of view to display:

{
  "id" : ***,
  "title" : ***,
  "event_date" : ***,
  "event_type" : ***
}
