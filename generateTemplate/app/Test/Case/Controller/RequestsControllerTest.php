<?php
App::uses('RequestsController', 'Controller');

/**
 * RequestsController Test Case
 *
 */
class RequestsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.request',
		'app.workstation',
		'app.workarea',
		'app.building',
		'app.buildingspot',
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
