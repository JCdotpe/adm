<?php 

////////////////////////////////////
////// DATOS GENERALES /////////////
////////////////////////////////////

$Sub_Total = array(
	'name'	=> 'Sub_Total',
	'id'	=> 'Sub_Total',
	'class'	=> 'form-control input8',
);

$IGV = array(
	'name'	=> 'IGV',
	'id'	=> 'IGV',
	'class'	=> 'form-control input8',
);

$Total_General = array(
	'name'	=> 'Total_General',
	'id'	=> 'Total_General',
	'readonly' => 'true',
	'class'	=> 'form-control input8',
);

$Nro_Meses = array(
	'name'	=> 'Nro_Meses',
	'id'	=> 'Nro_Meses',
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


$attr = array('id' => 'pptt_gnrl_frm');

echo form_open($this->uri->uri_string(),$attr);

?>

<div>
	
	<h2>Presupuesto General</h2>

	<div class="row"><div class="form-inline" role="form">

		<div class="col-xs-3">

			<div class="form-group">
				<label>Total General</label>
				<?php echo form_input($Total_General); ?>
			</div>

		</div>

		<div class="col-xs-3">

			<div class="form-group">
				<label>Subtotal</label>
				<?php echo form_input($Sub_Total); ?>
			</div>

		</div>

		<div class="col-xs-3">

			<div class="form-group">
				<label>IGV</label>
				<?php echo form_input($IGV); ?>
			</div>

		</div>

		<div class="col-xs-3">

			<div class="form-group">
				<label>Cantidad de Meses</label>
				<?php echo form_input($Nro_Meses); ?>
			</div>	

		</div>						

	</div></div><!-- end row -->

	

		





	
	 

	

	<hr />

	<div class="form-inline" role="form">

	<h2>Presupuesto Mensual</h2> <input id="total_mcs" class="form-control input8" name="total_mcs" type="text" readonly />

	

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

	<h2>Cantidad de Actividades</h2> <?php echo form_input($Nro_Actividades); ?>

	<table id="pptt_actividades" class="table table-striped table-hover">
		<thead>
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

	<h2>Cantidad de Partidas</h2> <?php echo form_input($Nro_Partidas); ?>

	<table id="pptt_partidas" class="table table-striped table-hover">
		<thead>
			<th>COD.</th>
			<th>PARTIDA</th>
			<th>SUBTOTAL <input type="text" id="total_part" class="form-control input2" name="total_part" readonly /><div class="help-block has-error"></div> </th>
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
?>

<script type="text/javascript">

$('#Sub_Total').change(function(event) {
	calc_totgnrl($(this).val(),$('#IGV').val(),'Total_General');// sumatoria del subtotal e igv
	$('.calculo_prct_details').trigger('change');// recalcula el porcentaje de las filas en las tablas detalles
});

$('#IGV').change(function(event) {
	calc_totgnrl($('#Sub_Total').val(),$(this).val(),'Total_General');// sumatoria del subtotal e igv
	$('.calculo_prct_details').trigger('change');// recalcula el porcentaje de las filas en las tablas detalles
});

function calc_totgnrl(par1, par2, view){
	par1 = (par1.trim() != '') ? par1 : 0;
	par2 = (par2.trim() != '') ? par2 : 0;
	monto = parseFloat(par1) + parseFloat(par2);
	$('#'+view).val(monto);
}

$('#Nro_Meses').change(function(event) {
	nro = $(this).val();
	$('#pptt_meses > tbody > tr').remove();

	if (nro > 0){
		html = '';
		for (var i = 0; i < nro; i++){ 
			html += '<tr>';
			html += '<td><input type="text" id="cod_mcs_'+i+'" name="cod_mcs_'+i+'" maxlength="2" class="form-control input2 meses" /></td>';
			html += '<td><input type="text" id="name_mcs_'+i+'" name="name_mcs_'+i+'" class="form-control input13" readonly /></td>';
			html += '<td><input type="text" id="subtotal_mcs_'+i+'" name="subtotal_mcs_'+i+'" class="form-control input8 calculo_mcs" /></td>';
			html += '<td><input type="text" id="igv_mcs_'+i+'" name="igv_mcs_'+i+'" class="form-control input8 calculo_mcs" /></td>';
			html += '<td><input type="text" id="totgnrl_mcs_'+i+'" name="totgnrl_mcs_[]" class="form-control input8" readonly /></td>';
			html += '</tr>';
		}
		$('#pptt_meses > tbody').append(html);
	}
	$('#Nro_Actividades').trigger('change');
	$('#Nro_Partidas').trigger('change');
	$('#cod_mcs_0').focus();
});

$(document).on("change",'.calculo_mcs',function() {
	var campo = $(this);
	var cod = campo.attr('id');
	array=cod.split("_");
	calc_totgnrl( $('#subtotal_mcs_'+array[2]).val(), $('#igv_mcs_'+array[2]).val(), "totgnrl_mcs_"+array[2]+"" ); // sumatoria del subtotal e igv
	suma_total_meses(); // suma el total de todos los meses
});

function suma_total_meses() {
	monto = 0;
	mcs = $('#Nro_Meses').val();
	for (var i = 0; i < mcs; i++) {
		valor = $('#totgnrl_mcs_'+i).val();
		valor = ( valor.trim() != '' ) ? valor : 0;
		monto = parseFloat(monto) + parseFloat(valor);
	}
	$('#total_mcs').val(monto);
}

$(document).on("change",'.meses',function() {
	var campo = $(this);
	var id = campo.attr('id');
	array=id.split("_");
	buscar_meses(campo.val(),array[2]);// consulta mes por codigo
});

function buscar_meses(codigo,posi){
	$.getJSON('<?php echo site_url(); ?>/general/general/meses', {codigo:codigo,ajax:1}, function(json_data, textStatus) {

		$('#name_mcs_'+posi).val('');
		$('#act_nombre_mes_'+posi).val('');
		$('#part_nombre_mes_'+posi).val('');
		$.each(json_data, function(i,datos){
			$('#name_mcs_'+posi).val(datos.nombre_mes);
			$('#act_nombre_mes_'+posi).val(datos.nombre_mes);
			$('#part_nombre_mes_'+posi).val(datos.nombre_mes);
		});
	});
}


////////////////////////////////////////////////
////// ACTIVIDADES
////////////////////////////////////////////////
$('#Nro_Actividades').change(function(event){

	mcs = $('#Nro_Meses').val();
	
	$('.act_meses').remove();
	
	if (mcs > 0){
		html = '';
		for (var i = 0; i < mcs; i++) {
			html += '<th class = "act_meses"><input type="text" id="act_nombre_mes_'+i+'" class="form-control input13" name="act_nombre_mes_'+i+'" value="'+$('#name_mcs_'+i).val()+'" readonly />';
			html += '<input type="text" id="act_total_mes_'+i+'" class="form-control input8" name="act_total_mes_[]" readonly /><div class="help-block has-error"></div></th>';
		}
		$('.prct_act').after(html);

		act = $(this).val();
		$('#pptt_actividades > tbody > tr').remove();
		if (act > 0){
			html2 = '';
			for (var j = 0; j < act; j++) {
				html2 += '<tr>';
				html2 += '<td><input type="text" id="act_cod_'+j+'" name="act_cod_'+j+'" maxlength="2" class="actvd form-control input2" /></td>';
				html2 += '<td><input type="text" id="act_name_'+j+'" name="act_name_'+j+'" readonly class="form-control input200" /></td>';
				html2 += '<td><input type="text" id="act_subtotal_'+j+'" name="act_subtotal_[]" class="form-control input8 calculo_prct_details act_calculo_pptt" /><div class="help-block has-error"></div></td>';
				html2 += '<td><input type="text" id="act_prct_'+j+'" name="act_prct_'+j+'" class="form-control input8" readonly /></td>';
				for (var m = 0; m < mcs; m++) {
					html2 += '<td><input type="text" id="act_pptt_mes_'+m+'_'+j+'" name="act_pptt_mes_[]" class="form-control input8 act_calculo_pptt" /><div class="help-block has-error"></div></td>';
				}
				html2 += '</tr>';
			}
			$('#pptt_actividades > tbody').append(html2);
			$('#act_cod_0').focus();
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
	$.getJSON('<?php echo site_url(); ?>/general/general/actividades', {codigo:codigo,ajax:1}, function(json_data, textStatus) {

		$('#act_name_'+posi).val('');
		$.each(json_data, function(i,datos){
			$('#act_name_'+posi).val(datos.nombre_actividad);
		});
	});
}

$(document).on("change",'.calculo_prct_details',function() {
	var campo = $(this);
	var cod = campo.attr('id');
	array=cod.split("_");
	calc_prct( array[2], ""+array[0]+"" ,"_prct_" ); // calcula porcentaje
});

function calc_prct(posi,prefijo,view) {
	par1 = $('#Total_General').val();
	par2 = $('#'+prefijo+'_subtotal_'+posi).val();
	monto = ( parseFloat(par2) / parseFloat(par1) ) * 100;
	$('#'+prefijo+view+posi).val(monto.toFixed(2));
}

$(document).on("change",'.act_calculo_pptt',function() {
	var campo = $(this);
	var cod = campo.attr('id');
	array=cod.split("_");
	if ( array[2] != 'mes' )
	{
		suma_total_details( "act_subtotal_", "total_actvd", $('#Nro_Actividades').val() ); // suma el total de todas las actividades
	}else{
		suma_total_details( "act_pptt_mes_"+array[3]+"_", "act_total_mes_"+array[3]+"", $('#Nro_Actividades').val() ); // suma el total de todas las actividades
	}
	
});

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

	mcs = $('#Nro_Meses').val();
	
	$('.part_meses').remove();
	if (mcs > 0){
		html = '';
		for (var i = 0; i < mcs; i++) {
			html += '<th class = "part_meses"><input type="text" id="part_nombre_mes_'+i+'" name="part_nombre_mes_'+i+'" class="form-control input13" value="'+$('#name_mcs_'+i).val()+'" readonly />';
			html += '<input type="text" id="part_total_mes_'+i+'" class="form-control input8" name="part_total_mes_[]" readonly /><div class="help-block has-error"></div></th>';
		}
		$('.prct_part').after(html);

		part = $(this).val();
		$('#pptt_partidas > tbody > tr').remove();
		if (part > 0){
			html2 = '';
			for (var j = 0; j < part; j++) {
				html2 += '<tr>';
				html2 += '<td><input type="text" id="part_cod_'+j+'" name="part_cod_'+j+'"  class="prtda form-control input2" /></td>';
				html2 += '<td><input type="text" id="part_name_'+j+'" name="part_name_'+j+'" class="form-control input13" readonly /></td>';
				html2 += '<td><input type="text" id="part_subtotal_'+j+'" name="part_subtotal_[]" class="form-control input8 calculo_prct_details part_calculo_pptt" /><div class="help-block has-error"></div></td>';
				html2 += '<td><input type="text" id="part_prct_'+j+'" name="part_prct_'+j+'" class="form-control input8" readonly /></td>';
				for (var m = 0; m < mcs; m++) {
					html2 += '<td><input type="text" id="part_pptt_mes_'+m+'_'+j+'" name="part_pptt_mes_[]" class="form-control input8 part_calculo_pptt" /><div class="help-block has-error"></div></td>';
				}
				html2 += '</tr>';
			}
			$('#pptt_partidas > tbody').append(html2);
			$('#part_cod_0').focus();
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
	$.getJSON('<?php echo site_url(); ?>/general/general/partidas', {codigo:codigo,ajax:1}, function(json_data, textStatus) {

		$('#part_name_'+posi).val('');
		$.each(json_data, function(i,datos){
			$('#part_name_'+posi).val(datos.nombre_partida);
		});
	});
}

$(document).on("change",'.part_calculo_pptt',function() {
	var campo = $(this);
	var cod = campo.attr('id');
	array=cod.split("_");
	if ( array[2] != 'mes' )
	{
		suma_total_details( "part_subtotal_", "total_part", $('#Nro_Partidas').val() ); // suma el total de todas las partidas
	}else{
		suma_total_details( "part_pptt_mes_"+array[3]+"_", "part_total_mes_"+array[3]+"", $('#Nro_Partidas').val() ); // suma el total de todas las partidas
	}
	
});


////////////////////////////////////////////////
////// FORM  
////////////////////////////////////////////////
$("#pptt_gnrl_frm").validate({
	rules: {
		total_mcs: {
			required:true,
			EqualsUno:['Total_General'],
		},
		total_actvd: {
			required:true,
			EqualsUno:['Total_General'],
		},
		total_part: {
			required:true,
			EqualsUno:['Total_General'],
		},
		'act_total_mes_[]': {
			required:true,
			EqualsDos:['totgnrl_mcs_'],
		},
		'act_subtotal_[]': {
			required:true,
		},
		'act_pptt_mes_[]': {
			required:true,
			EqualsTres:['act_subtotal_','Nro_Meses'],
		},
		'part_total_mes_[]': {
			required:true,
			EqualsDos:['totgnrl_mcs_'],
		},
		'part_subtotal_[]': {
			required:true,
		},
		'part_pptt_mes_[]': {
			required:true,
			EqualsTres:['part_subtotal_','Nro_Meses'],
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

		// var cap1_cm_data = $("#cap1_cm").serializeArray();
		// cap1_cm_data.push(
		// 	{name: 'ajax',value:1},
		// 	{name: 'id_local',value:$("input[name='id_local']").val()},
		// 	{name: 'Nro_Pred',value:$("input[name='Nro_Pred']").val()},
		// 	{name: 'user_id',value:$("input[name='user_id']").val()},
		// 	{name: 'P1_A_2_NroIE',value:$("#P1_A_2_NroIE").val()}
		// );

		// var bcar = $( "#cap1_cm :submit" );
		// bcar.attr("disabled", "disabled");
		// $.ajax({
		// 	url: CI.site_url + "/consistencia/cap1/cm",
		// 	type:'POST',
		// 	cache:false,
		// 	data:cap1_cm_data,
		// 	dataType:'json',
		// 	success:function(json){
		// 		alert(json.msg);
		// 		bcar.removeAttr('disabled');
		// 		btncmod(json.nrocms);
		// 		var rec = parseInt($('#P1_A_2_NroIE').val())+1;
		// 		if( rec > parseInt($('#P1_A_1_Cant_IE').val()) ){
		// 			$('#P1_B_1_TPred').focus();
		// 		}else{
		// 			$( "#gies .ienro:nth-child(" + rec + ")" ).trigger('click');
		// 			$('#P1_A_2_1_NomIE').focus();
		// 		}
		// 		// gen_cms(json.nro_cms,json.cms);
		// 	}
		// });
	}
});

</script>