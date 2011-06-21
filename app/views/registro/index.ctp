<?php echo $this->Html->image('users.png',array('class' => 'imgicon')) ; ?>

<h1 class="h1icon">  
	Registrarse
</h1>
<div class="clearicon"></div>
<?php
echo $this->Form->create(null, array('action' => '/', 'inputDefaults' => array('error' => false)));
echo $this->Form->input('email');
echo $this->Form->input('nombre');
echo $this->Form->input('apellido');
echo $this->Form->input('password', array('label' => 'Contraseña'));
echo $this->Form->input('password2', array('label' => 'Repita la contraseña', 'type' => 'password'));
echo $this->Form->end('Registrarse');

?>
