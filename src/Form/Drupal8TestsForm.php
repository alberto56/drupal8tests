<?php

namespace Drupal\drupal8tests\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\drupal8tests\LeapYearChecker;

class Drupal8TestsForm extends FormBase {

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['year'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter a year'),
      '#description' => $this->t('Check if a year is a leap year.'),
      '#required' => TRUE,
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  public function getFormId() {
    return 'drupal8tests_form';
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    $year = $form_state->getValue('year');
    $checker = new LeapYearChecker($year);
    if (!$checker->isValid()) {
      $form_state->setErrorByName('year', $this->t('The year is not valid.'));
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $year = $form_state->getValue('year');
    try {
      $args = [
        '@year' => $year,
        '@count' => $this->checker($year)->numChecks() + 1,
      ];
      $this->drupalSetMessage($this->checker($year)->isLeap() ? t('@year is a leap year (@count check(s))', $args) : t('@year is not a leap year (@count check(s))', $args));
    }
    catch (\Exception $e) {
      $this->drupalSetMessage(t('An error occurred: @error', ['@error' => $e->getMessage()]));
    }
  }

  public function checker($year) {
    return new LeapYearChecker($year);
  }

  public function drupalSetMessage($text) {
    drupal_set_message($text);
  }

}
