<?php
class Experto extends AppModel {
	var $name = 'Experto';
	var $primaryKey = 'id_experto';
	var $belongsTo = array(
	  'Usuario' => array(
        'className' => 'Usuario',
        'foreignKey' => 'id_usuario'
      ));

}
?>