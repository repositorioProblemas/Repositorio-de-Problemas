<?php

class SubirDocumentoController extends AppController {

  var $uses = array('Usuario', 'Documento', 'InformacionDesafio');
  
  function beforeFilter() {
	if(!$this->Session->read('Desafio.passed') and !$this->Session->check('Usuario.esAdmin') and !$this->Session->check('Usuario.esExperto')) {
	  $this->Session->setFlash('Before you add a new document, you must pass the following challenge!');
	  $this->Session->write('Desafio.goto', 'subir');
	  $this->redirect(array('controller' => 'desafios', 'action' => 'pass'));
	}
  }

  function index() { }

  function subir() {
	if(!empty($this->data)) {		
	  // author
	  if(!is_null($this->Session->read('Usuario.id'))) {
		$this->data['Documento']['autor'] = $this->Session->read('Usuario.id'); 
	  } else {
		$this->data['Documento']['autor'] = 0;
	  }		  	  
	  $this->Documento->set($this->data);	  
	  // tags
	  if(empty($this->data['Documento']['tags'])) {
	  	// no doc (Error)
		$this->Session->setFlash('You must include at least one tag');
		$this->redirect('index');
	  } else if(!$this->Documento->validates()) {
	  	// no doc (Error)
		$this->Session->setFlash('There are some errors in the form');		
		$this->redirect('index');
	  } else if($this->Documento->saveWithTags($this->data)) {
		$this->Session->delete('Desafio');	  	  
		// points						
		if($this->Session->read('Usuario.id') > 1) {
	    	$this->data['Usuario']['id_usuario'] = $this->Session->read('Usuario.id');
	      	$this->data['Usuario']['puntos'] = $this->Session->read('Usuario.puntos') + 0;	
	      	$this->Session->write('Usuario.puntos', $this->data['Usuario']['puntos']);
			$this->Usuario->set($this->data);		
	        if ($this->Usuario->save($this->data)) {
	        	// doc and points (Ok)
	          	$this->Session->setFlash('Document saved successfully. Thank you!');
	          	$this->redirect('/');
	        } else {
	        	// doc, no points (Error)
	        	$this->redirect('/');
	        }        
	    } else {			
	    	// doc, no points (Ok)
			$this->Session->setFlash('Document saved successfully');
			$this->redirect('/');
		}		
	  } else {		
	  	// no doc (Error)
	  	$this->Session->setFlash('There was an error trying to save the document. Please try again later');
	  	$this->redirect('index');
	  }	  
	} else {
		$this->redirect('index');	
	}	
  }
  
  
}
?>