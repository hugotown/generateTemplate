<?php
App::uses('BuildingsController', 'Controller');

/**
 * BuildingsController Test Case
 *
 */
class BuildingsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.building',
		'app.workstation',
		'app.workarea',
		'app.request',
		'app.user',
		'app.role',
		'app.rolesctrl',
		'app.ctrl',
		'app.rolestate',
		'app.buildingspot'
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
