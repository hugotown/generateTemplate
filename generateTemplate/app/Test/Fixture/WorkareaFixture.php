<?php
/**
 * WorkareaFixture
 *
 */
class WorkareaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'createdBy' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'updatedBy' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'createdAt' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'updatedAt' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'name' => array('type' => 'string', 'null' => false, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'id' => 1,
			'createdBy' => 1,
			'updatedBy' => 1,
			'createdAt' => '2015-08-07 03:05:44',
			'updatedAt' => '2015-08-07 03:05:44',
			'name' => 'Lorem ipsum dolor sit amet',
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);

}
