<?php
class Criterio extends AppModel {
	var $name = 'Criterio';
	var $displayField = 'pregunta';
	var $primaryKey = 'id_criterio';
	
	var $hasMany = array(
		'TamanoDesafio' => array(
			'className' => 'TamanoDesafio',
			'foreignKey' => 'id_criterio',
			'dependent' => true
		)
	); 
	var $validate = array(
		'pregunta' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'The question for the criterion must be non-empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'respuesta_1' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'The possible answers for the criterion cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'respuesta_2' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'The possible answers for the criterion cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'tamano_pack' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'The pack size must be a numeric value.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'costo_pack' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'The pack cost must be a numeric value',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'costo_envio' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'El costo de enviar un documento (los puntos con los que se puede enviar) deben ser un valor numérico',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'bono_documento_enviado_validado' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'The bonus points received for a validated document must be a numeric value',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'funcion_penalizacion_a' => array(
			'decimal' => array(
				'rule' => array('numeric'),
				'message' => 'The lineal factor on the penalization function must be a numeric value.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'funcion_penalizacion_b' => array(
			'decimal' => array(
				'rule' => array('numeric'),
				'message' => 'The constant value on the penalization function must be a numeric value.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'funcion_despenalizacion_a' => array(
			'decimal' => array(
				'rule' => array('numeric'),
				'message' => 'The lineal factor on the despenalization function must be a numeric value.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'funcion_despenalizacion_b' => array(
			'decimal' => array(
				'rule' => array('numeric'),
				'message' => 'The constant value on the despenalization function must be a numeric value.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'tamano_minimo_desafio' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'The minimum size of a challenge must be a numeric value.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	// actualiza los documentos agregando el nuevo criterio a InfoDesafio
	// y los usuarios, con TamanoDesafio
	function afterSave($created) {
		if($created) {
			App::import('Model', 'InformacionDesafio');
			App::import('Model', 'Documento');
			
			App::import('Model', 'TamanoDesafio');
			App::import('Model', 'Usuario');
			
			$Doc = new Documento;
			$ID = new InformacionDesafio;
			
			$Usr = new Usuario;
			$TD = new TamanoDesafio;
			
			$users = $Usr->find('all');
			$docs = $Doc->find('all');
			
			foreach($docs as $doc) {
				$ID->create();
				$ID->set(
					array(
						'id_documento' => $doc['Documento']['id_documento'],
						'id_criterio' => $this->id,
						'total_respuestas_1_no_validado' => 0,
					    'total_respuestas_2_no_validado' => 0,
					    //'respuesta_oficial_de_un_experto' => ,
					    'total_respuestas_1_como_desafio' => 0,
					    'total_respuestas_2_como_desafio' => 0,
					    'confirmado' => false,
					    'preguntable' => true,
					)
				);
				$ID->save();
			}
						
			foreach($users as $user) {
				$TD->create();
				$TD->set(
					array(
						'id_usuario' => $user['Usuario']['id_usuario'],
						'id_criterio' => $this->id,
						'c_preguntas' => $this->field('tamano_minimo_desafio', array('id_criterio' => $this->id))
					)
				);
				$TD->save();
			}
		}
	}

}
?>
