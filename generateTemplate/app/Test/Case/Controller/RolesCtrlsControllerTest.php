<?php
App::uses('RolesctrlsController', 'Controller');

/**
 * RolesctrlsController Test Case
 *
 */
class RolesctrlsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.rolesctrl',
		'app.role',
		'app.rolestate',
		'app.user',
		'app.workstation',
		'app.workarea',
		'app.building',
		'app.buildingspot',
		'app.request',
		'app.ctrl'
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
