<?php
/**
 * RolestateFixture
 *
 */
class RolestateFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'createdAt' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'updatedAt' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'createdBy' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'updatedBy' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'role_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'statename' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'accessit' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'rolectrl' => array('column' => array('role_id', 'statename'), 'unique' => 1)
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
			'createdAt' => '2015-09-23 18:21:31',
			'updatedAt' => '2015-09-23 18:21:31',
			'createdBy' => 1,
			'updatedBy' => 1,
			'role_id' => 1,
			'statename' => 'Lorem ipsum dolor sit amet',
			'accessit' => 1
		),
	);

}
