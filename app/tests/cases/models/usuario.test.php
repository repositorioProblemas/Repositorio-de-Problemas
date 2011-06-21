<?php
/* Usuario Test cases generated on: 2011-04-22 22:24:15 : 1303525455*/
App::import('Model', 'Usuario');

class UsuarioTestCase extends CakeTestCase {
  var $fixtures = array('app.usuario', 'app.documento', 'app.informacion_desafio', 'app.tamano_desafio', 'app.tag', 'app.experto');

  function startTest() {
	$this->Usuario =& ClassRegistry::init('Usuario');
  }
  
  function testRegistrar() {
	$data = 
	  array(
		'Usuario' => array(
		  'email' => 'hola@chao.com',
		  'nombre' => 'juanito',
		  'apellido' => 'perez',
		  'password' => 'macoy123'));
	$result = $this->Usuario->register($data);
	$resultset = $this->Usuario->findByEmail('hola@chao.com');
	// var_dump($resultset);

    $this->assertTrue($result);
	$this->assertEqual($resultset['Usuario']['email'], 'hola@chao.com');
    $this->assertNotEqual($resultset['Usuario']['password'], 'macoy123');
    $this->assertNotEqual($resultset['Usuario']['salt'], '');
	$des = $this->Usuario->TamanoDesafio->findByIdUsuario($resultset['Usuario']['id_usuario']);
	$this->assertFalse(empty($des));
  }

  function testIniciarSesion() {
	$data = 
	  array(
		'Usuario' => array(
		  'email' => 'hola@chao.com',
		  'nombre' => 'juanito',
		  'apellido' => 'perez',
		  'password' => 'macoy123'));
	$result = $this->Usuario->register($data);
	$resultset = $this->Usuario->findByEmail('hola@chao.com');
	$test = $this->Usuario->iniciar_sesion($data);
	$this->assertEqual($resultset,$test);
  }
  
  function endTest() {
	unset($this->Usuario);
	ClassRegistry::flush();
  }
  
}
?>