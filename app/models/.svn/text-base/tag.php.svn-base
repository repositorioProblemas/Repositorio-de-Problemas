<?php
class Tag extends AppModel {
	var $name = 'Tag';
	var $primaryKey = 'asociacion_id';
	//var $displayField = 'tag';
	var $belongsTo = array(
      'Documento' => array(
        'className' => 'Documento',
        'foreignKey' => 'id_documento'
      ));
	var $validate = array(
		'tag' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'A tag cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// todo: TEST este metodo!
	// devuelve la lista de documentos
	// dados por los tags
	function findDocumentsByTags($tags) {	  	
	  //App::import('Model','InformacionDesafio');
	  //$ID = new InformacionDesafio;
	  $docs = array();
	  $i = 0;
	  foreach ($tags as $tag) {
		/*
		$condSubQuery['`InformacionDesafio`.`confirmado`'] = '1';
		$condSubQuery['`InformacionDesafio`.`respuesta_oficial_de_un_experto`'] = '1';
		$dbo = $this->getDataSource();
		*/
		$tmp = $this->find('all', array(
		  'conditions' => array(
			'Tag.tag' => $tag,
		  ), 
		  'recursive' => -1, 
		  'fields' => array('Tag.id_documento')
		)
		);
		$hola = array();
		$j = 0;
		foreach($tmp as $t) {
		  $hola[$j] = $t['Tag']['id_documento'];
		  $j++;
		}
		$docs[$i] = $hola;
		$i++;	  
	  }
	  $res = $docs[0];
	  for ($i = 1; $i < count($docs); $i++) {
		$res = array_intersect($res, $docs[$i]);
	  }
	  
	  return $res;
	}
}
?>
