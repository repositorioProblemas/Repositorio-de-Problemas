<?php App::import('Sanitize'); ?>
<script type="text/javascript">	
	$(document).ready(function() {		
		$("#select-all").click(function() {
			var checked = this.checked;
			$(".adm-checkbox-form").each(function() {
				this.checked = checked;
				update_checked($(this));
			}).button("refresh");
		});		
		$("#adm-mass-reset").click(function(e) {			
			 e.preventDefault();
			 $("#ActionMassAction").val("reset");
			 var form = $(this).parent("form");
			 var ok = confirm("Are you sure to reset stats of selected documents?");
			 if(ok)
			 	form.submit();			 
		});
		$("#adm-mass-validate").click(function(e) {			
			 e.preventDefault();
			 $("#ActionMassAction").val("validate");
			 var form = $(this).parent("form");
			 var ok = confirm("Are you sure to (in)validate the selected documents?");
			 if(ok)
			 	form.submit();			 
		});
		$("#adm-mass-delete").click(function(e) {			
			 e.preventDefault();
			 $("#ActionMassAction").val("delete");
			 var form = $(this).parent("form");
			 var ok = confirm("Are you sure to delete selected documents?");
			 if(ok)
			 	form.submit();			 
		});

		//Add Style the checkboxes
		$("#select-all, .adm-checkbox-form").button({icons: {
		                primary: "ui-icon-check"
				            }, text: false}).addClass("adm-checkbox-form");
				            
		//Add Hover functions to rows		
		$("#tabla_documentos tbody tr").hover(hover_tr, hover_tr_out);
		
		$('#tabla_documentos tbody :checkbox').click(function() {
			update_checked($(this));
		});
		
	});

	function hover_tr(){
		$(this).addClass("table-hover");
	}
	
	function hover_tr_out(){
		$(this).removeClass("table-hover");
	}

	function update_checked(item){	
		if(item.attr("checked"))	
			item.parent().parent().parent().addClass('table-hover-checked');
		else
			item.parent().parent().parent().removeClass('table-hover-checked');
	}
</script>
<?php
	function porcentaje($q,$tot) {
		if($tot == 0)
			return 0;
		  return 100*$q/($tot);
		}
	function consenso($a,$b){
		if(($a + $b) == 0)
		  return 0;
		return 100*abs($a-$b)/($a+$b);
	}

	$en_valid = (strcmp($current,'no_validados') == 0) ? false : true; 

	if(!$en_valid) {
		$title = 'Pending validation documents';
	} else {
		if(strcmp($current,'all') == 0)
			$title = 'All documents';
		else
			$title = 'Validated Documents';
	}
	if(!$en_valid)
		$rest = 'no_validado';
	else
		$rest = 'como_desafio';

	$this->viewVars['title_for_layout'] = "Administer $title";
	
	/* breadcrumbs */
	$this->Html->addCrumb('Manage', '/manage/');
	$this->Html->addCrumb($title);
	/* end breadcrumbs */ 
	 

?>
<?php echo $this->Html->image('admin.png',array('class' => 'imgicon')) ; ?><h1 class="h1icon"><?php echo $title; ?></h1>
<div class="clearicon"></div>
<?php echo 
	   $this->element('menu_administrar', array(
		 'isLogged' => $this->Session->check('Usuario.id'), 
		 'isAdmin' => $this->Session->check('Usuario.esAdmin'),
         'current' => $current
	   ));       
?> 

<!-- expert tools -->
<div id="expert-tools">
	<div class="adm-first-row">
		<!-- number of items -->	
		<div class="adm-limit">
			<?php echo $this->Form->create(null, array('url' => '/admin_documentos/'.$current, 'name' => 'select_limit')); ?>
			<span class="adm-opt">Showing: </span>
			<?php			 
				$options = array(
					'5' => '5 documents',
					'10' => '10 documents',
					'20' => '20 documents',
					'50' => '50 documents' 
				);
				echo $this->Form->select('Documento.limit', $options, $limit, array('empty' => false, 'onChange' => 'select_limit.submit()'));			   
			?>
			</form>
		</div>
		<!-- end number of items -->
		
		<!-- ordering -->
		<div class="adm-ordering">
			<?php echo $this->Form->create(null, array('url' => '/admin_documentos/'.$current, 'name' => 'ordering')); ?>
			<span class="adm-opt">Order by: </span>
			<?php
				$options = array(
					'more-ans' => 'More answers',
					'less-ans' => 'Less answers',
					'more-cs' => 'More consensus',
					'less-cs' => 'Less consensus'
				);						 
				echo $this->Form->select('InformacionDesafio.order', $options, $ordering, array('empty' => false, 'onChange' => 'ordering.submit()'));
				echo $this->Form->end(); 
			?>
		</div>
		<!-- end ordering -->
	</div>
	
	<div class="adm-second-row">
		<!-- select criteria -->
		<div class="adm-criteria">
			<?php echo $this->Form->create(null, array('url' => '/admin_documentos/'.$current, 'name' => 'select_criterio')); ?>
			<span class="adm-opt">Criteria: </span>
			<?php			 
				echo $this->Form->select('pregunta', $criterio_list, $criterio_n, array('empty' => false, 'onChange' => 'select_criterio.submit()'));
				echo $this->Form->end(); 
			?>
		</div>
		<!-- end select criteria -->
		
		<!-- filter -->
		<div class="adm-filter">
			<?php echo $this->Form->create(null, array('url' => '/admin_documentos/'.$current, 'name' => 'select_filter')); ?>
			<span class="adm-opt">Filter by: </span>
			<?php
				$options = array(
					'all' => 'All documents',
					'app' => 'Documents with 50% or more approval',
					'dis' => 'Documents with 50% or more disapproval',
					'con' => 'Documents with 50% or more consensus',
					'don' => 'Documents with 50% or less consensus'
				);						 
				echo $this->Form->select('InformacionDesafio.filter', $options, $filter, array('empty' => false, 'onChange' => 'select_filter.submit()'));
				echo $this->Form->end(); 
			?>
		</div>
		<!-- end filter -->
				
		<!-- mass edit -->
		<div class="adm-mass">
		<?php echo $this->Form->create(null, array('id' => 'adm-process', 'url' => '/admin_documentos/mass_edit/'.$criterio_n)); ?>	
			<span class="adm-opt">Selected Documents: </span>
			<?php		
				echo $this->Form->hidden('Action.mass_action');
				echo '&nbsp;&nbsp;&nbsp;';
				echo $this->Form->button('Reset stats', array('id' => 'adm-mass-reset'));
				echo '&nbsp;&nbsp;&nbsp;';
				echo $this->Form->button(($en_valid ? 'Inv' : 'V' ). 'alidate', array('id' => 'adm-mass-validate'));
				echo '&nbsp;&nbsp;&nbsp;';
				echo $this->Form->button('Delete', array('id' => 'adm-mass-delete'));
			?>
		</div>
		<!-- end mass edit-->	
	</div>
</div>
<!-- end expert tools -->

<!-- core table -->
<table id="tabla_documentos" class="ui-widget ui-widget-content tabla" style="width: 100%">
  <thead>
	<tr class="ui-widget-header">
	  <th width="3%" style="text-align:center;font-size:9px" class="clickable"><input type="checkbox" id="select-all" /><label for="select-all">select</label></th> 
	  <th width="55%">Document</th>
	  <th width="27%">Statistics <?php /* echo $this->Paginator->sort('Statistics', "InformacionDesafio.total_respuestas_2_{$rest}"); */ ?></th>
	  <th width="15%">Options</th>
	</tr>
  </thead>
  <tbody>
  <?php 
  	$i = 0;
  	foreach($data as $d):  
  		$id = $d['Documento']['id_documento'];  	
  ?>
	<tr>
		<td class="clickable"><div class="adm-checkbox" style="font-size:9px"><?php echo $this->Form->checkbox('Documento.'.$i.'.id_documento', array('value' => $id, 'class' => 'adm-checkbox-form')); 
						    echo "<label for='Documento".$i."IdDocumento'>check</label>"; ?></div></td>
		<td>
			<!-- doc -->
			<span class="admin-doc-titulo">
				<?php echo $this->Html->link(Sanitize::html($d['Documento']['titulo']), array('action' => 'view', $id), array('escape' => false)) ;?>
			</span>
			<div class="admin-doc-texto">			
				<?php echo $this->Text->truncate(
					str_replace(
						'\n', 
						'<br />', 
						Sanitize::html($d['Documento']['texto'])), 
					350, 
					array(
						'ending' => '<a href="'.$this->Html->url(array('controller' => 'admin_documentos', 'action' => 'edit', $id)).'">...</a>', 
						'exact' => false, 
						'html' => true)); 
				?>				
			</div>
			<div class="created-by">
				Created on <?php echo $d['Documento']['created']; ?> by <?php echo $d['Documento']['nombre_autor']; ?>. 
			</div>
		</td>
		<td>
			<!-- consenso -->
			<?php				
				// convencion............. 1 = no, 2 = si
				$no = $d['InformacionDesafio']["total_respuestas_1_como_desafio"];
				$si = $d['InformacionDesafio']["total_respuestas_2_como_desafio"];
				$tot = $no + $si;
				
				$pno = porcentaje($no, $tot);
				$psi = porcentaje($si, $tot);				
			?>
			<?php if($d['InformacionDesafio']['total_respuestas']>0): ?>
			<div style="width: 95%; clear:both; margin: 0 auto; height: 2em">
				<div style="float:left;"><?php echo 'Yes ('.$this->Number->precision($psi, 1).'%)'; ?></div>
				<div style="float:right;"><?php echo 'No ('.$this->Number->precision($pno, 1).'%)'; ?></div>				
			</div>		
			<div class="progressbar-doc-<?php echo $id; ?>" style="width: 95%; margin: 0 auto;background-image:none;background-color:#E79A3D"></div>
			<script>$('.progressbar-doc-<?php echo $id; ?>').progressbar({value: <?php echo $psi; ?>});</script>
			<div style="text-align:center;width:95%;clear:both; margin: 0 auto; height: 2em">
				<?php echo $d['InformacionDesafio']['total_respuestas'] ; ?> 
				answers<?php if($d['InformacionDesafio']['confirmado']==1){echo ", official ".(($d['InformacionDesafio']['respuesta_oficial_de_un_experto']==0)?("No"):("Yes")) ;} ?>
			</div>
			<?php else: ?>
				<div style="text-align:center">
					There is no data to display yet...
				</div>
			<?php endif;?>
		</td>
		<td>
			<!-- options -->
			<div class="admin-doc-edit">
				<?php echo $this->Html->link('Edit', array('action' => 'edit', $id)); ?>
				&nbsp; | &nbsp;   
				<?php echo $this->Html->link('Remove', array('action' => 'remove', $id), array(), "Are you sure?"); ?>
			</div>
		</td>
	</tr>  
  <?php 
  	$i += 1;
  	endforeach; 
  ?>
  </tbody>
</table>
<!-- end core table -->
</form>
<?php echo $this->element('paginator_info'); ?>

<?php echo $this->element('paginator'); ?> 
	

 
