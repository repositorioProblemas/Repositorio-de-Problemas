<?php
/**
 * tags_controller.php
 * 
 * tag manager
 * 
 * @package   controller
 * @author    Mauricio Quezada <amantedelacomida56@aol.com>
 * @copyright Copyright (c) 2011 
 */

class TagsController extends AppController {

	var $helpers = array('Js' => array('Jquery'));

  function index() {
	$this->redirect('/');
  }

  function search() {
	if (empty($this->data) or trim($this->data['Tag']['search']) == '') {
	  $this->redirect('/');
	}
	CakeLog::write('activity', 'User '. $this->Session->read('Usuario.id') . ' has searched for: ['. $this->data['Tag']['search'] .']');
	$tags = explode(' ', trim($this->data['Tag']['search']));
	
	$documents = $this->Tag->findDocumentsByTags($tags);
	$c = count($documents);
	if($c > 0) {
	  $this->Session->write('Desafio.docs', $documents);
	  $msg = 
		'There ' . 
		($c>1 ? ' are ' : ' is ') . 
		$c .' document'  . 
		($c>1 ? 's ' : ' ') .
		'that satisf' . 
		($c>1 ? 'y ' : 'ies ') . 
		'that term. ';

	  if(!$this->Session->check('Usuario.esAdmin') and !$this->Session->check('Usuario.esExperto'))
		$msg .= 
		  'In order to get '. 
		  ($c>1 ? 'some of these ' : 'this ') . 
		  'document' . 
		  ($c>1 ? 's' : '') .
		  ', you will have to pass a challenge! ';
	  
	  $this->Session->setFlash($msg);
	  
	  $this->redirect(array('controller' => 'bajar_documento'));
	} else {
	  $this->Session->setFlash(
		'We\'re sorry. There weren\'t any documents that satisfy that term(s)'
	  );
	  $this->redirect(array('controller' => 'pages'));
	}
  }
  
  function autocomplete() {
  	$search = null;
  	if(isset($this->params['url']['search']) && !is_null($this->params['url']['search']))
  		$search = $this->params['url']['search'];
  	else exit;
  	$this->data = $this->Tag->find('all', array(
		'conditions' => array(
				'Tag.tag LIKE' => "%{$search}%",
  		),
  		'fields' => array(
  			'DISTINCT Tag.tag'
  		)
  	));
  	$this->render('/elements/tags_autocomplete','ajax');  	
  }
}
?>
