<?php
/**
 * RolesctrlFixture
 *
 */
class RolesctrlFixture extends CakeTestFixture {

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
		'ctrl_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'getAction' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'postAction' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'putAction' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'patchAction' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'deleteAction' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'copyAction' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'headAction' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'optionsAction' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'linkAction' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'unlinkAction' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'purgeAction' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'rolectrl' => array('column' => array('role_id', 'ctrl_id'), 'unique' => 1)
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
			'createdAt' => '2015-08-24 19:51:47',
			'updatedAt' => '2015-08-24 19:51:47',
			'createdBy' => 1,
			'updatedBy' => 1,
			'role_id' => 1,
			'ctrl_id' => 1,
			'getAction' => 1,
			'postAction' => 1,
			'putAction' => 1,
			'patchAction' => 1,
			'deleteAction' => 1,
			'copyAction' => 1,
			'headAction' => 1,
			'optionsAction' => 1,
			'linkAction' => 1,
			'unlinkAction' => 1,
			'purgeAction' => 1
		),
	);

}
