# Working with fields in custom modules
> Examples of getting values from node entities. Ensure the entity
> is of the correct type and the field exists before using these functions.


### Retrieves a field value
```php
  // Returns an array
  $entity->get('field_machine_name')->getValue();

  // Returns a single value string
  $entity->get('field_machine_name')->getString();
```

### Retrieves a taxonomy term name from a field
```php
  // Returns a human-readable taxonomy term name.
  use Drupal\taxonomy\Entity\Term;
  $tid = $entity->get('field_machine_name')->target_id;
  $term = Term::load($tid);
  $term_name = $term->getName();
```

### Retrieves all taxonomy term tids from a field (untested)
```php
  // Rturns an array of TIDs e.g. [0 => ['target_id' => ##], 1 => ['target_id'] => ##]
  // This array then be passed into Term::loadMultiple().
  use Drupal\taxonomy\Entity\Term; // If using Term::loadMultiple()
  $entity->get('field_machine_name')->getValue();
```