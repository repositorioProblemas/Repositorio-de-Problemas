<?php
/* Documento Test cases generated on: 2011-04-22 22:21:04 : 1303525264*/
App::import('Model', 'Documento');

class DocumentoTestCase extends CakeTestCase {
  var $fixtures = array('app.documento', 'app.usuario', 'app.experto', 'app.informacion_desafio', 'app.criterio', 'app.tamano_desafio', 'app.tag');

	function startTest() {
		$this->Documento =& ClassRegistry::init('Documento');
	}

	function testSubir() {
	  $data = array(
		'Documento' => array(
		  'titulo' => 'Titulo',
		  'texto' => 'Texto',		  
		)
	  );

	  $this->Documento->save($data);
	  $doc = $this->Documento->findByTitulo('Titulo');
	  $this->assertNotNull($doc);
	  $info = $this->Documento->InformacionDesafio->findByIdDocumento($doc['Documento']['id_documento']);
	  $this->assertFalse(empty($info));
	}

	function endTest() {
		unset($this->Documento);
		ClassRegistry::flush();
	}

}
?>