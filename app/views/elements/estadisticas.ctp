

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

$text_conf = $confirmado === '1' ? 'Invalidar' : 'Validar';

$link_conf = $this->Html->link($text_conf, array('controller' => 'admin_documentos', 'action' => 'set_field', 'confirmado', $id, ($confirmado+1)%2));

?>

<?php echo $this->Form->create(); ?>
<!--
<table class="tabla-estadisticas">
  <tr>
	<td><span class="small">Sin validar</span></td>
	<td><span class="small">Como desafio</span></td>
  </tr>
  <tr>
	<td>
      <?php //echo $respuestas['respuesta_1'] . ' : ' . $respuestas['total_1_nv'][0] . ' (' . $respuestas['total_1_nv'][1] . '%)'; ?>
	  <br />
	  <?php //echo $respuestas['respuesta_2'] . ' : ' . $respuestas['total_2_nv'][0] . ' (' . $respuestas['total_2_nv'][1] . '%)'; ?>	
	</td>
	<td>
	  <?php //echo $respuestas['respuesta_1'] . ' : ' . $respuestas['total_1_v'][0] . ' (' . $respuestas['total_1_v'][1] . '%)'; ?>
	  <br />
      <?php //echo $respuestas['respuesta_2'] . ' : ' . $respuestas['total_2_v'][0] . ' (' . $respuestas['total_2_v'][1] . '%)'; ?>	
	</td>
  </tr>
  <tr>
	<td><?php// echo $this->Html->link('Reset', array('controller' => 'admin_documentos', 'action' => 'reset_stats', $id, 'nv')); ?></td>
	<td><?php// echo $this->Html->link('Reset', array('controller' => 'admin_documentos', 'action' => 'reset_stats', $id, 'v')); ?></td>
  </tr>
</table>
-->
<?php
	if(($confirmado === '1') && ($suma_v!=0))
		echo '<script type="text/javascript">drawChart(\'piechart_'.$id.'\',data(\''.$respuestas['respuesta_1'] .'\','. $respuestas['total_1_v'][0]  . ',\'' .$respuestas['respuesta_2'] .'\','. $respuestas['total_2_v'][0] . '));';
	else if (($confirmado === '0') && ($suma_nv!=0))
		echo '<script type="text/javascript">drawChart(\'piechart_'.$id.'\',data(\''.$respuestas['respuesta_1'] .'\','. $respuestas['total_1_nv'][0]  . ',\'' .$respuestas['respuesta_2'] .'\','. $respuestas['total_2_nv'][0] . '));';
	else
		echo 'Sin respuestas.';
	?>
</script>
<?php echo '<div id="piechart_'.$id.'" style="position:absolute; padding:0px 0px"></div>'?>
