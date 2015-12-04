<?php
/**
 * BuildingspotFixture
 *
 */
class BuildingspotFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'createdAt' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'updatedAt' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'createdBy' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'updatedBy' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'building_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'name' => array('type' => 'string', 'null' => false, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'spotNumber' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'lov_spot_section' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'name' => array('column' => 'name', 'unique' => 1),
			'building_id' => array('column' => 'building_id', 'unique' => 0)
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
			'createdAt' => '2015-12-04 23:14:09',
			'updatedAt' => '2015-12-04 23:14:09',
			'createdBy' => 1,
			'updatedBy' => 1,
			'building_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'spotNumber' => 1,
			'lov_spot_section' => 'Lorem ipsum dolor sit amet'
		),
	);

}
