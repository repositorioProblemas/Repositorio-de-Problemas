<?php
App::import('Sanitize');
class CriteriosController extends AppController {

  var $paginate = array(
	'Criterio' => array(
	  'limit' => 5,
	  'order' => array(
		'Criterio.pregunta' => 'desc'
	  )
	)
  );

  function beforeFilter() {
	if(!$this->Session->check('Usuario.esAdmin') and !$this->Session->check('Usuario.esExperto')) {
	  if($this->Session->check('Usuario.id')) {
	  		$this->Session->setFlash('You do not have permission to access this page');
	  		$this->redirect(array('controller' => 'pages'));
		} else {
			$this->Session->setFlash('You do not have permission to access this page. Please log in if you are an administrator');
			$this->redirect(array('controller' => 'iniciar_sesion'));
		}
	}
	if($this->Session->check('Criterio.limit'))
		$this->paginate['Criterio']['limit'] = $this->Session->read('Criterio.limit'); 
  }

  function index() {
  	if(!empty($this->data)) {  		
  		if(!empty($this->data['Criterio']['limit'])) {
  			$this->paginate['Criterio']['limit'] = $this->data['Criterio']['limit'];
  			$this->Session->write('Criterio.limit', $this->data['Criterio']['limit']);
  		} 
  	} 
  	$limit = $this->Session->read('Criterio.limit') ? $this->Session->read('Criterio.limit') : $this->paginate['Criterio']['limit'];
  	$this->data = $this->paginate();  
  	$this->set(compact('limit'));	
  }

  function add() {
  	$this->set('current', 'Add new');
	if(!empty($this->data)) {
	  $this->Criterio->set($this->data);	  
	  if($this->Criterio->validates()) {
		$this->data['Criterio']['id_contexto'] = 1;
		$this->Criterio->save($this->data);
		$this->Session->setFlash('Criteria added successfully');
		CakeLog::write('activity', 'Criteria "'.$this->data['Criterio']['pregunta'].'" was added');
		$this->redirect($this->referer());
	  } else {
		$this->Session->setFlash($this->Criterio->invalidFields(),'flash_errors');
		//$this->Session->setFlash('There were errors in the form');
	  }
	}
  }

  function view($id = null) {  }


  function edit($id = null) {
  	$this->set('current', 'Edit');
	$this->Criterio->id = $id;
	if (empty($this->data)) {
	  $this->data = $this->Criterio->read();
	} else {
	  if ($this->Criterio->save($this->data)) {
		$this->Session->setFlash('Criteria '.$id.' was successfully modified');
		CakeLog::write('activity', 'Criteria '.$id.' was modified');
		$this->redirect(array('controller' => 'admin_documentos', 'action' => 'index'));
	  }
	}
	$this->render('add');
  }

  function remove($id = null) {
  	if(!is_null($id)) {
  		if($this->Criterio->delete($id)) {
  			$this->Session->setFlash('Criteria '.$id.' removed');
  			CakeLog::write('activity', 'Criteria '.$id.' was removed');
  		} else {
  			$this->Session->setFlash('There was an error deleting that criteria you specified');
  		}
  	}
  	$this->redirect($this->referer());  	
  }

}

?>