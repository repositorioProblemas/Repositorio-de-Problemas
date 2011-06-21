<?php echo $this->Html->image('users.png',array('class' => 'imgicon')) ; ?><h1 class="h1icon">Edit user - <?php echo $this->data['Usuario']['email'];?></h1>
<div class="clearicon"></div>
<div class="pointsprofile">
	You have <?php echo $this->data['Usuario']['puntos']; ?> points.
</div>
<?php echo $this->Form->create('Usuario', array('url' => '/usuarios/edit/'. $this->data['Usuario']['id_usuario']));?>
<?php echo $this->Form->input('id_usuario', array('type' => 'hidden')); ?>
<?php echo $this->Form->input('nombre', array('label' => 'Name')); ?><br/>
<?php echo $this->Form->input('apellido', array('label' => 'Last Name')); ?><br/>
<?php echo $this->Form->input('tmp_password', array('type' => 'password', 'label' => 'New Password (leave in blank if you don\'t want to change it)'));?><br/>
<?php echo $this->Form->input('tmp_password2', array('type' => 'password', 'label' => 'Repeat New Password'));?><br/>
<?php echo $this->Form->end('Save Changes'); ?> 
