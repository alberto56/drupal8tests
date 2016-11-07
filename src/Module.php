<?php

namespace Drupal\drupal8tests;

class Module {

  public function hookSchema() {
    $schema['drupal8tests'] = [
      'description' => 'Stores a history of leap years which have been checked.',
      'fields' => [
        'year' => [
          'type' => 'int',
          'not null' => TRUE,
          'default' => 0,
          'description' => 'The year being checked.',
        ],
        'checks' => [
          'type' => 'int',
          'not null' => TRUE,
          'description' => 'How many times it was checked.',
        ],
      ],
      'unique keys' => ['year' => ['year']],
    ];

    return $schema;
  }

}
