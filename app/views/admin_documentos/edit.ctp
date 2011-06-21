<?php
function porcentaje($q,$tot) {
	if($tot == 0)
		return 0;
	  return 100*$q/($tot);
}
		
	echo $this->Html->script('https://www.google.com/jsapi');
	echo $this->Html->script('piecharts');	
	//pr($this->data);
	$id = $this->data['Documento']['id_documento'];
	$en_valid = ($this->data['InformacionDesafio']['confirmado'] == 1) ? true : false;
	$current = 	($en_valid ? 'validados' : 'no_validados');
	$title = "Edit document";	
	$this->viewVars['title_for_layout'] = $title;
	$this->Html->addCrumb('Manage', '/manage/');
	$this->Html->addCrumb(($en_valid ? 'Validated Documents' : 'Pending validation'), $current);
	$this->Html->addCrumb($title);
?>
<script type="text/javascript">
$(document).ready(function() {
	$('.adm-save').click(function(e) {
		e.preventDefault();
		var form = $("#edit-form");
		form.submit();
	});
	
	$('.adm-cancel').click(function(e) {
		e.preventDefault();
		$(window.location).attr('href','<?php echo $this->Html->url(array('controller' => 'admin_documentos', 'action' => ($en_valid ? 'validados' : 'no_validados'))); ?>');
	});
	
	$('.adm-validate').click(function(e) {
		e.preventDefault();
		var ok = confirm("Are you sure to (in)validate this document?");
		if(ok)
			$(window.location).attr('href', '<?php echo $this->Html->url(array('controller' => 'admin_documentos', 'action' => 'validate_document/'. $id . '/' . $criterios_n)); ?>');
	});
	
	$('.adm-reset').click(function(e) {
		e.preventDefault();
		var ok = confirm("Are you sure to reset this document's statistics?");
		if(ok)
			$(window.location).attr('href', '<?php echo $this->Html->url(array('controller' => 'admin_documentos', 'action' => 'reset_only/'. $id . '/' . $criterios_n)); ?>');
	});
	
	$('.adm-delete').click(function(e) {
		e.preventDefault();
		var ok = confirm("Are you sure to delete this document?");
		if(ok)
			$(window.location).attr('href', '<?php echo $this->Html->url(array('controller' => 'admin_documentos', 'action' => 'remove', $id)); ?>');
	});
	
	$('.adm-select-criteria').change(function() {
		var value = $('.adm-select-criteria option:selected').val();
		$('#ActionSelect').attr('value', value);
		$('#adm-form-criteria').submit();
	});
});
</script>

<?php 
// #adm-form-criteria
echo $this->Form->create(null, array('url' => '/admin_documentos/edit_select_criteria/'.$id, 'id' => 'adm-form-criteria'));
echo $this->Form->hidden('Action.select');
echo $this->Form->end(); 
?>

<?php echo $this->Html->image('docs.png',array('class' => 'imgicon')) ; ?>
<h1 class="h1icon" style="margin-top: 15px;"><?php echo $title; ?></h1>
<div class="clearicon"></div>

<?php //echo 
	   $this->element('menu_administrar', array(
		 'isLogged' => $this->Session->check('Usuario.id'), 
		 'isAdmin' => $this->Session->check('Usuario.esAdmin'),
         'current' => $current
	   ));       
?> 

<!-- expert tools -->
<div id="expert-tools" style="float: right; height: 29px; width: 100%">		
	<!-- mass edit -->
	<div class="adm-mass">	
		<span class="adm-opt">Instant actions: </span>
		<?php			
			echo "&nbsp;&nbsp;&nbsp;";
			echo $this->Form->button('Save and return', array('class' => 'adm-save'));
			echo '&nbsp;&nbsp;&nbsp;';
			//echo $this->Form->button('Reset stats', array('id' => 'adm-mass-reset'));
			//echo '&nbsp;&nbsp;&nbsp;';
			echo $this->Form->button(($en_valid ? 'Inv' : 'V' ). 'alidate', array('class' => 'adm-validate'));
			echo '&nbsp;&nbsp;&nbsp;';
			echo $this->Form->button('Delete document', array('class' => 'adm-delete'));
		?>
	</div>
	<!-- end mass edit-->	
</div>
<!-- end expert tools -->

<?php echo $this->Form->create(null, array('id' => 'edit-form', 'url' => '/admin_documentos/edit/' . $id. '/' . $criterios_n )); ?>
<?php echo $this->Form->hidden('Action.current', array('value' => $current)); ?>
<div class="yui-g">
	<div class="yui-u first">
		<!-- basics -->
		<div class="adm-edit-doc">
			<h2>Document's Basics</h2>
			<div style="clear: both; height: 10px;"></div>
			<?php								
				echo $this->Form->input('Documento.titulo', array(
				  'label' => 'Document title ',
				  'class' => 'edit',
				  'style' => 'width: 90%;',
				));
				echo '<div style="clear: both; height: 10px;"></div>';
				
				echo "<div style='width: 90%'>";
				echo $this->Form->input('Documento.tags', array(
				  'label' => 'Tags <span style="font-size: .9em; font-style: italic; color: #777">(Separate tags with commas)</span>',
				  'class' => 'edit',
				  'style' => 'width: 90%;',
				));
				echo "</div>";
				
				echo '<div style="clear: both; height: 10px;"></div>';
				echo $this->Form->input('Documento.texto', array(
				  'label' => 'Content ',
				  'value' => stripslashes(str_replace('\n',"\n",$this->data['Documento']['texto'])),
				  'style' => 'width: 90%; height: 300px;'
				  //'rows' => 14,
				  //'cols' => 60,
				));	
			?>
				<div class="created-by">
					<span>Created by <?php echo $this->Text->autoLinkEmails($this->data['Usuario']['autor']); ?> on <?php echo $this->data['Documento']['created']; ?></span> 
				</div>
			<script type="text/javascript">
				add_textboxlist("#DocumentoTags");
			</script>
		</div>
	</div>
		
	<div class="yui-u">
		<div class="adm-expert-panel">
			<!-- expert's panel -->
			<h2>Expert Panel</h2>
			<div style="padding: 15px 0;">												
				<label for="CriterioPregunta" style="display:inline; font-weight: normal;">Current criteria: </label>
				<?php			 
					echo $this->Form->select('Criterio.id_criterio', $criterios_list, $criterios_n, array('empty' => false, 'class' => 'adm-select-criteria'));
					// see #adm-form-criteria 
				?>						
			</div>
			<h3>Challenge information</h3>
			<?php
				$est = $this->data['InformacionDesafio'];
				// official data				
				$off_answer = (is_null($est['respuesta_oficial_de_un_experto']) ? '' : $est['respuesta_oficial_de_un_experto']);
				$off_type = $est['confirmado'];
				
				// possible data 
				$answers = array('0' => 'No', '1' => 'Yes');
				$type = array('0' => 'Non validated', '1' => 'Validated');
			?>
			<div style="clear: both; height: 10px;"></div>
			<?php 
				echo $this->Form->hidden('InformacionDesafio.id_estadisticas');
				//echo $this->Form->hidden('InformacionDesafio.id_criterio', array('value' => $criterios_n));
				//	echo $this->Form->hidden('InformacionDesafio.id_documento', array('value' => $id)); 
			?>			
			
			<label for="InformacionDesafioRespuestaOficialDeUnExperto" style="display:inline; font-weight: normal;">Official answer:</label>
			<?php echo $this->Form->select('InformacionDesafio.respuesta_oficial_de_un_experto', $answers, $off_answer); ?>
			
			<div style="clear: both; height: 10px;"></div>
			
			<label for="InformacionDesafioConfirmado" style="display:inline; font-weight: normal;">Document type:</label>			
			<?php echo $this->Form->select('InformacionDesafio.confirmado', $type, $off_type, array('empty' => false)); ?>
			
			<div style="clear: both; height: 10px;"></div>
			
			<?php echo $this->Form->checkbox('InformacionDesafio.preguntable'); ?>
			<label for="InformacionDesafioPreguntable" style="display:inline; font-weight: normal;">Include in challenges</label>
			
			<div style="clear: both; height: 10px;"></div>
						
			<h3>Statistics</h3>
			
			<?php				
				$si = $est['total_respuestas_2_como_desafio'];
				$no =  $est['total_respuestas_1_como_desafio'];
				$total = $si+$no;
				if($si > 0 && $no > 0):
			?>
			<script type="text/javascript">
		      google.load("visualization", "1", {packages:["corechart"]});
		      google.setOnLoadCallback(drawChart);
		      function drawChart() {
		        var data = new google.visualization.DataTable();
		        data.addColumn('string', 'Answer');
		        data.addColumn('number', 'Votes given so far');
		        data.addRows(2);
		        data.setValue(0, 0, 'Yes');
		        data.setValue(0, 1, <?php echo $si; ?>);
		        data.setValue(1, 0, 'No');
		        data.setValue(1, 1, <?php echo $no; ?>);
		
		        var chart = new google.visualization.PieChart(document.getElementById("chart_div"));
		        chart.draw(data, {
		        	chartArea: {width: "95%", height: "85%", top: 50, left: 10},
		        	width: 280, 
		        	height: 300,
		        	colors: ['#2E6E9E','#FF8F8F'], 
		        	title: '<?php echo $criterios_list[$criterios_n]; ?>'});
		      }
		    </script>			
		    <div class="chart-data" style="height: 310px width: 100%">
		    	<div id="chart_div" style="float:left;"></div>		    	
		    	<div id="chart_data" style="float:left; padding: 20px 0;">
		    		<table class="stats-table">
						<tr>
							<td colspan="3"><strong>Answers given</strong></td>
						</tr>
						<tr>
							<td class="metadata">Yes</td>
							<td><?php echo $si; ?></td>
							<td><?php echo $this->Number->toPercentage(porcentaje($si,$total)); ?></td>
						</tr>
						<tr>
							<td class="metadata">No</td>
							<td><?php echo $no; ?></td>
							<td><?php echo $this->Number->toPercentage(porcentaje($no,$total)); ?></td>
						</tr>
						<tr>
							<td class="metadata">Total</td>
							<td><?php echo $this->Number->format($total); ?></td>
							<td>100%</td>
						</tr>
						<tr>
							<td colspan="3"><?php echo $this->Form->button('Reset stats', array('class' => 'adm-reset')); ?></td>
						</tr>
					</table>
		    	</div>
		    </div>
			<?php else: ?>
			<div style="font-weight: bold; padding: 15px 0; padding-left: 10px;">There's no data to display yet.</div>
			<?php 
				endif;				
			?>
		</div>
	</div>
</div>
<?php echo $this->Form->end(); ?>

<div class="adm-buttons">
	<?php
	// delete 
	//echo $this->Form->create(null, array('url' => '/admin_documentos/remove/'.$id));
	//echo $this->Form->end('Remove document');
	
	// (in)validate		
	//echo $this->Form->create(null, array('url' => '/admin_documentos/set_field/confirmado'.$id.'/'.$value));
	//echo $this->Form->end();
	
	$value = ($en_valid) ? 0 : 1;
	echo "&nbsp;&nbsp;&nbsp;";
	echo $this->Form->button('Save and return', array('class' => 'adm-save'));
	echo "&nbsp;&nbsp;&nbsp;";
	echo $this->Form->button('Cancel', array('class' => 'adm-cancel'));
	
	//echo $this->Form->button(($en_valid ? 'Invalidate' : 'Validate') . ' document', array('class' => 'adm-validate'));
	
	//echo "&nbsp;&nbsp;&nbsp;";
	//echo $this->Form->button('Delete document', array('class' => 'adm-delete'));

	?>
</div>



