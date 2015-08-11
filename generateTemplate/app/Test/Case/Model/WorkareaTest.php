<?php
App::uses('Workarea', 'Model');

/**
 * Workarea Test Case
 *
 */
class WorkareaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.workarea',
		'app.workstation',
		'app.building',
		'app.user',
		'app.group'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Workarea = ClassRegistry::init('Workarea');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Workarea);

		parent::tearDown();
	}

}
