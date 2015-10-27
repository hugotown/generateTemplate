<?php
App::uses('Rolestate', 'Model');

/**
 * Rolestate Test Case
 *
 */
class RolestateTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.rolestate',
		'app.role',
		'app.rolesctrl',
		'app.ctrl',
		'app.user',
		'app.workstation',
		'app.workarea',
		'app.building'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Rolestate = ClassRegistry::init('Rolestate');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Rolestate);

		parent::tearDown();
	}

}
