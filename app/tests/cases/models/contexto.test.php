<?php
/* Contexto Test cases generated on: 2011-04-22 22:15:36 : 1303524936*/
App::import('Model', 'Contexto');

class ContextoTestCase extends CakeTestCase {
	var $fixtures = array('app.contexto');

	function startTest() {
		$this->Contexto =& ClassRegistry::init('Contexto');
	}

	function endTest() {
		unset($this->Contexto);
		ClassRegistry::flush();
	}

}
?>