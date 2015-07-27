<?php
App::uses('Lov', 'Model');

/**
 * Lov Test Case
 *
 */
class LovTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.lov'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Lov = ClassRegistry::init('Lov');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Lov);

		parent::tearDown();
	}

}
