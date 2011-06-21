<?php

$id = $stats['id_estadisticas'];

$respuesta_1 = $criterio['respuesta_1'];
$respuesta_2 = $criterio['respuesta_2'];

$total_1_v =  $stats['total_respuestas_1_como_desafio'];
$total_2_v =  $stats['total_respuestas_2_como_desafio'];

$suma_v = $total_1_v + $total_2_v;

$total_1_nv =  $stats['total_respuestas_1_no_validado'];
$total_2_nv =  $stats['total_respuestas_2_no_validado'];

$suma_nv = $total_1_nv + $total_2_nv;

$places = 0;
$before = '';
$decimal = '.';
$options = compact('places','before','decimal');

$total_1_v = array(
  $total_1_v, 
  $this->Number->format(porcentaje($total_1_v, $suma_v), $options));

$total_2_v = array(
  $total_2_v, 
  $this->Number->format(porcentaje($total_2_v, $suma_v), $options)); 

$total_1_nv = array(
  $total_1_nv, 
  $this->Number->format(porcentaje($total_1_nv, $suma_nv), $options));

$total_2_nv = array(
  $total_2_nv, 
  $this->Number->format(porcentaje($total_2_nv, $suma_nv), $options)); 


$respuestas = compact('respuesta_1','respuesta_2', 'total_1_v', 'total_2_v', 'total_1_nv', 'total_2_nv');

$r = $stats['respuesta_oficial_de_un_experto'];



$oficial = array(
  0 => $r === '1' ? $this->Html->tag('span', $respuesta_1, array('class' => 'resp-oficial')) 
  : $this->Html->link($respuesta_1, array(
	'controller' => 'admin_documentos',
	'action' => 'set_field', 'respuesta_oficial_de_un_experto', $id, 1), array(
	  'style' => 'color: #ccc'
	)),
  1 => $r === '0' ? $this->Html->tag('span', $respuesta_2, array('class' => 'resp-oficial')) 
  : $this->Html->link($respuesta_2, array(
	'controller' => 'admin_documentos',
	'action' => 'set_field', 'respuesta_oficial_de_un_experto', $id, 0), array(
	  'style' => 'color: #bbb'
	))
);

$confirmado = $stats['confirmado'];

$text_conf = ($confirmado === '1' ? 'Invalidar' : 'Validar').' documento';

$link_conf = $this->Html->link($text_conf, array('controller' => 'admin_documentos', 'action' => 'set_field', 'confirmado', $id, ($confirmado+1)%2));

?>

<?php echo $this->Form->create(); ?>
<table class="tabla-estadisticas">
	
<tr>
	<td colspan="2">
		<ul>
			<li>
		<?php echo $link_conf;?>
		</li><li>
		<?php if($stats['preguntable'] == 1)
				echo $this->Html->link('No incluir en desafíos', array('action' => 'set_field', 'preguntable', $doc_id, 0), array('title' => 'Haga clic para deshabilitar su uso'));
			else
				echo $this->Html->link('Incluir en desafíos', array('action' => 'set_field', 'preguntable', $doc_id, 1), array('title' => 'Haga clic para habilitar su uso'));
		?>		
		</li>
		</ul>	
</td> 
</tr>
  <tr>
  	<td><span class="small">Respuesta Correcta</span></td>
  	<td>
	  <?php echo $oficial[0]; ?>
	  <br />
	  <?php echo $oficial[1]; ?>
	</td>
  </tr>
<tr>
	<td colspan="2">
		<span class="small">
			(<?php echo $this->Number->format((($confirmado === '1') ? consenso($total_1_v[0], $total_2_v[0]) : consenso($total_1_nv[0], $total_2_nv[0])), $options)?>% de consenso en las respuestas)
		</span>
	</td>
</tr>
</table>
