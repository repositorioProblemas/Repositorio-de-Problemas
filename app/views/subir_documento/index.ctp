<?php
$title = "Add new document";	
$this->viewVars['title_for_layout'] = $title;
$this->Html->addCrumb($title);
?>

<?php echo $this->Html->image('add_doc.png',array('class' => 'imgicon')) ; ?><h1 class="h1icon" style="margin-top: 15px;"><?php echo $title;?></h1>
<div class="clearicon"></div>

<fieldset class="datafields">

<?php echo $this->Form->create(null, array('url' => '/subir_documento/subir'));?>

<?php echo $this->Form->input('Documento.titulo', array('class' => 'ingresar-documento', 'label' => 'Title', 'default' => '', 'size' => 50)); ?>

<?php echo $this->Form->input('Documento.texto', array('class' => 'ingresar-documento', 'label' => 'Content', 'rows' => 14, 'cols' => 80, 'default' => '')); ?>

<div style="width:400px">

<?php echo $this->Form->input('Documento.tags', array('class' => 'ingresar-documento', 'size' => 100)); ?>
     
</div>
<script type="text/javascript">
	add_textboxlist("#DocumentoTags");
</script>
<?php echo $this->Form->end('Done'); ?>
</fieldset>
<br />
<div class="ui-widget">
	<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 10px .7em;"> 
		<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
		<strong>Hey!</strong> You may add more tags separating them by commas (,)</p>
	</div>
</div>


