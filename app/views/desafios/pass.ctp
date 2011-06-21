<?php App::import('Sanitize'); ?>
<script type="text/javascript">
	function setReady(i, total){
		
		$("#span" + i).html("Ready").removeClass("desafio-not-ready").addClass("desafio-ready");
		if($(".desafio-ready").length == total){
			$("#btn_continue").button("enable");
			$("#submit_message").hide();
		}
		if(i+1<total){	
			$('#desafio-contenido-wrap').accordion("activate",i+1);
		}
		if(i+1==total){
			$('#desafio-contenido-wrap').accordion("activate",false);
		}
	}
	function opendialog(){
		$("#advertisement").dialog("open");
	}
	$(function(){
		$("#advertisement").dialog({
			height: 300,
			width: 500,
			autoOpen:false,
			modal: true,
			buttons: {
				Register: function(){
					document.location="<?php echo $this->Html->url(array('controller' => 'registro', 'action' => 'index')); ?>";
				}
				,Close: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	});
</script>
<div id="advertisement" title="Join Us!"  style="text-align:left;">
	<h2>Join our community!</h2>
	<br/>
	<p>By joining us you will enjoy the following benefits:</p>

	<ul style="margin-top:15px; font-weight:bold ; color:green" >
		<li type="disc" style="margin-bottom:7px">- Answer less questions per challenge</li>
		<li type="disc" style="margin-bottom:7px">- Get points by uploading new content</li>
		<li type="disc" style="margin-bottom:7px">- Redeem points for high quality content certified by users and experts </li>
	</ul>
	
</div>
<?php echo $this->Html->image('math.png',array('class' => 'imgicon')) ; ?>

<h1 class="h1icon">  
	Solve Challenge
</h1>
<div style="clear:both"></div>
<br/>

<p>To solve this challenge you must answer correctly the following questions:</p>

<?php if($this->Session->check('Usuario.id') and $this->Session->read('Usuario.id') > 0): ?>
<div class="ui-widget">
	<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 10px .7em;"> 
		<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
		<strong>Hey!</strong> You can avoid doing this challenge by spending <?php echo $puntos; ?> points! Just click the following link :  
		<?php 
		echo $this->Html->link('Spend Points', '/desafios/saltar', array('class' => 'link-avoid'));
		?>
		</p>
	</div>
</div>
<?php endif; ?>
<?php if(!$this->Session->check('Usuario.id') || !$this->Session->read('Usuario.id') > 0): ?>
<div class="ui-widget">
	<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 10px .7em;"> 
		<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
		<strong>Still solving long challenges?</strong>  There's a way to make things easier for you! <a class="link-avoid" onclick="opendialog()"> Learn more...  </a>  
		</p>
	</div>
</div>
<?php endif; ?>
<br/>
<br/>
<!-- <div class="clearicon"></div> -->
<!--<span class="info">Para obtener un pack de <?php echo $criterio['Criterio']['tamano_pack']; ?> 
documentos, deberás contestar correctamente este desafío</span>-->
		<?php 
			echo $this->Form->create(null, array('url' => '/desafios/procesar',
							     'inputDefaults' => array (
			            			     'fieldset' => false,
				                	     'legend' => false)));
		?>
		<div id="desafio-contenido-wrap">
			<?php
			$i = 0; 
			$total=count($documentos);
			foreach($documentos as $d) : 
			?>

			<h3 style="width:100%">
				<a href="#">
				<?php echo Sanitize::html($d['titulo']); ?>
				<span id="span<?php echo $i; ?>" style="float:right;text-align:right;" class="desafio-not-ready">Not Ready</span>	
				</a>
			</h3>
			<div> 
				<div><?php echo stripslashes(str_replace('\n', '<br />', Sanitize::html($d['texto']))); ?></div>
				<div>
					<?php
					
					$script_click = "setReady(".$i.", ".$total." );" ;
					
					$options = array(
					'1' => $criterio['Criterio']['respuesta_1'],
					'2' => $criterio['Criterio']['respuesta_2']);  	
					$attr = array(
					'onClick' => $script_click,
					'label' => true,
					'legend' => false);
					?>
					<p style="font-weight:bold;margin-top:10px;color:#D97C19"><?php echo $criterio['Criterio']['pregunta']; ?></p>

					<div class="radios">
					<?php echo $this->Form->radio('Desafio.'.$i.'.respuesta', $options, $attr);?>
					</div>
					<?php
					echo $this->Form->hidden('Desafio.'.$i.'.id_criterio', array('value' => $criterio['Criterio']['id_criterio']));
					echo $this->Form->hidden('Desafio.'.$i.'.id_documento', array('value' => $d['id_documento']));
					$i++;
					?>
				</div>

			</div>
			<?php endforeach; ?>
		</div>
		
		<p id="submit_message">You must give an answer for each question to continue!</p>
		<?php 
		echo $this->Form->end(array('value' => 'Continue','id' => 'btn_continue'));
		?>

<script type="text/javascript">

	$(function(){
		$("#btn_continue").button("disable");
		});
	$('#desafio-contenido-wrap').accordion({collapsible : true, autoHeight : false});
	$('.radios').buttonset();
</script>
