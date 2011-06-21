<?php
/* TamanoDesafio Test cases generated on: 2011-04-22 22:23:28 : 1303525408*/
App::import('Model', 'TamanoDesafio');

class TamanoDesafioTestCase extends CakeTestCase {
	var $fixtures = array('app.tamano_desafio');

	function startTest() {
		$this->TamanoDesafio =& ClassRegistry::init('TamanoDesafio');
	}

	function endTest() {
		unset($this->TamanoDesafio);
		ClassRegistry::flush();
	}

}
?>