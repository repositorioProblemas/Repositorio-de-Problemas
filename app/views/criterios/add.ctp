<?php
$title = $current . ' criteria';
$this->viewVars['title_for_layout'] = $title;
/* breadcrumbs */
$this->Html->addCrumb('Manage', '/manage/');
$this->Html->addCrumb($title);
/* end breadcrumbs */ 

function op($label, $before = null, $after = null, $between = null, $style = null, $error = false) {
	return compact('label', 'before', 'after', 'between', 'style', 'error');
} 
?>

<?php echo $this->Html->image('admin.png',array('class' => 'imgicon')) ; ?><h1 class="h1icon" style="margin-top: 15px;"><?php echo $title; ?></h1>
<div class="clearicon"></div>

<?php echo 
	   $this->element('menu_administrar', array(
		 'isLogged' => $this->Session->check('Usuario.id'), 
		 'isAdmin' => $this->Session->check('Usuario.esAdmin'),
         'current' => 'criterios'
	   ));       
?> 

<div style="clear: both; height: 20px;"></div>

<div class="form-div">
<?php
	echo $this->Form->create('Criterio');
	echo $this->Form->input('pregunta', op('Question to measure', null, null, null, 'width: 500px; height: 40px;'));
	
	echo "<br />";
	
	echo $this->Form->hidden('respuesta_1', array('value' => 'No'));
	echo $this->Form->hidden('respuesta_2', array('value' => 'Yes'));
	
	echo $this->Form->input('tamano_pack', op('Quantity of documents to give after passing a challenge'));
	
	echo "<br />";
	
	echo $this->Form->input('costo_pack', op('How many points the user must earn or spend to download documents'));
	
	echo "<br />";
	
	echo $this->Form->input('costo_envio', op('How many points the user must earn or spend to add new documents'));
	
	echo "<br />";
	
	echo $this->Form->input('bono_documento_enviado_validado', op('How many points the user will receive after his uploaded document was validated under this criteria'));
	
	echo "<br />";
	
	echo $this->Form->input('tamano_minimo_desafio',op('Minimum quantity of questions in challenge'));
	
	echo "<br />";
	
	echo $this->Form->label(null, 'Let <span style="font-family: Monospace; font-size: 1.4em">c(i)</span> be the actual number of questions at a challenge. ' .
			'<br />If a user <span style="font-weight: bold">passes</span> the challenge, the new number of questions will be <span style="font-family: Monospace; font-size: 1.4em">c(i+1) = a*c(i)+b</span>, where');
	
	echo $this->Form->input('funcion_penalizacion_a',op(false, '<span style="font-family: Monospace; font-size: 1.4em">a = </span>', '<div style="height:10px;"></div>'));
	
	echo $this->Form->input('funcion_penalizacion_b',op(false, '<span style="font-family: Monospace; font-size: 1.4em">b = </span>'));
	
	echo "<br />";
	
	echo $this->Form->label(null, 'Let <span style="font-family: Monospace; font-size: 1.4em">c(i)</span> be the actual number of questions at a challenge. ' .
			'<br />If a user <span style="font-weight: bold">fails</span> at the challenge, the new number of questions will be <span style="font-family: Monospace; font-size: 1.4em">c(i+1) = a*c(i)+b</span>, where');
	
	echo $this->Form->input('funcion_despenalizacion_a',op(false, '<span style="font-family: Monospace; font-size: 1.4em">a = </span>', '<div style="height:10px;"></div>'));
	
	echo $this->Form->input('funcion_despenalizacion_b',op(false, '<span style="font-family: Monospace; font-size: 1.4em">b = </span>'));
	
	echo "<br />";
	
	echo $this->Form->end('Save');
?>
</div>