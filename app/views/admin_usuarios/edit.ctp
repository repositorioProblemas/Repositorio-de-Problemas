<?php
/* breadcrumbs */
$this->Html->addCrumb('Manage', '/manage/');
$this->Html->addCrumb('Users', '/admin_usuarios');
$this->Html->addCrumb('Edit user');
/* end breadcrumbs */ 
?>


<?php echo $this->Html->image('users.png',array('class' => 'imgicon')) ; ?><h1 class="h1icon">Edit user - <?php echo $this->data['Usuario']['email'];?></h1>
<div class="clearicon"></div>
<?php echo 
	   $this->element('menu_administrar', array(
		 'isLogged' => $this->Session->check('Usuario.id'), 
		 'isAdmin' => $this->Session->check('Usuario.esAdmin'),
         'current' => $current
	   ));       
?> 

 <?php echo $this->Form->create('Usuario', array('url' => '/admin_usuarios/edit/' . $this->data['Usuario']['id_usuario']));?>
 <?php echo $this->Form->input('id_usuario', array('type' => 'hidden')); ?>
 <?php echo $this->Form->input('nombre', array('label' => 'First name')); ?>
 <?php echo $this->Form->input('apellido', array('label' => 'Last name')); ?>
 <?php echo $this->Form->input('tmp_password', array('type' => 'password', 'label' => 'New Password (leave in blank if you don\'t want to change it)'));?>
 <?php echo $this->Form->input('tmp_password2', array('type' => 'password', 'label' => 'Repeat New Password'));?>
<label for="UsuarioEsAdministrador">Is Administrator?</label>
  <?php echo $this->Form->input('es_administrador', array('label' => false ));?>
<label for="UsuarioEsAdministrador">Is Expert?</label>
  <?php echo $this->Form->input('Usuario.es_experto', array('type' => 'checkbox', 'label' => false ));?>
 <?php echo $this->Form->input('puntos', array('label' => 'Points')); ?>
 <?php echo $this->Form->end('Save'); ?>
