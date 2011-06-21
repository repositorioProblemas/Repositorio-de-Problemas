<?php

class RegistroController extends AppController{

  var $uses = array('Usuario');
  
  function beforeFilter() {
	if($this->Session->check('Usuario.id'))
	  $this->redirect(array('controller' => 'pages'));
  }
  
  function index() {
	if(!empty($this->data)) {
	  $this->Usuario->set($this->data);		

	  if(!$this->Usuario->validates()) {
		$errors = $this->Usuario->invalidFields();
		$this->Session->setFlash($errors, 'flash_errors');

	  } else {

		$p1 = $this->data['Usuario']['password'];
		$p2 = $this->data['Usuario']['password2'];
		if(strlen($p1) < 6) {
		  $this->Session->setFlash('La contraseña debe tener por lo menos 6 caracteres');
		} else if(strcmp($p1,$p2) != 0) {
		  $this->Session->setFlash('Las contraseñas no coinciden');

		} else {	  
		  if($user = $this->Usuario->register($this->data)) {		  	
			AppController::_login($this->data);			
			$this->redirect('/');
		  }		
		}  		
	  }
	}
  }
}

?>