<?php
App::uses('WorkareasController', 'Controller');

/**
 * WorkareasController Test Case
 *
 */
class WorkareasControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.workarea',
		'app.workstation',
		'app.building',
		'app.buildingspot',
		'app.user',
		'app.role',
		'app.rolesctrl',
		'app.ctrl',
		'app.rolestate',
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
