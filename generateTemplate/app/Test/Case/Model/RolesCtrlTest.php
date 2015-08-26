<?php
App::uses('Rolesctrl', 'Model');

/**
 * Rolesctrl Test Case
 *
 */
class RolesctrlTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.rolesctrl',
		'app.role',
		'app.ctrl'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Rolesctrl = ClassRegistry::init('Rolesctrl');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Rolesctrl);

		parent::tearDown();
	}

}
