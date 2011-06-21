<?php
/**
 * admin_documentos.php
 * 
 * CRUD sobre documentos
 * 
 * @package   controllers
 * @author    Mauricio Quezada <mquezada@dcc.uchile.cl>
 * @copyright Copyright (c) 2011 
 */

class AdminDocumentosController extends AppController {
  
  var $uses = array('Criterio', 'Documento', 'InformacionDesafio', 'Tag', 'Usuario');
  var $helpers = array('Text', 'Number');
  var $paginate = array(
	'InformacionDesafio' => array(
	  'limit' => 5,
	  'order' => array(
		'total_respuestas' => 'desc'
	  )
	)
  );

  function beforeFilter() {
	if(!$this->Session->check('Usuario.esExperto') && !$this->Session->check('Usuario.esAdmin')) {
		if($this->Session->check('Usuario.id')) {
	  		$this->Session->setFlash('You do not have permission to access this page');
	  		$this->redirect(array('controller' => 'pages'));
		} else {
			$this->Session->setFlash('You do not have permission to access this page. Please log in if you are an administrator');
			$this->redirect(array('controller' => 'iniciar_sesion'));
		}
	}
	if($this->Session->check('InformacionDesafio.limit'))
		$this->paginate['InformacionDesafio']['limit'] = $this->Session->read('InformacionDesafio.limit');
	if($this->Session->check('InformacionDesafio.order'))
		$this->paginate['InformacionDesafio']['order'] = $this->_strToArray($this->Session->read('InformacionDesafio.order'));
  }

  function index() {
	$this->redirect(array('action'=>'validados'));
  }
  
  function _beforeList($confirmado, $all = false) {
  	$criterio_list = $this->Criterio->find('list');
  	$criterio_n = 1;  	
  	if(!empty($this->data)) {
  		if(!empty($this->data['Criterio']['pregunta'])) {
  			$criterio_n = $this->data['Criterio']['pregunta'];
  			$this->Session->write('InformacionDesafio.criterio', $criterio_n);  		
  		}
  		
  		if(!empty($this->data['Documento']['limit'])) {
  			$this->paginate['InformacionDesafio']['limit'] = $this->data['Documento']['limit'];
  			$this->Session->write('InformacionDesafio.limit', $this->data['Documento']['limit']);
  		}
  		
  		if(!empty($this->data['InformacionDesafio']['order'])) {  			
  			$this->paginate['InformacionDesafio']['order'] = $this->_strToArray($this->data['InformacionDesafio']['order']);
  			$this->Session->write('InformacionDesafio.order', $this->_arrayToStr($this->paginate['InformacionDesafio']['order']));  			
  		}
  		
  		if(!empty($this->data['InformacionDesafio']['filter'])) {
  			$this->Session->write('InformacionDesafio.filter', $this->data['InformacionDesafio']['filter']);
  		}
  	}
  	
  	// filter
  	$cond = array();
  	if($this->Session->check('InformacionDesafio.filter')) {
  		$cond = $this->_strToFilterArray($this->Session->read('InformacionDesafio.filter'));
  	} else {
  		$cond = array('1' => '1');
  	}
  	
  	if($all) {
  		$data = $this->paginate('InformacionDesafio', array(
		  'InformacionDesafio.id_criterio' => ($this->Session->read('InformacionDesafio.criterio') ? $this->Session->read('InformacionDesafio.criterio') : $criterio_n),
		  $cond		  		  
		));	
  	} else {
  		$data = $this->paginate('InformacionDesafio', array(
		  'InformacionDesafio.id_criterio' => ($this->Session->read('InformacionDesafio.criterio') ? $this->Session->read('InformacionDesafio.criterio') : $criterio_n),
		  'InformacionDesafio.confirmado' => $confirmado,
		  $cond
		));  		
  	}
  	
	return compact('criterio_list', 'criterio_n', 'data');
  }
  
  function validados() {
  	$d = $this->_beforeList(1);
	$current = 'validados';
	$criterio_n = $this->Session->read('InformacionDesafio.criterio') ? $this->Session->read('InformacionDesafio.criterio') : $d['criterio_n'];
	$criterio_list = $d['criterio_list'];
	$data = $d['data'];	
	$limit = $this->Session->read('InformacionDesafio.limit') ? $this->Session->read('InformacionDesafio.limit') : $this->paginate['InformacionDesafio']['limit'];
	$ordering = $this->Session->read('InformacionDesafio.order') ? $this->Session->read('InformacionDesafio.order') : $this->_arrayToStr($this->paginate['InformacionDesafio']['order']);
	$filter = $this->Session->read('InformacionDesafio.filter') ? $this->Session->read('InformacionDesafio.filter') : 'all';
	
	$this->set(compact('criterio_n', 'criterio_list', 'data', 'current', 'limit', 'ordering', 'filter'));
	$this->render('listar');
  }

  function no_validados() {	
	$d = $this->_beforeList(0);
	$current = 'no_validados';
	$criterio_n = $this->Session->read('InformacionDesafio.criterio') ? $this->Session->read('InformacionDesafio.criterio') : $d['criterio_n'];
	$criterio_list = $d['criterio_list'];
	$data = $d['data'];
	$limit = $this->Session->read('InformacionDesafio.limit') ? $this->Session->read('InformacionDesafio.limit') : $this->paginate['InformacionDesafio']['limit'];
	$ordering = $this->Session->read('InformacionDesafio.order') ? $this->Session->read('InformacionDesafio.order') : $this->_arrayToStr($this->paginate['InformacionDesafio']['order']);
	$filter = $this->Session->read('InformacionDesafio.filter') ? $this->Session->read('InformacionDesafio.filter') : 'all';
		
	$this->set(compact('criterio_n', 'criterio_list', 'data', 'current', 'limit', 'ordering', 'filter'));
	$this->render('listar');
  }	
  
  function all() {
  	$d = $this->_beforeList(null, true);
	$current = 'all';
	$criterio_n = $this->Session->read('InformacionDesafio.criterio') ? $this->Session->read('InformacionDesafio.criterio') : $d['criterio_n'];
	$criterio_list = $d['criterio_list'];
	$data = $d['data'];
	$limit = $this->Session->read('InformacionDesafio.limit') ? $this->Session->read('InformacionDesafio.limit') : $this->paginate['InformacionDesafio']['limit'];
	$ordering = $this->Session->read('InformacionDesafio.order') ? $this->Session->read('InformacionDesafio.order') : $this->_arrayToStr($this->paginate['InformacionDesafio']['order']);
	$filter = $this->Session->read('InformacionDesafio.filter') ? $this->Session->read('InformacionDesafio.filter') : 'all';
	
	$this->set(compact('criterio_n', 'criterio_list', 'data', 'current', 'limit', 'ordering', 'filter'));
	$this->render('listar');
  }

  
  function add() {
	$this->redirect('/subir_documento');
  }
  
  function edit($id = null, $criterio = 1) {
  	if(empty($this->data)) {		
	  // stats
	  $this->data = $this->InformacionDesafio->find(
		'first',
		array(
			'conditions' => array(
				'InformacionDesafio.id_documento' => $id,
				'InformacionDesafio.id_criterio' => $criterio
			)
		));
		
	  if(empty($this->data)) {
	  	$this->redirect('index');
	  }
	  
	  // tags
	  $raw_tags = $this->Tag->find('all', array('conditions' => array('Tag.id_documento' => $id), 'recursive' => -1));
	  $tags = array();	  
	  foreach($raw_tags as $t)
		$tags[] = $t['Tag']['tag'];	  
	  $this->data['Documento']['tags'] = implode($tags,', ');
	  
	  // user
	  $raw_user = $this->Usuario->find('first', array('conditions' => array('Usuario.id_usuario' => $this->data['Documento']['autor']), 'recursive' => -1));
	  $this->data['Usuario']['autor'] = $raw_user['Usuario']['nombre'] . ' '. $raw_user['Usuario']['apellido'] . ' ('.$raw_user['Usuario']['email'].')';
	  
	  // criteria
	  $criterios_list = $this->Criterio->find('list');
	  $criterios_n = $criterio;
	  
	  $this->set('data',$this->data);
	  $this->set(compact('criterios_list', 'criterios_n'));	  
	} else {
	  // save stats info
	  if($this->InformacionDesafio->save($this->data))
	  	;	  
	  // save tags and basics
	  $this->Tag->deleteAll(array('Tag.id_documento' => $id));
	  $this->data['Documento']['id_documento'] = $id;
	  if ($this->Documento->saveWithTags($this->data)) {
		$this->Session->setFlash('Document "'. $this->data['Documento']['titulo'] .'" edited successfully');
		CakeLog::write('activity', 'Document '.$id.'\'s content modified');
		$this->redirect($this->data['Action']['current']);
	  }
	  
	}
  }
  
  function edit_select_criteria($doc_id = null) {
  	if(!is_null($doc_id) and !empty($this->data)) {  		
  		$this->redirect(array('action' => 'edit/'.$doc_id.'/'.$this->data['Action']['select']));
  	}
  	$this->redirect($this->referer());
  }

  function view($id = null) {
  	$this->redirect(array('action' => 'edit/'.$id));
  }

  function remove($id = null, $redirect = true, $flash = true) {
	if (!is_null($id)) {
	  if($this->Documento->delete($id)) {
		if($flash) $this->Session->setFlash('Document no. '.$id.' removed');
		CakeLog::write('activity', 'Document '.$id.' deleted');	
	  } else {
		if($flash) $this->Session->setFlash('There was an error at deleting the document');
	  }
	}
   	if($redirect) $this->redirect($this->referer());	
  }

  /* InformacionDesafio */
  function set_field($field = null, $id = null, $bool = null, $redirect = true) {
	if(!is_null($field) and !is_null($id) and !is_null($bool)) {
	  
	  /* blacklist */
	  if(in_array($field, array('id_estadisticas', 'id_documento'))) {
		if($redirect) $this->redirect($this->referer());
	  }
  
	  $this->InformacionDesafio->set(array(
		'id_estadisticas' => $id,
		$field => $bool
	  ));
	  
	  if(!$this->InformacionDesafio->save())
		return false;
	
	  CakeLog::write('activity', "InformacionDesafio id=$id modified: [field: $field, new value: $bool]");
	}	
	if($redirect) $this->redirect($this->referer());
  }

  function _reset_stats($id = null, $criteria = null) {
	if(!is_null($id) && !is_null($criteria)) {
	 $this->InformacionDesafio->updateAll(
	 	array(
			'InformacionDesafio.total_respuestas_1_como_desafio' => 0,
			'InformacionDesafio.total_respuestas_2_como_desafio' => 0,
		),
		array(
			'InformacionDesafio.id_documento' => $id,
	  		'InformacionDesafio.id_criterio' => $criteria	
		));	  
	  CakeLog::write('activity', "Document $id modified: stats restarted");
	}
	return true;
  }
  
  function reset_only($id = null, $criteria = null) {
  	$this->_reset_stats($id, $criteria);
  	$this->Session->setFlash('Stats restarted successfully');
  	$this->redirect($this->referer());
  }
  
  function mass_edit($criteria = null) {
  	if(!empty($this->data) && !is_null($criteria)) {
  		/* reset stats */
  		if(strcmp($this->data['Action']['mass_action'], 'reset') == 0) {
  			foreach($this->data['Documento'] as $d) {
  				$id = $d['id_documento'];	
  				$this->_reset_stats($id, $criteria);  			 
  			}
  			$this->Session->setFlash('Documents\' statistics restarted successfully');
  			
  		/* validate docs */
  		} else if(strcmp($this->data['Action']['mass_action'], 'validate') == 0) {
  			foreach($this->data['Documento'] as $doc) {  				
  				$id = $doc['id_documento'];
  				$this->validate_document($id, $criteria ,false);
  			}  	
  			$this->Session->setFlash('Documents changed successfully');
  			
  		/* delete docs */
  		} else if(strcmp($this->data['Action']['mass_action'], 'delete') == 0) {
  			foreach($this->data['Documento'] as $d) {
  				$id = $d['id_documento'];
  				$this->remove($id, false, false);
  			}  			
  			$this->Session->setFlash('Documents removed successfully');
  			
  		/* default */
  		} else {
  			$this->Session->setFlash('Didn\'t do anything. Maybe you picked a wrong option');
  		}  		
  	}
  		
  	$this->redirect($this->referer());
  }
  
  function validate_document($id = null, $criteria = null, $redirect = true) {
  	
  	if(!is_null($id) && !is_null($criteria)) {  	  	  				
		$doc = $this->InformacionDesafio->find( 'first', array(
			'conditions' => array(
				'InformacionDesafio.id_documento' => $id,
				'InformacionDesafio.id_criterio' => $criteria)			
		));
		
		// set respuesta_oficial to 1 if not set  				  				
		if($doc['InformacionDesafio']['respuesta_oficial_de_un_experto'] === null) {			
			$this->set_field('respuesta_oficial_de_un_experto', $doc['InformacionDesafio']['id_estadisticas'], 1, false);
		} 				
		$this->set_field('confirmado', $doc['InformacionDesafio']['id_estadisticas'] , ($doc['InformacionDesafio']['confirmado']+1)%2, false);
  	}
  	if($redirect) $this->redirect($this->referer());
  }
  
  /* translates an array of ordering conditions to a string */
  function _arrayToStr($a = array()) {
 	if(array_key_exists('total_respuestas', $a)) {
 		if(strcmp($a['total_respuestas'], 'desc') == 0) {
 			return 'more-ans';
 		} else {
 			return 'less-ans';
 		} 			
 	} elseif(array_key_exists('consenso', $a)) {
 		if(strcmp($a['consenso'], 'desc') == 0) {
 			return 'more-cs';
 		} else {
 			return 'less-cs';
 		}
 	} else {
 		return null;
 	} 		
  }
  
  function _strToArray($ord = '') {
	if(strcmp('less-ans', $ord) == 0) {
		return array(
			'total_respuestas' => 'asc'
		);  				
	} elseif (strcmp('more-cs', $ord) == 0) {
		return array(
			'consenso' => 'desc'
		);
	} elseif (strcmp('less-cs', $ord) == 0) {
		return array(
			'consenso' => 'asc'
		);
	} else { // more-ans
		return array(
			'total_respuestas' => 'desc'
		);
	}  	
  }
  
  function _strToFilterArray($fil = '') {
  	if(strcmp('app', $fil) == 0) {
  		return array(
  			'InformacionDesafio.total_app >' => '50' 
  		);
  	} elseif(strcmp('dis', $fil) == 0) {
  		return array(
  			'InformacionDesafio.total_app <=' => '50' 
  		);
  	} elseif(strcmp('con', $fil) == 0) {
  		return array(
  			'InformacionDesafio.consenso >' => '50' 
  		);
  	} elseif(strcmp('don', $fil) == 0) {
  		return array(
  			'InformacionDesafio.consenso <=' => '50' 
  		);
  	} else { // all
  		return array(
  			'1' => '1' 
  		);
  	} 		
  }
}
?>
