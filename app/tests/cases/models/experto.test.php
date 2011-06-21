<?php
/* Experto Test cases generated on: 2011-04-22 22:21:26 : 1303525286*/
App::import('Model', 'Experto');

class ExpertoTestCase extends CakeTestCase {
	var $fixtures = array('app.experto');

	function startTest() {
		$this->Experto =& ClassRegistry::init('Experto');
	}

	function endTest() {
		unset($this->Experto);
		ClassRegistry::flush();
	}

}
?>