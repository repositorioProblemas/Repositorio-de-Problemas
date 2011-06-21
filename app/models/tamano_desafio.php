<?php
class TamanoDesafio extends AppModel {
	var $name = 'TamanoDesafio';
	var $primaryKey = 'id_desafio';
	var $belongsTo = array(
	  'Usuario' => array(
		'className' => 'Usuario',
		'foreignKey' => 'id_usuario'
      ));

	var $validate = array(
		'c_preguntas' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'The number of questions per criterion for a particular user must be a numeric value.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
?>
