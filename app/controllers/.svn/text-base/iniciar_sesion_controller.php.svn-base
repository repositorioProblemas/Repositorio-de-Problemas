<?php
App::import('Sanitize');

class IniciarSesionController extends AppController {
  var $uses = array('Usuario');

  function beforeRender() {
	if($this->Session->check('Usuario.id'))
	  $this->redirect('/');
  }

  function index() { }

  function login() {
	if (!empty($this->data)) { // siempre pasa
	  if(!AppController::_login($this->data)) {
		$this->redirect('index');
	  }
	} else {
	  $this->redirect('index');
	}
	$this->redirect($this->referer());
  }

  function logout() {
    $this->Session->destroy();
	$this->Session->setFlash('Logged out');
    $this->redirect('/');
  }

}
?>