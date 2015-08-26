<?php
App::uses('RolesController', 'Controller');

/**
 * RolesController Test Case
 *
 */
class RolesControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.role',
		'app.rolesctrl',
		'app.ctrl',
		'app.user',
		'app.workstation',
		'app.workarea',
		'app.building'
	);

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
		$this->markTestIncomplete('testIndex not implemented.');
	}

/**
 * testApi method
 *
 * @return void
 */
	public function testApi() {
		$this->markTestIncomplete('testApi not implemented.');
	}

}
