<h1>Administración de usuarios</h1>
<span>Actualmente hay <?php echo $count; ?> usuarios registrados</span>
<ul>
  <li><?php echo $this->Html->link('Listar usuarios registrados', array('action' => 'listar'));?></li>
  <li><?php echo $this->Html->link('Agregar nuevo usuario', array('action' => 'add')); ?></li>
</ul>
