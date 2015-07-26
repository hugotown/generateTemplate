<?php
App::uses('Workstation', 'Model');

/**
 * Workstation Test Case
 *
 */
class WorkstationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.workstation',
		'app.store',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Workstation = ClassRegistry::init('Workstation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Workstation);

		parent::tearDown();
	}

}
