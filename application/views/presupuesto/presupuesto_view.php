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

	$.validator.addMethod("EqualsUno", function(value, element, arg){
		flag = false;
		if ( $('#' + arg[0]).val() == value ) { flag = true; }
		return  flag;
	}, "El Total de Meses diferente al Total General");

	$.validator.addMethod("EqualsDos", function(value, element, arg){
		flag = false;
		var cod = element.id;
		array=cod.split("_");
		if ( value == $('#'+arg[0]+array[3]).val() ) { flag = true; }
		return  flag;
	}, "Total de Mes Incorrecto");

	$.validator.addMethod("EqualsTres", function(value, element, arg){
		flag = true;
		var cod = element.id;
		array=cod.split("_");
		var posi = parseInt(array[3]) + 1;

		if ( posi == $('#'+arg[1]).val())
		{
			var sum = 0;
			for (var i = 0; i < posi; i++) {
				valor = $('#'+array[0]+'_'+array[1]+'_'+array[2]+'_'+i+'_'+array[4]).val();
				valor = (valor == '') ? 0 : valor;
				sum = parseFloat(sum) + parseFloat(valor);
			}
			if ( sum != $('#'+arg[0]+array[4]).val() ) { flag = false; }
		}
		return  flag;
	}, "Suma de Meses no coincide con Subtotal");

});
</script>	

<!-- <select id="proyect">
	<option value = "0">SELECCIONE</option>
	<option value = "1">CENSO DEPARTAMENTAL PARA PROGRAMA PILOTO TUMBES ACCESIBLE 2012</option>
</select> -->

<div class="row-fluid" id="pptt-tabs">
	<div class="span12" id="insidetabs">

<!-- 		<h1 class="entry-title">Presupuesto General</h1>
 -->

		<div class="tabbable">
			<ul id="nav_pptt" class="nav nav-tabs fix_navcap">
				<li id="ctab1" class="active"><a href="#tab1" data-toggle="tab">Datos Generales</a></li>
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

	$('#proyect').change(function(event){
		$('#ctab1 a').trigger('click');
	});

});

</script>