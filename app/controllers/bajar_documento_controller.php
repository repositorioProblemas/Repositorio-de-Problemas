<?php
/**
 * bajar_documento_controller.php
 * 
 * gives award to user
 * 
 * @package   controller
 * @author    Mauricio Quezada <mquezada@dcc.uchile.cl>
 * @copyright Copyright (c) 2011 
 */

class BajarDocumentoController extends AppController {
  
  var $uses = array('Documento', 'Criterio', 'Tag');
  
  function beforeFilter() {
	if(!$this->Session->read('Desafio.passed') and !$this->Session->check('Usuario.esAdmin') and !$this->Session->check('Usuario.esExperto')) {
	  // $this->Session->setFlash('Antes de descargar un documento, deberás pasar el siguiente desafio!');
	  $this->Session->write('Desafio.goto', 'bajar');
	  $this->redirect(array('controller' => 'desafios', 'action' => 'pass'));
	}
  }

  function index($criterio) {
	$this->redirect(array('action' => 'get', $criterio));
  }

  public function get($criterio = null) {
	if(!$this->Session->check('Desafio.docs') and is_null($criterio)) {
	  $this->Session->setFlash(
		'Ganaste la posibilidad de descargar documentos, haz una búsqueda para poder acceder a ellos!');
	  $this->redirect(array('controller' => 'tags'));
	} else if(!is_null($criterio)) {
	  $docs = $this->Tag->findDocumentsByTags(array($criterio));
	} else {
	  $docs = $this->Session->read('Desafio.docs');
	}
	
	$this->Session->delete('Desafio');
	$criterio = $this->Criterio->find('first', array('recursive' => -1));
	$pack = $criterio['Criterio']['tamano_pack'];

	$doc_objs = $this->Documento->find('all', array(
	  'conditions' => array(
		'Documento.id_documento' => $docs
	  ),
	  'recursive' => -1,
	));
	$premio = array();
	if(count($doc_objs) > 0) {
	  if(count($doc_objs) < $pack)
		$pack = count($doc_objs);
	
	  /* shuffle documents */
	  shuffle($doc_objs);
	  $tmp = array_rand($doc_objs, $pack);
	  $tmp = (is_array($tmp) ? $tmp : array($tmp));
	  /* insersect by keys from documents and some random subset of size $pack of $doc_objs */
	  /* $premio are $pack random documents from search result */
	  $premio = array_intersect_key(
		$doc_objs, 
		array_flip($tmp)
	  );
	}
	$this->set(compact('premio', 'doc_objs'));
  }
}
?>
