<?php
/**
 * LovFixture
 *
 */
class LovFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'createdAt' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'updatedAt' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'createdBy' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'updatedBy' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'orderShow' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'lovType' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name_' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name_es_MX' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name_en_US' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'status' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'createdAt' => '2015-07-26 23:25:51',
			'updatedAt' => '2015-07-26 23:25:51',
			'createdBy' => 1,
			'updatedBy' => 1,
			'orderShow' => 1,
			'lovType' => 'Lorem ipsum dolor sit amet',
			'name_' => 'Lorem ipsum dolor sit amet',
			'name_es_MX' => 'Lorem ipsum dolor sit amet',
			'name_en_US' => 'Lorem ipsum dolor sit amet',
			'status' => 'Lorem ipsum dolor sit amet',
			'parent_id' => 1,
			'id' => 1
		),
	);

}
