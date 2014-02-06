<script src="<?php echo base_url('js/general/jquery.validate.min.js'); ?>"></script>

<script type="text/javascript">
$(function(){

	$(document).on("keyup",'.btn-primary',function(e){
		var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
		if (key == 13)
			$(this).trigger('click');
	});

	$(window).keydown(function(event){
		if (event.keyCode == 13) {
			event.preventDefault();
			return false;
		}
	});

	$(document).on("keyup",'input,select,textarea',function(e){
		var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
		var inputs = $(this).closest('form').find(":input:not(:disabled, [readonly='readonly'],:hidden)");
		if (key == 13) {
			inputs.eq( inputs.index(this)+1 ).focus();
		}else if(key == 27){
			inputs.eq( inputs.index(this)-1).focus();
		}
	});

	$.extend(jQuery.validator.messages,{
		required:'Campo obligatorio',
		email:'Ingrese un email válido',
		date:'Ingrese una fecha válida',
		numer:'Sólo se permiten números',
		digits:'Sólo se permiten números',
		range: jQuery.validator.format('Por favor ingrese un valor entre {0} y {1}.'),
	});

});
</script>

<div class="row-fluid" id="pptt-tabs" style="margin-top:10px">
	<div class="span12" id="insidetabs" style="text-align:center">
		<div class="tabbable">
			<ul id="nav_pptt" class="nav nav-tabs fix_navcap">
				<li id="ctab1"><a href="#tab1" data-toggle="tab">Datos Generales</a></li>
				<li id="ctab2"><a href="#tab2" data-toggle="tab">Detalle PPTT</a></li>
			</ul>
			<div class="tab-content fix_tabcontent">
				<div class="tab-pane" id="tab1">
					<p><?php $this->load->view('presupuesto/forms/datos_generales_form'); ?></p>
				</div>
				<div class="tab-pane" id="tab2">
					<p><?php $this->load->view('presupuesto/forms/detalle_pptt_form'); ?></p>
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