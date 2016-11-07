<?php

namespace Drupal\drupal8tests;

class LeapYearChecker {

  public function __construct($year) {
    $this->year = $year;
  }

  public function isValid() {
    return is_numeric($this->year);
  }

  public function isLeap() {
    $year = $this->year;
    if (!$this->isValid()) {
      throw new \Exception('Invalid year');
    }
    if ($this->isValid()) {
      try {
        $this->track();
      }
      catch (\Exception $e) {
        drupal_set_message(t('An error occured while tracking: @e', ['@e' => $e->getMessage()]));
      }
    }
    return ((($year % 4 == 0) && ($year % 100 != 0)) || $year % 400 == 0);
  }

  public function track() {
    if ($num_checks = $this->numChecks()) {
      $this->setNumChecks($num_checks + 1);
    }
    else {
      $this->startTracking();
    }
  }

  public function numChecks() {
    $select = db_select('drupal8tests', 't');
    $select->addField('t', 'checks');
    $select->condition('t.year', $this->year);
    $result = $select->execute()->fetchAll();

    $rows = array();
    foreach ($result as $entry) {
      $rows[] = array_map('Drupal\Component\Utility\SafeMarkup::checkPlain', (array) $entry);
    }
    foreach ($rows as $row) {
      $candidate = $row['checks']->__toString();
      if (!is_numeric($candidate)) {
        throw new Exception('Number of checks is expected to be numeric.');
      }
      return $candidate;
    }
    return 0;
  }

  public function setNumChecks($num_checks) {
    $count = db_update('drupal8tests')
      ->fields([
        'checks' => $num_checks,
      ])
      ->condition('year', $this->year)
      ->execute();
  }

  public function startTracking() {
    db_insert('drupal8tests')
      ->fields([
        'year' => $this->year,
        'checks' => 1,
      ])
      ->execute();
  }

}
