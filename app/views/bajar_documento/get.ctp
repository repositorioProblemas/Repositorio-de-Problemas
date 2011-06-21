

<?php if(empty($premio)) { ?>
<span class="info">There  isn't any document that matches with your search terms!</span>
<?php } else { ?>




<?php echo $this->Html->image('docs.png',array('class' => 'imgicon')) ; ?>

<h1 class="h1icon">  
	Download Documents	
</h1>
<div class="clearicon"></div>

<span class="info">Congratulations! Here you have  <?php echo count($premio); ?>  problems with their solutions: </span>


<?php foreach($premio as $d): ?>

<br/>
<br/>
<span style="font-weight:bold"  class="admin-doc-titulo">
	<?php echo $d['Documento']['titulo'];?>
</span>
<br/>
<br/>
<div class="admin-doc-texto">
<pre>
	<?php echo str_replace(
			'\n', 
			'<br />', 
			Sanitize::html($d['Documento']['texto']));?>				
</pre>
</div>
<div class="created-by">
	Created on <?php echo $d['Documento']['created']; ?> by <?php echo $d['Documento']['nombre_autor']; ?>. 
</div>
<?php endforeach;}?>
<br />




