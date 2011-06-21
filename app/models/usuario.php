<?php
class Usuario extends AppModel {
	var $name = 'Usuario';
	var $primaryKey = 'id_usuario';
	var $displayField = 'nombre';
	var $hasMany = array(
      'Documento' => array(
        'className' => 'Documento',
        'foreignKey' => 'autor',
		'dependent' => true
      ),
      'TamanoDesafio' => array(
        'className' => 'TamanoDesafio',
        'foreignKey' => 'id_usuario',
		'dependent' => true
      ),
      'Experto' => array(
        'className' => 'Experto',
        'foreignKey' => 'id_usuario',
		'dependent' => true
      )
    );
    
    
	var $validate = array(
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Invalid E-mail address. Please enter a valid E-mail address',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique' => array(
			  'rule' => array('isUnique'),
			  'message' => 'There is already a registered user with that E-mail address. Please enter another E-mail address',
			),
		),
		'nombre' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'The Name is too short. Try with a Name with more than two letters.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'minlength' => array(
			  'rule' => '/^[a-z A-ZáéíóúñÁÉÍÓÚàèìòùÁÉÍÓÚÑ]{2,}$/i',
			  'message' => 'Your Name may only contain letters or spaces.',
			),
		),
		'apellido' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'The Last Name is too short. Try with a Last Name with more than two letters.',
				// allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'minlength' => array(
			  'rule' => '/^[a-z A-ZáéíóúñÁÉÍÓÚàèìòùÁÉÍÓÚÑ]{2,}$/i',
			  'message' => 'Your Last Name may only contain letters or spaces.',
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Your password is too short, and may be insecure. Please enter a longer password.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'salt' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'puntos' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'The user points must contain a numeric input',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'es_administrador' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Is Administrator?: This option may only be a boolean value',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	

    /* ==================== METHODS ====================== */

	function beforeSave($options) {
	  if(!empty($this->data['Usuario']['password'])) {
		$this->data['Usuario']['salt'] = mt_rand();
		$this->data['Usuario']['password'] = sha1($this->data['Usuario']['password'] . $this->data['Usuario']['salt']);
	  }

	  return true;
	}

	/** 
     * Registers a new user
     * @param array $data
     * @return true on success, false otherwise
	*/
	function register($data=array()) {
	  if(empty($data) || !array_key_exists('Usuario', $data))
		return false;
      
      $t = array(
        array_key_exists('email', $data['Usuario']),
        array_key_exists('nombre', $data['Usuario']),
        array_key_exists('apellido', $data['Usuario']),
        array_key_exists('password', $data['Usuario']),
      );

	  if(!($t[0] and $t[1] and $t[2] and $t[3]))
		return false;
      
	  $data['Usuario']['es_administrador'] = false;
      
	  $user = $this->save($data);
	  return $user;
	}

    /**
     * checks user credential
     * @param array $data with email and username as subkeys of Usuario
     * @returns the corresponding user object, null otherwise
     */
    function iniciar_sesion($data = array()) {
      if(empty($data))
        return null;
      $d = $this->findByEmail($data['Usuario']['email']);

      $pass_to_check = $d['Usuario']['password'];
      $pass_from_login = sha1($data['Usuario']['password'] . $d['Usuario']['salt']);
      if(strcmp($pass_to_check,$pass_from_login) == 0) {
        return $d;
      }
      return null;
    }

	/* afterShave */
	function afterSave($created) {
	  if($created) {

		/* on create */
		if(!empty($this->data['Usuario']['es_experto'])) {		 
		  $this->_expert_create($this->id);		 
		}

		App::import('Model','Criterio');
		$Criterio = new Criterio;
		$criterios = $Criterio->find('all');
		foreach($criterios as $c) {
		  $this->TamanoDesafio->create();
		  
		  $this->TamanoDesafio->set(array(
			'id_usuario' => $this->id,
			'id_criterio' => $c['Criterio']['id_criterio'],
			'c_preguntas' => $c['Criterio']['tamano_minimo_desafio'],
		  ));
		  
		  $this->TamanoDesafio->save();
		}
		
		CakeLog::write('activity', 'User '.$this->id. ' created');
	  } else {
		/* on update */		
		if($this->data['Usuario']['es_experto'] == 1) {
		  $this->_expert_create($this->id);
		} else {
		  $this->_expert_delete($this->id);
		}
		CakeLog::write('activity', 'User '.$this->id. ' updated');
	  }	  	  	  
	}
	
	function _expert_create($id) {
	  $this->Experto->create();
	  $this->Experto->set(array(
		'id_usuario' => $this->id,
		'id_contexto' => 1
	  ));
	  $this->Experto->save();
	}

	function _expert_delete($id) {
	  $this->Experto->deleteAll(array('Experto.id_usuario' => $id));
	}


	function afterFind($results, $primary) {
	  $i = 0;
	  foreach($results as $r) {
		if(!empty($r['Experto'])) {		  
		  $results[$i]['Usuario']['es_experto'] = 1;
		}
		$i += 1;
	  }
	  return $results;
	}
	
}
?>
