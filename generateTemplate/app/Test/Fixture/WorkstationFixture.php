<?php
/**
 * WorkstationFixture
 *
 */
class WorkstationFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'createdAt' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'updatedAt' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'createdBy' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'updatedBy' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'parent_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'role' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'employeeNumber' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'workarea' => array('type' => 'string', 'null' => false, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'store_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'description' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'status' => array('type' => 'string', 'null' => false, 'default' => 'active', 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'parent_id' => array('column' => array('parent_id', 'name', 'employeeNumber'), 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'createdAt' => '2015-07-19 18:33:02',
			'updatedAt' => '2015-07-19 18:33:02',
			'createdBy' => 1,
			'updatedBy' => 1,
			'parent_id' => 1,
			'lft' => 1,
			'rght' => 1,
			'role' => 'Lorem ipsum dolor sit amet',
			'name' => 'Lorem ipsum dolor sit amet',
			'employeeNumber' => 1,
			'workarea' => 'Lorem ipsum dolor sit amet',
			'store_id' => 1,
			'description' => 'Lorem ipsum dolor sit amet',
			'status' => 'Lorem ipsum dolor sit amet'
		),
	);

}
