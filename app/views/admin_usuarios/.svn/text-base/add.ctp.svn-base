<?php

$title = "Add new user";
/* breadcrumbs */
$this->Html->addCrumb('Manage', '/manage/');
$this->Html->addCrumb('Users', '/admin_usuarios');
$this->Html->addCrumb($title);
/* end breadcrumbs */ 
$this->viewVars['title_for_layout'] = $title;
?>

<?php echo $this->Html->image('users.png',array('class' => 'imgicon')) ; ?><h1 class="h1icon" style="margin-top: 15px;"><?php echo $title; ?></h1>
<div class="clearicon"></div>
<?php echo
          $this->element('menu_administrar', array(
                'isLogged' => $this->Session->check('Usuario.id'),
                'isAdmin' => $this->Session->check('Usuario.esAdmin'),
				'current' => $current
          ));      
       
     ?>
  <?php echo $this->Form->create('Usuario', array('url' => '/admin_usuarios/add')); ?>
  <?php echo $this->Form->input('email');?>
  <?php echo $this->Form->input('nombre', array('label' => 'Name'));?>
  <?php echo $this->Form->input('apellido', array('label' => 'Last Name'));?>
  <?php echo $this->Form->input('password');?>
  <?php echo $this->Form->input('puntos', array('label' => 'Initial Points'));?>
<label for="UsuarioEsAdministrador">Is Administrator?</label>
  <?php echo $this->Form->input('es_administrador', array('label' => false ));?>
<label for="UsuarioEsAdministrador">Is Expert?</label>
  <?php echo $this->Form->input('Usuario.es_experto', array('type' => 'checkbox', 'label' => false ));?>
  <?php echo $this->Form->end('Add');?>
