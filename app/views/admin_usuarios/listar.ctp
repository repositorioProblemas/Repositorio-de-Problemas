<?php
$title = 'Users';
$this->viewVars['title_for_layout'] = "Manage $title";

/* breadcrumbs */
$this->Html->addCrumb('Manage', '/manage/');
$this->Html->addCrumb($title);
/* end breadcrumbs */ 
?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#adm-new-user").click(function(e) {
			e.preventDefault();
			$(window.location).attr('href', '<?php echo $this->Html->url(array('controller' => 'admin_usuarios', 'action' => 'add'));?>');
		});	
	});	
</script>
<?php echo $this->Html->image('admin.png',array('class' => 'imgicon')) ; ?><h1 class="h1icon" style="margin-top: 15px;"><?php echo $title; ?></h1>
<div class="clearicon"></div>

<?php echo
          $this->element('menu_administrar', array(
                'isLogged' => $this->Session->check('Usuario.id'),
                'isAdmin' => $this->Session->check('Usuario.esAdmin'),
				'current' => $current
          ));      
       
     ?>

<br/>
<div style="text-align : left; float : left; width : 70%">
	<?php echo $this->element('paginator_info'); ?>
	
</div>

<!-- expert tools -->
<div id="expert-tools">
	<!-- mass edit -->
	<div class="adm-mass">
		<!--<span class="adm-opt">Selected Documents: </span>-->
		<?php		
			echo '&nbsp;&nbsp;&nbsp;';
			echo $this->Form->button('Add new user', array('id' => 'adm-new-user'));
		?>
	</div>
	<!-- end mass edit-->	
</div>
<!-- end expert tools -->

<div style="clear:both;"></div>
<div style="text-align:left">
<table class="ui-widget ui-widget-content tabla" style="width: 100%">
  <thead>
	<tr class="ui-widget-header"> 
		  <th><?php echo $this->Paginator->sort('ID', 'Usuario.id_usuario');?></th>
	  <th><?php echo $this->Paginator->sort('E-mail', 'Usuario.email'); ?></th>
	  <th><?php echo $this->Paginator->sort('First name', 'Usuario.nombre'); ?></th>
	  <th><?php echo $this->Paginator->sort('Last name', 'Usuario.apellido'); ?></th>
	  <th><?php echo $this->Paginator->sort('Points', 'Usuario.puntos'); ?></th>
	  <th><?php echo $this->Paginator->sort('Is Admin?', 'Usuario.es_administrador'); ?></th>
	  <th><?php echo $this->Paginator->sort('Is Expert?', 'Usuario.es_experto'); ?></th>
	  <th width="100">Options</th>
	</tr>
  </thead>
  <tbody>
	<?php foreach($data as $u): ?>
	<tr>
	  <td><?php echo $u['Usuario']['id_usuario']; ?></td>
	  <td><?php echo $this->Html->link($u['Usuario']['email'], 
									   array('action' => 'edit', $u['Usuario']['id_usuario'])); ?></td>
	  <td><?php echo $u['Usuario']['nombre']; ?></td>
	  <td><?php echo $u['Usuario']['apellido']; ?></td>
	  <td><?php echo $u['Usuario']['puntos']; ?></td>
	  <td>
		<?php
		   if($u['Usuario']['es_administrador'])
		   echo 'Yes';
		   else echo 'No'; 
		   ?>
	  </td>
	  <td>
		<?php
		   /* busqueda secuencial...*/
		   $pass = true;
		   foreach($experts as $e) {
		   	if($e['Experto']['id_usuario'] == $u['Usuario']['id_usuario']) {
		   		echo 'Yes';
		   		$pass = false;
		   		break;
		   	}
		   }
		   if($pass) echo 'No';
		   ?>
	  </td>
	  <td>
	  	<div class="admin-doc-edit">
		  <?php echo $this->Html->link('Edit', array('action' => 'edit' , $u['Usuario']['id_usuario'])); ?>
		  &nbsp; | &nbsp;
		  <?php echo $this->Html->link('Remove', array('action' => 'remove' , $u['Usuario']['id_usuario']), null, 'Are you sure?'); ?>
		</div>
	  </td>
	</tr>
	<?php endforeach; ?>
  </tbody>
</table>
</div>

 <?php echo $this->element('paginator'); ?>

<script type="text/javascript">
	$(function(){
		$("#lnk_add").button({ icons : {primary : "ui-icon-plus"} });
	};
</script>
