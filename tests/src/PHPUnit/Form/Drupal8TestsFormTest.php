<?php

/**
 * Demonstrate how to use PHPUnit without Drupal.
 *
 * This file is meant to called by ./scripts/tests/unit-phpunit.sh.
 * See that file for further information.s
 *
 * This file is designed to test Drupal\drupal8tests\Form\Drupal8TestsForm using
 * the standard PHPUnit, which has no knowledge of Drupal. Because
 * Drupal\drupal8tests\Form\Drupal8TestsForm extends \Drupal\Core\Form\FormBase,
 * and one of its tested methods has an argument which must be
 * Drupal\Core\Form\FormStateInterface, we must create these classes here
 * to avoid a class not found error.
 */
namespace Drupal\Core\Form;

/**
 * Do nothing, we require this in order to instantiate the class we are testing.
 */
class FormBase {
}

/**
 * Do nothing, we require this as an argument to a method we are testing.
 */
class FormStateInterface {
}

namespace Drupal\Tests\drupal8tests\Unit\Form;

use Drupal\drupal8tests\Form\Drupal8TestsForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * A PHPUnit based test class.
 *
 * @coversDefaultClass \Drupal\drupal8tests\Form\Drupal8TestsForm
 * @group drupal8tests
 * @group phpunit
 */
class Drupal8TestsFormTest extends \PHPUnit_Framework_TestCase {

  /**
   * Test buildForm().
   */
  public function testBuildForm() {
    // We cannot create Drupal8TestsForm using the new keyword, because
    // our test of buildForm() would attempt to call $this->t() which does
    // not exist in the context of this class. Because we have no interest
    // in testing t() (we assume it works and is tested elsewhere), we will
    // use PHPUnit's mocking capabilities to create a version of
    // Drupal8TestsForm, but which replaces its internal t() method with
    // one we are defining below, in this file.
    $form = $this->getMockBuilder(Drupal8TestsForm::class)
      ->setMethods(array('t'))
      ->getMock();
    $form->method('t')
      ->will($this->returnCallback(array($this, 't')));

    // Now that we have a mock object, we can call buildForm(). That method
    // requires an argument to be a FormStateInterface, but we do not have
    // access to Drupal's FormStateInterface class, which is why we defined
    // our own version, above.
    $result = $form->buildForm(array(), new FormStateInterface());

    $this->assertTrue($result['year']['#description'] == 'Check if a year is a leap year.', 'The result form contains a year element and the correct description.');
  }

  /**
   * Mock version of Drupal8TestsForm::t() used by ::testBuildForm().
   *
   * This method does not actually translate the string, but it is required
   * by Drupal8TestsForm::buildForm(), which we are testing.
   *
   * @param string $string
   *   A string to translate.
   *
   * @return string
   *   A "translated" string. Because we are not testing translation
   *   capabilities, we are simply returning the same string.
   */
  public function t($string) {
    return $string;
  }

}
