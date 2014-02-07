<?php 

////////////////////////////////////
////// DATOS GENERALES /////////////
////////////////////////////////////

$Sub_Total = array(
	'name'	=> 'Sub_Total',
	'id'	=> 'Sub_Total',
);

$IGV = array(
	'name'	=> 'IGV',
	'id'	=> 'IGV',
);

$Total_General = array(
	'name'	=> 'Total_General',
	'id'	=> 'Total_General',
	'readonly' => 'true',
);

$Nro_Meses = array(
	'name'	=> 'Nro_Meses',
	'id'	=> 'Nro_Meses',
	'maxlength'	=> 2,
);

$Nro_Actividades = array(
	'name'	=> 'Nro_Actividades',
	'id'	=> 'Nro_Actividades',
	'maxlength'	=> 2,
);

$Nro_Partidas = array(
	'name'	=> 'Nro_Partidas',
	'id'	=> 'Nro_Partidas',
	'maxlength'	=> 2,
);

$attr = array('id' => 'dtgeneral_form');

echo form_open($this->uri->uri_string(),$attr);

?>

<div>
	
	Subtotal <?php echo form_input($Sub_Total); ?>
	IGV <?php echo form_input($IGV); ?>
	Total General <?php echo form_input($Total_General); ?>
	Cantidad de Meses <?php echo form_input($Nro_Meses); ?>
	<table id="pptt_meses" border="1">
		<thead>
			<th>Código</th>
			<th>Nombre Meses</th>
			<th>SubTotal</th>
			<th>IGV</th>
			<th>Total  <input type="text" id="total_mcs" name="total_mcs" readonly /> </th>
		</thead>
		<tbody>
		</tbody>
	</table>

	Cantidad de Actividades <?php echo form_input($Nro_Actividades); ?>
	<table id="pptt_actividades" border="1">
		<thead>
			<th>Código</th>
			<th>Nombre Actividad</th>
			<th>SubTotal <input type="text" id="total_actvd" name="total_actvd" readonly /> </th>
			<th class='prct_act'>%</th>
		</thead>
		<tbody>
		</tbody>
	</table>

	Cantidad de Partidas <?php echo form_input($Nro_Partidas); ?>
	<table id="pptt_partidas" border="1">
		<thead>
			<th>Código</th>
			<th>Nombre Partida</th>
			<th>SubTotal</th>
			<th class='prct_part'>%</th>
		</thead>
		<tbody>
		</tbody>
	</table>

</div>

<?php 
echo form_close();
?>

<script type="text/javascript">

$('#Sub_Total').change(function(event) {
	calc_totgnrl($(this).val(),$('#IGV').val(),'Total_General');// sumatoria del subtotal e igv
});

$('#IGV').change(function(event) {
	calc_totgnrl($('#Sub_Total').val(),$(this).val(),'Total_General');// sumatoria del subtotal e igv
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
			html += '<td><input type="text" id="cod_mcs_'+i+'" name="cod_mcs_'+i+'" maxlength="2" class="meses" /></td>';
			html += '<td><input type="text" id="name_mcs_'+i+'" name="name_mcs_'+i+'" readonly /></td>';
			html += '<td><input type="text" id="subtotal_mcs_'+i+'" name="subtotal_mcs_'+i+'" class="calculo_mcs" /></td>';
			html += '<td><input type="text" id="igv_mcs_'+i+'" name="igv_mcs_'+i+'" class="calculo_mcs" /></td>';
			html += '<td><input type="text" id="totgnrl_mcs_'+i+'" name="totgnrl_mcs_'+i+'" readonly /></td>';
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
		$('#nombre_mes_'+posi).val('');
		$.each(json_data, function(i,datos){
			$('#name_mcs_'+posi).val(datos.nombre_mes);
			$('#nombre_mes_'+posi).val(datos.nombre_mes);
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
			html += '<th class = "act_meses"><input type="text" id="nombre_mes_'+i+'" name="nombre_mes_'+i+'" value="'+$('#name_mcs_'+i).val()+'" readonly />';
			html += '<input type="text" id="total_mes_'+i+'" name="total_mes_'+i+'" readonly /></th>';
		}
		$('.prct_act').after(html);

		act = $(this).val();
		$('#pptt_actividades > tbody > tr').remove();
		if (act > 0){
			html2 = '';
			for (var j = 0; j < act; j++) {
				html2 += '<tr>';
				html2 += '<td><input type="text" id="cod_act_'+j+'" name="cod_act_'+j+'" maxlength="2" class="actvd" /></td>';
				html2 += '<td><input type="text" id="name_act_'+j+'" name="name_act_'+j+'" readonly /></td>';
				html2 += '<td><input type="text" id="subtotal_act_'+j+'" name="subtotal_act_'+j+'" class="calculo_act calculo_pptt_act" /></td>';
				html2 += '<td><input type="text" id="prct_act_'+j+'" name="prct_act_'+j+'" readonly /></td>';
				for (var m = 0; m < mcs; m++) {
					html2 += '<td><input type="text" id="pptt_mes_'+m+'_'+j+'" name="pptt_mes_'+m+'_'+j+'" class="calculo_pptt_act" /></td>';
				}
				html2 += '</tr>';
			}
			$('#pptt_actividades > tbody').append(html2);
			$('#cod_act_0').focus();
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

		$('#name_act_'+posi).val('');
		$.each(json_data, function(i,datos){
			$('#name_act_'+posi).val(datos.nombre_actividad);
		});
	});
}

$(document).on("change",'.calculo_act',function() {
	var campo = $(this);
	var cod = campo.attr('id');
	array=cod.split("_");
	calc_prct( array[2], "prct_act_" ); // calcula porcentaje
});

function calc_prct(posi,view) {
	par1 = $('#Total_General').val();
	par2 = $('#subtotal_act_'+posi).val();
	monto = ( parseFloat(par2) / parseFloat(par1) ) * 100;
	$('#'+view+posi).val(monto.toFixed(2));
}

$(document).on("change",'.calculo_pptt_act',function() {
	var campo = $(this);
	var cod = campo.attr('id');
	array=cod.split("_");
	if ( array[1] != 'mes' )
	{
		suma_total_actividades( "subtotal_act_", "total_actvd" ); // suma el total de todas las actividades
	}else{
		suma_total_actividades( "pptt_mes_"+array[2]+"_", "total_mes_"+array[2]+"" ); // suma el total de todas las actividades
	}
	
});

function suma_total_actividades(param,view) {
	monto = 0;
	act = $('#Nro_Actividades').val();
	for (var i = 0; i < act; i++) {
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
			html += '<th class = "part_meses" >'+i+'</th>';
		}
		$('.prct_part').after(html);

		part = $(this).val();
		$('#pptt_partidas > tbody > tr').remove();
		if (part > 0){
			html2 = '';
			for (var j = 0; j < part; j++) {
				html2 += '<tr>';
				html2 += '<td>'+j+'</td>';
				html2 += '<td>ALIMENTOS PARA PERSONAS</td>';
				html2 += '<td>4350</td>';
				html2 += '<td>0.62</td>';
				for (var m = 0; m < mcs; m++) {
					html2 += '<td>'+m+'</td>';
				}
				html2 += '</tr>';
			}
			$('#pptt_partidas > tbody').append(html2);
		}
	}

});

</script>