<?php
/*
 * Teh most important class
 *
 * 
 * the cake is a lie
 * bird is the word
 * esa no es mi billetera
 *
 * waX
 *  
 */
class DesafiosController extends AppController {
  var $uses = array('Usuario', 'Documento', 'TamanoDesafio', 'InformacionDesafio', 'Criterio');

  function index() {	
	$this->redirect('/');
  }
  
  function _get_user() {
	if(!$this->Session->check('Usuario.id')) {
	  /* anon */
	  $uid = 1;
	} else { 
	  /* registered */
	  $uid = $this->Session->read('Usuario.id');
	}
	return $this->Usuario->read(null, $uid);	
  }
  
  function saltar() {
  	if(!$this->Session->read('Desafio.criterio'))
  		$this->redirect($this->referer());
  		
  	$criterio = $this->Criterio->findByIdCriterio($this->Session->read('Desafio.criterio'));
  	$to = $this->Session->read('Desafio.goto');
  	
  	if(strcmp($to, 'subir') == 0) {
  		$puntos = $criterio['Criterio']['costo_envio'];
  	} else {
  		$puntos = $criterio['Criterio']['costo_pack'];
  	}
  	
  	if($this->Session->check('Usuario.id') && $this->Session->read('Usuario.puntos') >= $puntos) {	    
	    $this->Session->write('Desafio.passed', true);	    
	    $this->_addPoints(-2*intval($puntos));
	    $this->_dispatch(true, false);  	        
	        
  	} else { 
	  	$this->Session->write('Desafio.passed', false);
	    $this->redirect('failure');
  	}
  }
  
  function earn() {
  	$this->Session->write('Desafio.goto', 'earn');
  	$this->redirect('pass');
  }
  
  function pass() {
	$u = $this->_get_user();
	/*
	 * elige un criterio al azar
	 * 
	 */
	$criterios = $this->Criterio->find('all', array('recursive' => -1));
	$criterio = $criterios[array_rand($criterios)];

	$chosen = 0;
	foreach($u['TamanoDesafio'] as $y) {
		if($y['id_criterio'] == $criterio['Criterio']['id_criterio'])
			break;
		$chosen++;
	}
	$c = $u['TamanoDesafio'][$chosen]['c_preguntas'];
	$p = 0.5;
		
	$this->Session->write('Desafio.criterio', $criterio['Criterio']['id_criterio']);
	
	$num_validados = ceil($c*$p);
	$num_novalidados = floor((1-$p)*$c);
	$documentos = $this->_choose($c, $num_validados, $num_novalidados);

	$to = $this->Session->read('Desafio.goto');
	if(strcmp($to, 'subir') == 0) {
  		$puntos = $criterio['Criterio']['costo_envio'];
  	} elseif(strcmp($to, 'bajar') == 0) {
  		$puntos = $criterio['Criterio']['costo_pack'];
  	} else {
  		$puntos = null;
  	}
	
	$this->set(compact('documentos', 'criterio', 'puntos'));	
  }

  function procesar() {
	if(empty($this->data)) {
	  $this->redirect('index');
	} else {
	  $desafio_correcto = true;
	  $no_validados = array();

	  $this->InformacionDesafio->recursive = -1;
	  foreach($this->data['Desafio'] as $d) {
		// buscar tambien por criterio!!!
		//$info = $this->InformacionDesafio->findByIdDocumento($d['id_documento']);
		
		// buscando por doc y criterio
		$info = $this->InformacionDesafio->find('first',
			array('conditions' => array(
				'InformacionDesafio.id_documento' => $d['id_documento'],
				'InformacionDesafio.id_criterio' => $this->Session->read('Desafio.criterio')
			)) 
		);
		$info = $info['InformacionDesafio'];
	
		/* si es validado preguntable, guardar la estadistica */
		if($info['preguntable'] == 1 and $info['confirmado'] == 1) {
		  $r = $d['respuesta'];

		  /* verificar correctitud (y del desafio) */
		  /* oficial == 1 => r = 0 (= 2 mod 2) 
		   * oficial == 0 => r = 1 (= 1 mod 2)
		   */		  
		  if(($info['respuesta_oficial_de_un_experto'] == 0 and ($r%2) == 1) or
			 ($info['respuesta_oficial_de_un_experto'] == 1 and ($r%2) == 0))
			$desafio_correcto = false;
		  
		  /* guardar la estadistica */
		  $this->InformacionDesafio->set(array(
			'id_estadisticas' => $info['id_estadisticas'],
			'id_criterio' => $this->Session->read('Desafio.criterio'),
			'total_respuestas_'.$r.'_como_desafio' => $info['total_respuestas_'.$r.'_como_desafio'] + 1));
		  $this->InformacionDesafio->save();
		} else {
		  $no_validados[] = $d;
		}		
	  }
	  
	  /* no-validados */
	  if($desafio_correcto) {
		foreach($no_validados as $d) {	 
		  // buscar tambien por criterio!!!
		  // $info = $this->InformacionDesafio->findByIdDocumento($d['id_documento']);
		  // buscando por doc y criterio
			$info = $this->InformacionDesafio->find('first',
				array('conditions' => array(
					'InformacionDesafio.id_documento' => $d['id_documento'],
					'InformacionDesafio.id_criterio' => $this->Session->read('Desafio.criterio')
				)) 
			);
		  $info = $info['InformacionDesafio'];
		  $r = $d['respuesta'];
		  /* guardar la estadistica */
		  $this->InformacionDesafio->set(array(
			'id_estadisticas' => $info['id_estadisticas'],
			'id_criterio' => $this->Session->read('Desafio.criterio'),
			'total_respuestas_'.$r.'_como_desafio' => $info['total_respuestas_'.$r.'_como_desafio'] + 1));
		  $this->InformacionDesafio->save();
		}
	  }
	}

	$this->_calcular_c($desafio_correcto);
	$this->_dispatch($desafio_correcto);
  }

  function _calcular_c($desafio_correcto) {
	/* TODO 2º ITERACION */
	//$cr = $this->Criterio->find('first');
	
	/* hola, tanto tiempo. 2º iteracion :D */
	$cr = $this->Criterio->findByIdCriterio($this->Session->read('Desafio.criterio'));
	$u = $this->_get_user();
	
	$chosen = 0;
	foreach($u['TamanoDesafio'] as $y) {
		if($y['id_criterio'] == $cr['Criterio']['id_criterio'])
			break;
		$chosen++;
	}
	
	$c = $u['TamanoDesafio'][$chosen]['c_preguntas'];

	$p_a = $cr['Criterio']['funcion_penalizacion_a'];
	$p_b = $cr['Criterio']['funcion_penalizacion_b'];
	$d_a = $cr['Criterio']['funcion_despenalizacion_a'];
	$d_b = $cr['Criterio']['funcion_despenalizacion_b'];
	$min = $cr['Criterio']['tamano_minimo_desafio'];
	
	$nuevo_c = $c;
	if ($desafio_correcto) {
	  // despenalizar
	  $tmp = $d_a*$c + $d_b;
	  $nuevo_c = ($tmp > $min ? $tmp : $min);
	} else {
	  // penalizar
	  $nuevo_c = $p_a*$c + $p_b;
	}

	$this->TamanoDesafio->id = $u['TamanoDesafio'][$chosen]['id_desafio'];
	$this->TamanoDesafio->saveField('c_preguntas', $nuevo_c);
  }

  function _dispatch($desafio_correcto, $flash = true) {
  	$criterio = $this->Criterio->findByIdCriterio($this->Session->read('Desafio.criterio'));
  	
	if($desafio_correcto) {
	  $this->Session->write('Desafio.passed', true);
	  $to = $this->Session->read('Desafio.goto');
	  $puntos = $criterio['Criterio']['costo_envio']; 
	  
	  if(strcmp($to, 'subir') == 0) {
		if($flash) $this->Session->setFlash(
		  'You have passed the challenge and earned '.$puntos.' points!. Now you can add a new Document. Thank you!');
		  
		/* sumar $puntos. */
		$this->_addPoints($puntos); 

		$this->redirect(array('controller' => 'subir_documento'));
      // ingresar puntos?
	  } elseif(strcmp($to, 'bajar') == 0) {
	  	$puntos = $criterio['Criterio']['costo_pack'];
		if($flash) $this->Session->setFlash(
		  'You have passed the challenge and earned '.$puntos.' points!. Now you can get your new Documents. Thank you!');
		  
		/* sumar $puntos */
		$this->_addPoints($puntos);  
		$this->redirect(array('controller' => 'bajar_documento'));
	  } else {
	  	$puntos = $criterio['Criterio']['costo_pack'];
		if($flash) $this->Session->setFlash(
		  'You have passed the challenge and earned '.$puntos.' points!');
		  
		/* sumar $puntos */
		$this->_addPoints($puntos);  
		$this->Session->delete('Desafio');
		$this->redirect('/');
	  }
	} else {
	  $this->Session->write('Desafio.passed', false);
	  $this->redirect('failure');
	}
  }
  
  function failure() {
	//	$this->Session->delete('Desafio');
  }

  function _choose($c, $num_validados, $num_novalidados) {
	$validados = $this->InformacionDesafio->find('all', array(
	  'conditions' => array(
		'InformacionDesafio.confirmado' => true, 
		'InformacionDesafio.preguntable' => true,
	  )));
	$novalidados = $this->InformacionDesafio->find('all', array(
	  'conditions' => array(
		'InformacionDesafio.confirmado' => false,
		'InformacionDesafio.preguntable' => true,
	  )));
	$res = array();

	$v_rnd = array_rand($validados, $num_validados);
	$nv_rnd = array_rand($novalidados, $num_novalidados);

	if(!is_array($v_rnd))
	  $v_rnd = array($v_rnd);
	if(!is_array($nv_rnd))
	  $nv_rnd = array($nv_rnd);

	foreach($v_rnd as $v) {
	  $res[] = $validados[$v]['Documento'];
	}
	foreach($nv_rnd as $nv) {
	  $res[] = $novalidados[$nv]['Documento'];
	}

	shuffle($res);
	return $res;
  }

}

?>