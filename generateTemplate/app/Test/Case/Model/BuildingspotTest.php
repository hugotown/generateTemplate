<?php
App::uses('Buildingspot', 'Model');

/**
 * Buildingspot Test Case
 *
 */
class BuildingspotTest extends CakeTestCase {

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
		'app.user',
		'app.role',
		'app.rolesctrl',
		'app.ctrl',
		'app.rolestate'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Buildingspot = ClassRegistry::init('Buildingspot');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Buildingspot);

		parent::tearDown();
	}

}
