<?php

namespace Drupal\toto\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the toto module.
 */
class DefaultControllerTest extends WebTestBase {
  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => "toto DefaultController's controller functionality",
      'description' => 'Test Unit for module toto and controller DefaultController.',
      'group' => 'Other',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests toto functionality.
   */
  public function testDefaultController() {
    // Check that the basic functions of module toto.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via App Console.');
  }

}
