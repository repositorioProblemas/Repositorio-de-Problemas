<?php
class Documento extends AppModel {
	var $name = 'Documento';
	var $primaryKey = 'id_documento';
	var $displayField = 'titulo';
	var $belongsTo =
	  array(
		'Usuario' => array(
		  'className' => 'Usuario',
          'foreignKey' => 'autor'
        )
      );
	var $hasMany =
	  array(
        'InformacionDesafio' => array(
          'className' => 'InformacionDesafio',
          'foreignKey' => 'id_documento',
		  'dependent' => true
        ),
		'Tag' => array(
		  'className' => 'Tag',
		  'foreignKey' => 'id_documento',
		  'dependent' => true
        )
      );

    var $validate = array(
		'titulo' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'You must add a title.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'texto' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'The document must have a non-empty content',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'premiado_validacion' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'La entrega del premio debe ser booleano. Esto no debiera ser visto por ningún ser humano en la tierra.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

    // ============================ METHODS ==============================================

    /**
     * saves a document and its tags
     * @param array $data
     * @param string $delimiter (of tags)
     * @return true if successfully, false otherwise
     */
    function saveWithTags($data = array(), $delimiter = ',') {
      if(!empty($data)) {
		$data['Documento']['id_dominio'] = 1;
		$data['Documento']['premiado_validacion'] = false;
		
        if(isset($data['Documento']['tags'])) {
		  $tags = explode($delimiter, $data['Documento']['tags']);
		  $tags = array_map("trim", $tags);
          unset($data['Documento']['tags']);
        } 

		$this->set($data);
        if(!$this->save())
          return false;
 
        $data = array();
        $i = 0;
        foreach($tags as $tag) {
          $data[$i]['Tag'] = array(
            'tag' => $tag,
            'id_documento' => $this->id
          );
          $i += 1;
        }
        
        if($this->Tag->saveAll($data)) 
          return true;        
      }
      return false;
    }


	// done: multiples criterios
	function afterSave($created) {
	  if($created) {
		App::import('Model', 'Criterio');
		$Criterio = new Criterio;
		$criterios = $Criterio->find('all');
		foreach($criterios as $c) {
	      $this->InformacionDesafio->create();
		  $this->InformacionDesafio->set(
			array(
			  'id_documento' => $this->id,
			  'id_criterio' => $c['Criterio']['id_criterio'],
			  'total_respuestas_1_no_validado' => 0,
			  'total_respuestas_2_no_validado' => 0,
			  //'respuesta_oficial_de_un_experto' => ,
			  'total_respuestas_1_como_desafio' => 0,
			  'total_respuestas_2_como_desafio' => 0,
			  'confirmado' => false,
			  'preguntable' => true,
			)
		  );		  
		  $this->InformacionDesafio->save();
		}
	  }
	}
	
	function afterFind($results) {		
		$i = 0;
		foreach($results as $r) {
			$u = $this->Usuario->find('first', array(
				'conditions' => array(
					'Usuario.id_usuario' => $r['Documento']['autor']
				), 
				'fields' => 'Usuario.nombre, Usuario.apellido', 
				'recursive' => -1
			));
			$u = $u['Usuario'];
			$results[$i]['Documento']['nombre_autor'] = $u['nombre'] . ' ' . $u['apellido'];
			$i++;
		}
		return $results;
	}

}
?>
