<script src="<?php echo base_url('js/jquery.validate.min.js'); ?>"></script>
<script src="<?php echo base_url('js/validate.js'); ?>"></script>

<!-- <select id="proyect">
	<option value = "0">SELECCIONE</option>
	<option value = "1">CENSO DEPARTAMENTAL PARA PROGRAMA PILOTO TUMBES ACCESIBLE 2012</option>
</select> -->
<?php echo form_hidden('cod_pryct', $cod_pryct); ?>
<div class="row-fluid" id="pptt-tabs">
	<div class="span12" id="insidetabs">

<!-- 		<h1 class="entry-title">Presupuesto General</h1>
 -->

		<div class="tabbable">
			<ul id="nav_pptt" class="nav nav-tabs fix_navcap">
				<li id="ctab1"><a href="#tab1" data-toggle="tab">Datos Generales</a></li>
				<li id="ctab2"><a href="#tab2" data-toggle="tab">Detalle PPTT</a></li>
				<li id="ctab3"><a href="#tab3" data-toggle="tab">Exportar</a></li>
			</ul>
			<div class="tab-content fix_tabcontent">
				<div class="tab-pane" id="tab1">
					<p><?php $this->load->view('presupuesto/forms/datos_generales_form'); ?></p>
				</div>
				<div class="tab-pane" id="tab2">
					<p><?php $this->load->view('presupuesto/forms/detalle_pptt_form'); ?></p>
				</div>
				<div class="tab-pane" id="tab3">
					<p><?php $this->load->view('presupuesto/forms/exportar'); ?></p>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

$(function(){

	$('#ctab1 a').trigger('click');

});

</script>