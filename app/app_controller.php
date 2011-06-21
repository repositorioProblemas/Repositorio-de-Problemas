<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @link http://book.cakephp.org/view/957/The-App-Controller
 */
App::import('Sanitize');

class AppController extends Controller {

  function _login($data) {
	App::import('Model','Usuario');
	$Usuario = new Usuario;
	$data = Sanitize::clean($data);
    $usuario = $Usuario->iniciar_sesion($data);
	if( isset($usuario['Usuario']['id_usuario']) ) {
	  if(!empty($usuario['Experto'])) 
	 	$this->Session->write('Usuario.esExperto', true);
	  if(!empty($usuario['Usuario']['es_administrador']))
		 $this->Session->write('Usuario.esAdmin', true);
	  $this->Session->write('Usuario.id', $usuario['Usuario']['id_usuario']);	 
	  $this->Session->write('Usuario.nombre', $usuario['Usuario']['nombre']);
	  $this->Session->write('Usuario.apellido', $usuario['Usuario']['apellido']);
	  $this->Session->write('Usuario.puntos', $usuario['Usuario']['puntos']); //
	  $this->Session->setFlash('Welcome, ' . $usuario['Usuario']['nombre']);
	  CakeLog::write('activity', 
		'User '. $usuario['Usuario']['nombre'] . ' ' . 
		$usuario['Usuario']['apellido'] . ' (' .$usuario['Usuario']['id_usuario'] . ') has logged in');      	  
	  return true;
	} else {
      $this->Session->setFlash('Incorrect user and/or password');
	  return false;
    }
  }
  
    function _addPoints($num) {
		App::import('Model','Usuario');
		$Usuario = new Usuario;
		if($this->Session->check('Usuario.id') && $this->Session->read('Usuario.id') > 1) {
			$id = $this->Session->read('Usuario.id');
			$usuario = $Usuario->findByIdUsuario($id);
		  	$this->Usuario->updateAll(
		  		array(
		  			'Usuario.puntos' => (intval($usuario['Usuario']['puntos']) + $num)
		  		),
		  		array(
		  			'Usuario.id_usuario' => $id
		  		)
		  	);
		  	$this->Session->write('Usuario.puntos', (intval($usuario['Usuario']['puntos']) + $num));
		  	return true;		  	
		} else {
		  return false;
	    }		
	}
}
