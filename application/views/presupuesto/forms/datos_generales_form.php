<?php 

////////////////////////////////////
////// DATOS GENERALES /////////////
////////////////////////////////////

$SubTotal = array(
	'name'	=> 'Subtotal',
	'id'	=> 'Subtotal',
	'class'	=> 'form-control input30 calculo',
);

$IGV = array(
	'name'	=> 'IGV',
	'id'	=> 'IGV',
	'class'	=> 'form-control input15 calculo',
);

$Total_Gral = array(
	'name'	=> 'Total_Gral',
	'id'	=> 'Total_Gral',
	'readonly' => 'true',
	'class'	=> 'form-control input30',
);

$Cantidad_Mes = array(
	'name'	=> 'Cantidad_Mes',
	'id'	=> 'Cantidad_Mes',
	'maxlength'	=> 2,
	'class'	=> 'form-control input2',
);

$Nro_Actividades = array(
	'name'	=> 'Nro_Actividades',
	'id'	=> 'Nro_Actividades',
	'maxlength'	=> 2,
	'class'	=> 'form-control input2',
);

$Nro_Partidas = array(
	'name'	=> 'Nro_Partidas',
	'id'	=> 'Nro_Partidas',
	'maxlength'	=> 2,
	'class'	=> 'form-control input2',
);


$attr = array('id' => 'pptt_gnrl_frm','accept-charset' => 'UTF-8');

echo form_open($this->uri->uri_string(),$attr);

?>

<div>
	
	<h2>Presupuesto General</h2>

	<div class="row"><div class="form-inline" role="form">

		<div class="col-xs-3">

			<div class="form-group">
				<label>Total General</label>
				<?php echo form_input($Total_Gral); ?>
			</div>

		</div>

		<div class="col-xs-3">

			<div class="form-group">
				<label>Subtotal</label>
				<?php echo form_input($SubTotal); ?>
				<div class="help-block has-error"></div>
			</div>

		</div>

		<div class="col-xs-3">

			<div class="form-group">
				<label>IGV</label>
				<?php echo form_input($IGV); ?>
				<div class="help-block has-error"></div>
			</div>

		</div>

		<div class="col-xs-3">

			<div class="form-group">
				<label>Cantidad de Meses</label>
				<?php echo form_input($Cantidad_Mes); ?>
				<div class="help-block has-error"></div>
			</div>	

		</div>						

	</div></div><!-- end row -->

	<hr />

	<div class="form-inline" role="form">

	<h2>Presupuesto Mensual</h2> <input id="total_mcs" class="form-control input8" name="total_mcs" type="text" readonly /><div class="help-block has-error"></div>

	

	<table id="pptt_meses" class="table table-striped table-hover">
		<thead>
			<th width="60px">COD</th>
			<th>MES</th>
			<th>SUBTOTAL</th>
			<th>IGV</th>
			<th>TOTAL</th>
		</thead>
		<tbody>
		</tbody>
	</table>

	</div><!-- end form presupuesto -->

	<hr />

	<div class="form-inline" role="form">

	<h2>Cantidad de Actividades</h2> <?php echo form_input($Nro_Actividades); ?><div class="help-block has-error"></div>

	<table id="pptt_actividades" class="table table-striped table-hover">
		<thead>
			<th width="60px"></th>
			<th width="60px">COD.</th>
			<th>ACTIVIDAD</th>
			<th>SUBTOTAL <input type="text" id="total_actvd" class="form-control input8" name="total_actvd" readonly /><div class="help-block has-error"></div> </th>
			<th class='prct_act'>%</th>
		</thead>
		<tbody>
		</tbody>
	</table>

	</div><!-- end form actividades -->

	<hr />

	<div class="form-inline" role="form">

	<h2>Cantidad de Partidas</h2> <?php echo form_input($Nro_Partidas); ?> <div class="help-block has-error"></div>

	<table id="pptt_partidas" class="table table-striped table-hover">
		<thead>
			<th width="60px"></th>
			<th>COD.</th>
			<th>PARTIDA</th>
			<th>SUBTOTAL <input type="text" id="total_part" class="form-control input8" name="total_part" readonly /><div class="help-block has-error"></div> </th>
			<th class='prct_part'>%</th>
		</thead>
		<tbody>
		</tbody>
	</table>

	</div><!-- end form partidas -->

</div>

<?php 
echo form_submit('send', 'Guardar','class="btn btn-primary"');
echo form_close();
// echo 'soy el nro d act '.$cantidad1;
?>

<script type="text/javascript">

$(function(){

	$.each( <?php echo json_encode($presup->row()); ?>, function(fila, valor) {
		$('#' + fila).val(valor);
		if (fila == 'Cantidad_Mes') { $('#Cantidad_Mes').trigger('change'); }
	});

	$('#Nro_Actividades').val( <?php echo $cantidad1; ?> );
	$('#Nro_Actividades').trigger('change');

	$('#Nro_Partidas').val(<?php echo $cantidad2; ?>);
	$('#Nro_Partidas').trigger('change');

	if ( $("input[name='cod_pryct']").val() == 0 || $("input[name='cod_pryct']").val() == '' ){ 
		$( "#pptt_gnrl_frm :submit" ).attr("disabled", "disabled");
	} else {
		$( "#pptt_gnrl_frm :submit" ).removeAttr("disabled");
	}

});

$(document).on("change",'.calculo',function() {
	var campo = $(this);
	var cod = campo.attr('id');

	if ( $('#IGV').val() > 0 )
	{
		calc_igv('Subtotal','IGV');// calcula el igv
	}

	calc_totgnrl($('#Subtotal').val(),$('#IGV').val(),'Total_Gral');// sumatoria del subtotal e igv
	$('.act_calculo_pptt').trigger('change');// recalcula el porcentaje de las filas en la tabla actividad
	$('.part_calculo_pptt').trigger('change');// recalcula el porcentaje de las filas en la tabla partida
});

function calc_totgnrl(par1, par2, view){
	par1 = (par1.trim() != '') ? par1 : 0;
	par2 = (par2.trim() != '') ? par2 : 0;
	monto = parseFloat(par1) + parseFloat(par2);
	$('#'+view).val(monto);
}

function calc_igv(sbt,view) {
	monto = $('#'+sbt).val();
	monto = (monto.trim() != '') ? monto : 0;
	igv = (parseFloat(monto) * 0.18);
	$('#'+view).val(igv.toFixed(2));
}

$('#Cantidad_Mes').change(function(event) {
	nro = $(this).val();
	$('#pptt_meses > tbody > tr').remove();

	if (nro > 0){
		html = '';
		for (var i = 0; i < nro; i++){ 
			html += '<tr>';
			html += '<td><input type="text" id="Mes_'+i+'" name="Mes[]" maxlength="2" class="form-control input2 meses" /><div class="help-block has-error"></div> </td>';
			html += '<td><input type="text" id="name_mcs_'+i+'" name="name_mcs_[]" class="form-control input13" readonly /><div class="help-block has-error"></div> </td>';
			html += '<td><input type="text" id="Subtotal_M_'+i+'" name="Subtotal_M[]" class="form-control input8 calculo_mcs" /><div class="help-block has-error"></div> </td>';
			html += '<td><input type="text" id="IGV_M_'+i+'" name="IGV_M[]" class="form-control input8 calculo_mcs" /><div class="help-block has-error"></div> </td>';
			html += '<td><input type="text" id="Total_Gral_M_'+i+'" name="Total_Gral_M[]" class="form-control input8" readonly /></td>';
			html += '</tr>';
		}
		$('#pptt_meses > tbody').append(html);
	}


	$.each( <?php echo json_encode($presup_mes->result()) ?>, function(i, datos){
		$('#Mes_'+i).val(datos.Mes);
		buscar_meses(datos.Mes, i);
		$('#Subtotal_M_'+i).val(datos.Subtotal_M);
		$('#IGV_M_'+i).val(datos.IGV_M);
		$('#Total_Gral_M_'+i).val(datos.Total_Gral_M);
	});
	suma_total_meses();

	$('#Nro_Actividades').trigger('change');
	$('#Nro_Partidas').trigger('change');
	$('#Mes_0').focus();
});

$(document).on("change",'.calculo_mcs',function() {
	var campo = $(this);
	var cod = campo.attr('id');
	array=cod.split("_");

	if ( $('#IGV_M_'+array[2]).val() > 0 )
	{
		calc_igv('Subtotal_M_'+array[2],'IGV_M_'+array[2]); //calcula igv
	}

	calc_totgnrl( $('#Subtotal_M_'+array[2]).val(), $('#IGV_M_'+array[2]).val(), "Total_Gral_M_"+array[2]+"" ); // sumatoria del subtotal e igv
	suma_total_meses(); // suma el total de todos los meses
});

function suma_total_meses() {
	monto = 0;
	mcs = $('#Cantidad_Mes').val();
	for (var i = 0; i < mcs; i++) {
		valor = $('#Total_Gral_M_'+i).val();
		valor = ( valor.trim() != '' ) ? valor : 0;
		monto = parseFloat(monto) + parseFloat(valor);
	}
	$('#total_mcs').val(monto.toFixed(2));
}

$(document).on("change",'.meses',function() {
	var campo = $(this);
	var id = campo.attr('id');
	array=id.split("_");
	buscar_meses(campo.val(),array[1]);// consulta mes por codigo
});

function buscar_meses(codigo,posi){
	$.getJSON(CI.site_url+'/general/general/meses', {codigo:codigo,ajax:1}, function(json_data, textStatus) {

		$('#name_mcs_'+posi).val('');
		$('#act_nombre_mes_'+posi).val('');
		$('#part_nombre_mes_'+posi).val('');
		$.each(json_data, function(i,datos){
			$('#name_mcs_'+posi).val(datos.Nombre);
			$('#act_nombre_mes_'+posi).val(datos.Nombre);
			$('#part_nombre_mes_'+posi).val(datos.Nombre);
		});
	});
}


////////////////////////////////////////////////
////// ACTIVIDADES
////////////////////////////////////////////////
$('#Nro_Actividades').change(function(event){

	mcs = $('#Cantidad_Mes').val();
	
	$('.act_meses').remove();
	
	if (mcs > 0){
		html = '';
		for (var i = 0; i < mcs; i++) {
			html += '<th class = "act_meses"><input type="text" id="act_nombre_mes_'+i+'" class="form-control input13" name="act_nombre_mes_'+i+'" value="'+$('#name_mcs_'+i).val()+'" readonly />';
			html += '<input type="text" id="act_total_mes_'+i+'" class="form-control input8" name="act_total_mes_[]" readonly /><div class="help-block has-error"></div> </th>';
		}
		$('.prct_act').after(html);

		act = $(this).val();
		$('#pptt_actividades > tbody > tr').remove();
		if (act > 0){
			html2 = '';
			for (var j = 0; j < act; j++) {
				html2 += '<tr>';
				html2 += '<td><input type="text" id="Nro_Act_'+j+'" name="Nro_Act[]" class="form-control input2" value="'+( parseInt(j) + 1 )+'" readonly /></td>';
				html2 += '<td><input type="text" id="Cod_Act_'+j+'" name="Cod_Act[]" maxlength="2" class="actvd form-control input2" /><div class="help-block has-error"></div> </td>';
				html2 += '<td><input type="text" id="Name_Act_'+j+'" name="Name_Act[]" readonly class="form-control input200" /><div class="help-block has-error"></div> </td>';
				html2 += '<td><input type="text" id="Subtotal_Act_'+j+'" name="Subtotal_Act[]" class="form-control input8" readonly /><div class="help-block has-error"></div> </td>';
				html2 += '<td><input type="text" id="Prct_Act_'+j+'" name="Prct_Act[]" class="form-control input8" readonly /></td>';
				for (var m = 0; m < mcs; m++) {
					html2 += '<td><input type="text" id="Monto_Act_'+m+'_'+j+'" name="Monto_Act[]" class="form-control input8 act_calculo_pptt" /><div class="help-block has-error"></div></td>';
				}
				html2 += '</tr>';
			}
			$('#pptt_actividades > tbody').append(html2);

			var cod_mes = '';
			var x = 0;
			$.each( <?php echo json_encode($proyect_actividad->result()) ?>, function(i, datos){

				if ( i < datos.Nro_Act )
				{
					$('#Nro_Act_'+i).val(datos.Nro_Act);
					$('#Cod_Act_'+i).val(datos.Cod_Act);
					buscar_actividades(datos.Cod_Act,i);
					cod_mes = datos.Mes;
				}
				x = ( cod_mes != datos.Mes ) ? ( x + 1 ) : x;
				$('#Monto_Act_'+x+'_'+(parseInt(datos.Nro_Act)-1)).val(datos.Monto_Act);
				cod_mes = datos.Mes;
			});
			$('.act_calculo_pptt').trigger('change');
			$('#Cod_Act_0').focus();
		}
	}

});

$(document).on("change",'.actvd',function() {
	var campo = $(this);
	var id = campo.attr('id');
	array=id.split("_");
	buscar_actividades(campo.val(),array[2]);// busca actividad por codigo
});

function buscar_actividades(codigo,posi){
	$.getJSON(CI.site_url+'/general/general/actividades', {codigo:codigo,ajax:1}, function(json_data, textStatus) {

		$('#Name_Act_'+posi).val('');
		$.each(json_data, function(i,datos){
			$('#Name_Act_'+posi).val( datos.Descripcion );
		});
	});
}

function calc_prct(posi,sufijo) {
	par1 = $('#Total_Gral').val();
	par2 = $('#Subtotal_'+sufijo+'_'+posi).val();
	monto = ( parseFloat(par2) / parseFloat(par1) ) * 100;
	$('#Prct_'+sufijo+'_'+posi).val(monto.toFixed(2));
}

$(document).on("change",'.act_calculo_pptt',function() {
	var campo = $(this);
	var cod = campo.attr('id');
	array=cod.split("_");

	suma_total_fila( 'Monto_Act_', '_'+array[3]+'','Subtotal_Act_'+array[3]+'' ); // calcula subtotal de la fila
	calc_prct( array[3], 'Act' ); // calcula porcentaje
	suma_total_details( 'Subtotal_Act_', 'total_actvd', $('#Nro_Actividades').val() ); // suma el total de todas las actividades
	suma_total_details( 'Monto_Act_'+array[2]+'_', 'act_total_mes_'+array[2]+'', $('#Nro_Actividades').val() ); // suma el total de todas las actividades
});

function suma_total_fila(part1,part2,view) {
	monto = 0;
	nrofilas = $('#Cantidad_Mes').val();
	for (var i = 0; i < nrofilas; i++) {
		valor = $('#'+part1+i+part2).val();
		valor = ( valor.trim() != '' ) ? valor : 0;
		monto = parseFloat(monto) + parseFloat(valor);
	}
	$('#'+view).val(monto);
}

function suma_total_details(param,view,nrofilas) {
	monto = 0;
	for (var i = 0; i < nrofilas; i++) {
		valor = $('#'+param+i).val();
		valor = ( valor.trim() != '' ) ? valor : 0;
		monto = parseFloat(monto) + parseFloat(valor);
	}
	$('#'+view).val(monto);
}



////////////////////////////////////////////////
////// PARTIDAS  
////////////////////////////////////////////////
$('#Nro_Partidas').change(function(event){

	mcs = $('#Cantidad_Mes').val();
	
	$('.part_meses').remove();
	if (mcs > 0){
		html = '';
		for (var i = 0; i < mcs; i++) {
			html += '<th class = "part_meses"><input type="text" id="part_nombre_mes_'+i+'" name="part_nombre_mes_'+i+'" class="form-control input13" value="'+$('#name_mcs_'+i).val()+'" readonly />';
			html += '<input type="text" id="part_total_mes_'+i+'" class="form-control input8" name="part_total_mes_[]" readonly /><div class="help-block has-error"></div> </th>';
		}
		$('.prct_part').after(html);

		part = $(this).val();
		$('#pptt_partidas > tbody > tr').remove();
		if (part > 0){
			html2 = '';
			for (var j = 0; j < part; j++) {
				html2 += '<tr>';
				html2 += '<td><input type="text" id="Nro_Gasto_'+j+'" name="Nro_Gasto[]" class="form-control input2" value="'+( parseInt(j) + 1 )+'" readonly /></td>';
				html2 += '<td><input type="text" id="Cod_Gasto_'+j+'" name="Cod_Gasto[]" maxlength="11" class="prtda form-control input13" /><div class="help-block has-error"></div> </td>';	
				html2 += '<td><input type="text" id="Name_Part_'+j+'" name="Name_Part[]" class="form-control" readonly /><div class="help-block has-error"></div> </td>';
				html2 += '<td><input type="text" id="Subtotal_Gasto_'+j+'" name="Subtotal_Gasto[]" class="form-control input8" readonly /><div class="help-block has-error"></div></td>';
				html2 += '<td><input type="text" id="Prct_Gasto_'+j+'" name="Prct_Gasto[]" class="form-control input8" readonly /></td>';
				for (var m = 0; m < mcs; m++) {
					html2 += '<td><input type="text" id="Monto_Gasto_'+m+'_'+j+'" name="Monto_Gasto[]" class="form-control input8 part_calculo_pptt" /><div class="help-block has-error"></div></td>';
				}
				html2 += '</tr>';
			}
			$('#pptt_partidas > tbody').append(html2);

			var cod_mes = '';
			var x = 0;
			$.each( <?php echo json_encode($proyect_gasto->result()) ?>, function(i, datos){

				if ( i < datos.Nro_Gasto )
				{
					$('#Nro_Gasto_'+i).val(datos.Nro_Gasto);
					$('#Cod_Gasto_'+i).val(datos.Cod_Gasto);
					buscar_partidas(datos.Cod_Gasto,i);
					cod_mes = datos.Mes;
				}
				x = ( cod_mes != datos.Mes ) ? ( x + 1 ) : x;
				$('#Monto_Gasto_'+x+'_'+(parseInt(datos.Nro_Gasto)-1)).val(datos.Monto_Gasto);
				cod_mes = datos.Mes;
			});
			$('.part_calculo_pptt').trigger('change');
			$('#Cod_Gasto_0').focus();
		}
	}

});

$(document).on("change",'.prtda',function() {
	var campo = $(this);
	var id = campo.attr('id');
	array=id.split("_");
	buscar_partidas(campo.val(),array[2]);// busca actividad por codigo
});

function buscar_partidas(codigo,posi){
	$.getJSON(CI.site_url+'/general/general/partidas', {codigo:codigo,ajax:1}, function(json_data, textStatus) {

		$('#Name_Part_'+posi).val('');
		$.each(json_data, function(i,datos){
			$('#Name_Part_'+posi).val(datos.Gasto);
		});
	});
}

$(document).on("change",'.part_calculo_pptt',function() {
	var campo = $(this);
	var cod = campo.attr('id');
	array=cod.split("_");

	suma_total_fila( 'Monto_Gasto_', '_'+array[3]+'','Subtotal_Gasto_'+array[3]+'' ); // calcula subtotal de la fila
	calc_prct( array[3], 'Gasto' ); // calcula porcentaje
	suma_total_details( 'Subtotal_Gasto_', 'total_part', $('#Nro_Partidas').val() ); // suma el total de todas las partidas
	suma_total_details( 'Monto_Gasto_'+array[2]+'_', 'part_total_mes_'+array[2]+'', $('#Nro_Partidas').val() ); // suma el total de todas las partidas
});


////////////////////////////////////////////////
////// FORM PPTT GENERAL
////////////////////////////////////////////////
$("#pptt_gnrl_frm").validate({
	rules: {
		Subtotal: {
			required:true,
			number:true,
		},
		IGV: {
			required:true,
			number:true,
		},
		Cantidad_Mes: {
			required:true,
			number:true,
		},
		total_mcs: {
			EqualsUno:['Total_Gral'],
		},
		'Mes[]':{
			required:true,
			number:true,
			range:[1,12],
		},
		'name_mcs_[]':{
			required:true,
		},
		'Subtotal_M[]':{
			required:true,
			number:true,
		},
		'IGV_M[]':{
			required:true,
			number:true,
		},
		Nro_Actividades: {
			required:true,
			number:true,
		},
		total_actvd: {
			EqualsUno:['Total_Gral'],
		},
		'Cod_Act[]':{
			required:true,
			number:true,
		},
		'Name_Act[]':{
			required:true,
		},
		'Subtotal_Act[]': {
			required:true,
			number:true,
		},
		'Monto_Act[]': {
			required:true,
			number:true,
		},
		'act_total_mes_[]': {
			required:true,
			number:true,
			EqualsDos:['Total_Gral_M_'],
		},
		Nro_Partidas: {
			required:true,
			number:true,
		},
		total_part: {
			EqualsUno:['Total_Gral'],
		},
		'Cod_Gasto[]': {
			required:true,
			rangelength:[8,11],
		},
		'Name_Part[]': {
			required:true,
		},
		'Subtotal_Gasto[]': {
			required:true,
			number:true,
		},
		'part_total_mes_[]': {
			required:true,
			number:true,
			EqualsDos:['Total_Gral_M_'],
		},
		'Monto_Gasto[]': {
			required:true,
			number:true,
			// EqualsTres:['part_subtotal_','Cantidad_Mes'],
		},
	},

	messages: {
		//FIN MESSAGES
	},
	errorPlacement: function(error, element) {
		$(element).next().after(error);
	},
	invalidHandler: function(form, validator) {
		var errors = validator.numberOfInvalids();
		if (errors) {
			var message = errors == 1
			? 'Por favor corrige estos errores:\n'
			: 'Por favor corrige los ' + errors + ' errores.\n';
			var errors = "";
			if (validator.errorList.length > 0) {
				for (x=0;x<validator.errorList.length;x++) {
					errors += "\n\u25CF " + validator.errorList[x].message;
				}
			}
			alert(message + errors);
		}
		validator.focusInvalid();
	},
	submitHandler: function(form) {

		var pptt_gnrl_data = $("#pptt_gnrl_frm").serializeArray();
		pptt_gnrl_data.push(
			{name: 'ajax',value:1},
			{name: 'codigo_proyecto',value: $("input[name='cod_pryct']").val()},
			{name: 'id_area',value:1}
		);

		var bgnrl = $( "#pptt_gnrl_frm :submit" );
		bgnrl.attr("disabled", "disabled");
		$.ajax({
			url: CI.site_url + "/presupuesto/presupuesto/datos_generales",
			type:'POST',
			cache:false,
			data:pptt_gnrl_data,
			dataType:'json',
			success:function(json){
				alert(json.msg);
				bgnrl.removeAttr('disabled');
			}
		});
	}
});

</script>