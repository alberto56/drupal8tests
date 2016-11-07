<?php

namespace Drupal\Tests\drupal8tests\Unit\Form;

use Drupal\drupal8tests\Form\Drupal8TestsForm;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass \Drupal\drupal8tests\Form\Drupal8TestsForm
 * @group drupal8tests
 */
class Drupal8TestsFormTest extends UnitTestCase {

  /**
   * Tests that hello is true.
   */
  public function testHello() {
    $this->assertTrue(TRUE, 'hello');
    $this->assertTrue(TRUE, 'hello');
    $this->assertTrue(TRUE, 'hello');
    $this->assertTrue(FALSE, 'hello');
    $this->assertTrue(TRUE, 'hello');
    $this->assertTrue(TRUE, 'hello');
  }

  /**
   * Tests that hello is true.
   */
  public function testHello2() {
    $this->assertTrue(TRUE, 'hello');
    $this->assertTrue(TRUE, 'hello');
    $this->assertTrue(TRUE, 'hello');
    $this->assertTrue(TRUE, 'hello');
    $this->assertTrue(TRUE, 'hello');
    $this->assertTrue(TRUE, 'hello');
  }

}
