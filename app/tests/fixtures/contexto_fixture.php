<?php
/* Contexto Fixture generated on: 2011-04-22 22:15:36 : 1303524936 */
class ContextoFixture extends CakeTestFixture {
	var $name = 'Contexto';

	var $fields = array(
		'id_contexto' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 255, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id_contexto', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id_contexto' => 1,
			'nombre' => 'Lorem ipsum dolor sit amet'
		),
	);
}
?>