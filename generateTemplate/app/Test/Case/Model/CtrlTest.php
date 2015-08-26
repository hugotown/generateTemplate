<?php
App::uses('Ctrl', 'Model');

/**
 * Ctrl Test Case
 *
 */
class CtrlTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ctrl',
		'app.rolesctrl',
		'app.role',
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
		$this->Ctrl = ClassRegistry::init('Ctrl');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Ctrl);

		parent::tearDown();
	}

}
