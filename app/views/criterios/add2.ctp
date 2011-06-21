<?php echo $this->Html->image('admin.png',array('class' => 'imgicon')) ; ?><h1 class="h1icon">Editar Criterio</h1>
<div class="clearicon"></div>
<?php
echo $this->Form->create('Criterio');

// echo $this->Form->input('pregunta', array('value' => htmlspecialchars_decode($this->data['Criterio']['pregunta'])));
// echo $this->Form->input('respuesta_1');
// echo $this->Form->input('respuesta_2');
echo $this->Html->div('twoinputs',
			$this->Form->input('tamano_pack', array('div' => 'floatleft')).
			$this->Form->input('tamano_minimo_desafio', array('div' => 'floatright'))
			);
//echo $this->Form->input('costo_pack');
//echo $this->Form->input('costo_envio');
//echo $this->Form->input('bono_document_enviado_validado');
echo $this->Html->div('floatcenter',
	$this->Form->label(NULL, 'Penalización','twoinputs').
	$this->Html->div('small','Los siguientes parámetros de penalización definen cómo cambia el tamaño de desafío cuando un usuario se equivoca.').
	$this->Form->input('funcion_penalizacion_a', array('label' => '', 'after' => '* tamaño anterior +', 'between' => 'En caso de error, tamaño de desafío cambia a:', 'div'=>'floatleft')).
	$this->Form->input('funcion_penalizacion_b', array('label' => '', 'div' => 'floatleft'))
	);
echo $this->Html->div('floatcenter',	
	$this->Form->label(NULL, 'Despenalización','twoinputs').
	$this->Html->div('small','Los siguientes parámetros de despenalización definen cómo cambia el tamaño de desafío cuando un usuario responde uno correctamente.').
	$this->Form->input('funcion_despenalizacion_a', array('label' => '', 'after' => '* tamaño anterior +', 'between' => 'En caso correcto, tamaño de desafío cambia a:', 'div'=>'floatleft')).
	$this->Form->input('funcion_despenalizacion_b', array('label' => '', 'div' => 'floatleft'))
	);


echo $this->Form->end(array('label' => 'Guardar', 'div'=> 'floatcenter'));

?>
