<!-- Shows the next and previous links -->
<?php $ws = '&nbsp;'; ?>
<div id="paginator">
<span id="toolbar" class="ui-widget-header ui-corner-all">
	<div id="paginador_administrar" class="admin-paginate">
			<?php
			   if($this->Paginator->hasPrev())
			     echo $this->Paginator->prev('« Previous', null, null, array('class' => 'prevnext'));
			  ?>
			<?php
			   echo $this->Paginator->numbers(array('class' => 'next'));
			?>
			<?php
			   if($this->Paginator->hasNext())
	             echo $this->Paginator->next('Next »', null, null, array('class' => 'prevnext'));
			?>
	</div>
</span>
</div>
<script type="text/javascript">
	$("#paginador_administrar a").button();
	$("#paginador_administrar .current").button({disabled:true});
</script>
