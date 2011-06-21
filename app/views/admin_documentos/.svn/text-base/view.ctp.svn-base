<?php 
$doc = $documento['Documento'];
$usr = $documento['Usuario'];
$tag = $documento['Tag'] ;
$tags = array();
foreach($tag as $t)
   $tags[] = $t['tag'];
?>


<?php echo $this->Html->image('docs.png',array('class' => 'imgicon')) ; ?>

<h1 class="h1icon">  
"<?php echo $doc['titulo']; ?>"
  <span class="small">
	<?php echo $this->Html->link('(editar)', array('controller' => 'admin_documentos', 'action' => 'edit', $doc['id_documento'])) ;?>
  </span>
</h1>
<div class="clearicon"></div>


<div class="info">
  <ul>
	<li>Autor: <?php echo $usr['nombre'] . ' ' . $usr['apellido']; ?></li>
	<li>Email: <?php echo $this->Text->autoLinkEmails($usr['email']); ?></li>
	<li>Fecha creación: <?php echo $doc['created']; ?></li>
  </ul>
</div>
<br />
<br />
<h1>Contenido: </h1>
<div class="premio-contenido">
 <?php echo stripslashes(str_replace('\n', '<br />', $doc['texto'])); ?>
</div>

<br/><br/>
<h1>Tags:</h1>
<div class="premio-contenido">
  <?php echo $this->Text->toList($tags, 'y');  ?>
</div>
