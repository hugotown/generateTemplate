<?php
App::uses('BuildingspotsController', 'Controller');

/**
 * BuildingspotsController Test Case
 *
 */
class BuildingspotsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.buildingspot',
		'app.building',
		'app.workstation',
		'app.workarea',
		'app.request',
		'app.user',
		'app.role',
		'app.rolesctrl',
		'app.ctrl',
		'app.rolestate'
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
