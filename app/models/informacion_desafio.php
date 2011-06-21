<?php
class InformacionDesafio extends AppModel {
	var $name = 'InformacionDesafio';
	var $primaryKey = 'id_estadisticas';
	var $belongsTo = array(
	  'Documento' => array(
        'className' => 'Documento',
        'foreignKey' => 'id_documento'
      )
    );
    
    /* virtualFields ftw! */   
    var $virtualFields = array(
    	'total_respuestas' => 'total_respuestas_1_como_desafio + total_respuestas_2_como_desafio',
    	'consenso' => 'ABS(total_respuestas_2_como_desafio - total_respuestas_1_como_desafio)*100/(total_respuestas_1_como_desafio + total_respuestas_2_como_desafio)',
    	'total_app' => 'total_respuestas_2_como_desafio*100/(total_respuestas_1_como_desafio + total_respuestas_2_como_desafio)'
    );

	var $validate = array(
		'total_respuestas_1_no_validado' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'La cantidad de respuestas de tipo 1 para este documento previas a la validación deben ser un valor numérico.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'total_respuestas_2_no_validado' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'La cantidad de respuestas de tipo 2 para este documento previas a la validación deben ser un valor numérico.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),/*
		'respuesta_oficial_de_un_experto' => array(
			'boolean' => array(
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			),*/
		'total_respuestas_1_como_desafio' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'La cantidad de respuestas de tipo 1 para este documento como validado preguntable deben ser un valor numérico.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'total_respuestas_2_como_desafio' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'La cantidad de respuestas de tipo 2 para este documento como validado preguntable  deben ser un valor numérico.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'confirmado' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'La calificación de un documento como confirmado solo puede ser verdadera o falsa.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'preguntable' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'La calificación de un documento como preguntable solo puede ser verdadera o falsa.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	/******* methods *******/	
	/*function afterFind($results, $primary) {
		if($primary) {
			$i = 0;
		  	foreach($results as $r) {
		  		pr($r);
				$results[$i]['InformacionDesafio']['total_respuestas'] =  
					  $results[$i]['InformacionDesafio']['total_respuestas_1_como_desafio']
					+ $results[$i]['InformacionDesafio']['total_respuestas_2_como_desafio'];			
				$i += 1;
		  	}	  	
		}
		return $results;
	}*/
}
?>
