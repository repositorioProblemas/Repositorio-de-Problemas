<?php
/**
 * usuarios_controller.php
 * 
 * Controlador de usuarios
 * 
 */

class UsuariosController extends AppController {
  
  function beforeFilter() {
	if(!$this->Session->check('Usuario.id')) {
	  $this->redirect(array('controller' => 'iniciar_sesion'));
	}
  }
  
  function index() {    
	$this->redirect(array('action' => 'edit', $this->Session->read('Usuario.id')));	  
  }
  
  function edit($id = null) {
	if($id != $this->Session->read('Usuario.id'))
	  $this->redirect(array('action' => 'edit', $this->Session->read('Usuario.id')));

	$this->Usuario->id = $id;
	if (empty($this->data)) {
	  $this->data = $this->Usuario->read();
	} else {

	  // password validation
	  if(!empty($this->data['Usuario']['tmp_password'])) {
		$p1 = $this->data['Usuario']['tmp_password'];
		$p2 = $this->data['Usuario']['tmp_password2'];

		if(strlen($p1) < 6) {
		  $this->Session->setFlash('Your password must have at least 6 characters');
		  $this->redirect(array('action' => 'edit', $id));
		}
		
		if(strcmp($p1,$p2) == 0) {
		  $this->data['Usuario']['password'] = $p1;
		} else {
		  $this->Session->setFlash('Passwords don\'t match');
		  $this->redirect(array('action' => 'edit', $id));
		}
	  }

	  if($this->Session->read('Usuario.esAdmin') == 0)
		$this->data['Usuario']['es_admin'] = 0;

	  $this->Usuario->set($this->data);
	  if ($this->Usuario->validates()) {
		// saves edited data
		if($this->Usuario->save($this->data)) {
		  $this->Session->setFlash('Your profile was modified');
		  CakeLog::write('activity', 'User '. $id .' modified his/her profile');
		  $this->redirect('index');
		} else {
		  $this->set('debug', $this->Usuario);
		}
	  } else {		
		$errors = $this->Usuario->invalidFields();
		$this->Session->setFlash($errors, 'flash_errors');
		$this->redirect(array('action' => 'edit', $id));
	  }
	}
	if(is_null($id))
	  $this->redirect('add');
	 
  }   
}
?>
