<?php
App::uses('RolestatesController', 'Controller');

/**
 * RolestatesController Test Case
 *
 */
class RolestatesControllerTest extends ControllerTestCase {

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
		'app.building',
		'app.buildingspot',
		'app.request'
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
