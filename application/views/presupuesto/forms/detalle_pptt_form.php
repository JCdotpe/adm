<?php 

////////////////////////////////////
////// DETALLE PRESUPUESTO /////////
////////////////////////////////////

$Cod_Act = array(
	'name'	=> 'Cod_Act',
	'id'	=> 'Cod_Act',
	'class' => 'form-control input2',
	'maxlength' => 2,
);

$Name_Act = array(
	'name'	=> 'Name_Act',
	'id'	=> 'Name_Act',
	'class' => 'form-control input200',
	'readonly' => 'true',
);

$Subtotal_Act = array(
	'name'	=> 'Subtotal_Act',
	'id'	=> 'Subtotal_Act',
	'class'	=> 'form-control input8',
	'readonly' => 'true',
);

$Cntdad_Partidas = array(
	'name'	=> 'Cntdad_Partidas',
	'id'	=> 'Cntdad_Partidas',
	'class' => 'form-control input2',
	'maxlength' => 2,
);

$attr = array('id' => 'pptt_gnrl_dtail_frm','accept-charset' => 'UTF-8');
echo form_open($this->uri->uri_string(),$attr);

?>

<div id="cabecera" class="form-inline" role="form">
	Actividades <br>
	<?php echo form_hidden('Nro_Act'); ?>
	Cod. <?php echo form_input($Cod_Act); ?><div class="help-block has-error"></div> Actividad <?php echo form_input($Name_Act); ?><div class="help-block has-error"></div> Total <?php echo form_input($Subtotal_Act); ?>
	Cantidad de Partidas <?php echo form_input($Cntdad_Partidas); ?><div class="help-block has-error"></div>
</div>
<br>

<div id="maestro">
	<!-- <div  class="form-inline" role="form">
		Partida <br>
		Cod. <input id="Cod_Gasto_0" class="form-control input13" type="text" maxlength="11" name="Cod_Gasto[]">
		Partida <input id="Name_Part_" class="form-control" type="text" readonly="true" name="Name_Part[]">
		Nro Items <input id="Nro_Items_" class="form-control input2" type="text" maxlength="2" name="Nro_Items[]">
		<table class="table table-striped table-hover">
			<thead>
				<th>Item</th>
				<th>Unidad Medida</th>
				<th>Cantidad</th>
				<th>Precio Unitario</th>
				<th>Veces o Tiempo en Meses</th>
				<th>SubTotal</th>
				<th>Mes1</th>
				<th>Mes2</th>
				<th>Mes3</th>
			</thead>
			<tbody>
				<tr>
					<td><input id="Name_Item_" class="form-control" type="text" name="Name_Item[]"></td>
					<td><input id="U_Medida_" class="form-control input13" type="text" name="U_Medida[]"></td>
					<td><input id="Cantidad_Item_" class="form-control input13" type="text" name="Cantidad_Item[]"></td>
					<td><input id="Precio_Item_" class="form-control input13" type="text" name="Precio_Item[]"></td>
					<td><input id="Tiempo_Item_" class="form-control input2" type="text" name="Tiempo_Item[]"></td>
					<td><input id="SubTotal_Item_" class="form-control input8" type="text" readonly="true" name="SubTotal_Item[]"></td>
					<td><input id="Monto_Mes1_Item_" class="form-control input8" type="text" name="Monto_Mes1_Item[]"></td>
					<td><input id="Monto_Mes2_Item_" class="form-control input8" type="text" name="Monto_Mes2_Item[]"></td>
					<td><input id="Monto_Mes3_Item_" class="form-control input8" type="text" name="Monto_Mes3_Item[]"></th>
				</tr>
				<tr>
					<td><input id="Name_Item_" class="form-control" type="text" name="Name_Item[]"></td>
					<td><input id="U_Medida_" class="form-control input13" type="text" name="U_Medida[]"></td>
					<td><input id="Cantidad_Item_" class="form-control input13" type="text" name="Cantidad_Item[]"></td>
					<td><input id="Precio_Item_" class="form-control input13" type="text" name="Precio_Item[]"></td>
					<td><input id="Tiempo_Item_" class="form-control input2" type="text" name="Tiempo_Item[]"></td>
					<td><input id="SubTotal_Item_" class="form-control input8" type="text" readonly="true" name="SubTotal_Item[]"></td>
					<td><input id="Monto_Mes1_Item_" class="form-control input8" type="text" name="Monto_Mes1_Item[]"></td>
					<td><input id="Monto_Mes2_Item_" class="form-control input8" type="text" name="Monto_Mes2_Item[]"></td>
					<td><input id="Monto_Mes3_Item_" class="form-control input8" type="text" name="Monto_Mes3_Item[]"></th>
				</tr>
			</tbody>
		</table>
	</div>
	<hr>
	<div  class="form-inline" role="form">
		Partida <br>
		Cod. <input id="Cod_Gasto_0" class="form-control input13" type="text" maxlength="11" name="Cod_Gasto[]">
		Partida <input id="Name_Part_" class="form-control" type="text" readonly="true" name="Name_Part[]">
		Nro Items <input id="Nro_Items_" class="form-control input2" type="text" maxlength="2" name="Nro_Items[]">
		<table class="table table-striped table-hover">
			<thead>
				<th>Item</th>
				<th>Unidad Medida</th>
				<th>Cantidad</th>
				<th>Precio Unitario</th>
				<th>Veces o Tiempo en Meses</th>
				<th>SubTotal</th>
				<th>Mes1</th>
				<th>Mes2</th>
				<th>Mes3</th>
			</thead>
			<tbody>
				<tr>
					<td><input id="Name_Item_" class="form-control" type="text" name="Name_Item[]"></td>
					<td><input id="U_Medida_" class="form-control input13" type="text" name="U_Medida[]"></td>
					<td><input id="Cantidad_Item_" class="form-control input13" type="text" name="Cantidad_Item[]"></td>
					<td><input id="Precio_Item_" class="form-control input13" type="text" name="Precio_Item[]"></td>
					<td><input id="Tiempo_Item_" class="form-control input2" type="text" name="Tiempo_Item[]"></td>
					<td><input id="SubTotal_Item_" class="form-control input8" type="text" readonly="true" name="SubTotal_Item[]"></td>
					<td><input id="Monto_Mes1_Item_" class="form-control input8" type="text" name="Monto_Mes1_Item[]"></td>
					<td><input id="Monto_Mes2_Item_" class="form-control input8" type="text" name="Monto_Mes2_Item[]"></td>
					<td><input id="Monto_Mes3_Item_" class="form-control input8" type="text" name="Monto_Mes3_Item[]"></th>
				</tr>
				<tr>
					<td><input id="Name_Item_" class="form-control" type="text" name="Name_Item[]"></td>
					<td><input id="U_Medida_" class="form-control input13" type="text" name="U_Medida[]"></td>
					<td><input id="Cantidad_Item_" class="form-control input13" type="text" name="Cantidad_Item[]"></td>
					<td><input id="Precio_Item_" class="form-control input13" type="text" name="Precio_Item[]"></td>
					<td><input id="Tiempo_Item_" class="form-control input2" type="text" name="Tiempo_Item[]"></td>
					<td><input id="SubTotal_Item_" class="form-control input8" type="text" readonly="true" name="SubTotal_Item[]"></td>
					<td><input id="Monto_Mes1_Item_" class="form-control input8" type="text" name="Monto_Mes1_Item[]"></td>
					<td><input id="Monto_Mes2_Item_" class="form-control input8" type="text" name="Monto_Mes2_Item[]"></td>
					<td><input id="Monto_Mes3_Item_" class="form-control input8" type="text" name="Monto_Mes3_Item[]"></th>
				</tr>
			</tbody>
		</table>
	</div> -->

</div>

<?php 
echo form_submit('enviar', 'Guardar','class="btn btn-primary"');
echo form_close();
?>
<script type="text/javascript">

////////////////////////////////////////////////
////// DETALLE DE PRESUPUESTO
////////////////////////////////////////////////
$(function(){
	$.each( <?php echo json_encode($presup_mes->result()) ?>, function(i, datos){
		html = '<input type="hidden" id="Mes_Dtail_'+i+'" name="Mes[]" value="'+datos.Mes+'">';
		$('#cabecera').append(html);
	});
});

$('#Cod_Act').change(function(event){

	codigo = $(this).val();
	proyct = $("input[name='cod_pryct']").val();

	$.getJSON(CI.site_url+'/general/general/actividad_pptt', {codigo:codigo,proyct:proyct,area:1,anio:2014,ajax:1}, function(json_data, textStatus) {

		$("input[name='Nro_Act']").val('');
		$('#Name_Act').val('');
		$('#Subtotal_Act').val('');
		$.each(json_data, function(i,datos){
			$("input[name='Nro_Act']").val( datos.Nro_Act );
			$('#Name_Act').val( datos.Descripcion );
			$('#Subtotal_Act').val( datos.Monto_Act );
		});
	});
	
});

////////////////////////////////////////////////
////// DETALLE DE ACTIVIDAD
////////////////////////////////////////////////
$('#Cntdad_Partidas').change(function(event){

	nro = $(this).val();
	
	$('.dv_items').remove();

	if ( nro > 0 )
	{
		html = '';
		for (var i = 0; i < nro; i++) {
			html += '<div id=dv_'+i+' class="form-inline dv_items" role="form">';
			html += 'Partida <br>';
			html += '<input type="hidden" id="Nro_Part_'+i+'" name="Nro_Gasto[]" />';
			html += 'Cod. <input id="Cod_Part_'+i+'" class="gasto form-control input13" type="text" maxlength="11" name="Cod_Gasto[]"> <div class="help-block has-error"></div>';
			html += 'Partida <input id="Nombre_Part_'+i+'" class="form-control" type="text" readonly="true" name="Nombre_Part[]"> <div class="help-block has-error"></div>';
			html += 'Total <input id="Subtotal_Part_'+i+'" class="form-control input8" type="text" readonly="true" name="Subtotal_Part[]">';
			html += 'Nro Items <input id="Nro_Items_'+i+'" class="form-control input2 items" type="text" maxlength="2" name="Nro_Items[]"> <div class="help-block has-error"></div>'
			html += '</div>';
		}

		$('#maestro').html(html);

		$('#Cod_Part_0').focus();
	}
});

$(document).on("change",'.items',function() {
	var campo = $(this);
	var cod = campo.attr('id');
	array = cod.split("_");

	nro = campo.val();
	mcs = $('#Cantidad_Mes').val();

	$('.tb_items_'+array[2]).remove();

	if (nro > 0)
	{
		html = '<table id="tb_'+array[2]+'" class="table table-striped table-hover tb_items_'+array[2]+'">';
		html += '<thead>';
		html += '<th>Nro.</th>';
		html += '<th>Item</th>';
		html += '<th>Unidad Medida</th>';
		html += '<th>Cantidad</th>';
		html += '<th>Precio Unitario</th>';
		html += '<th>Veces o Tiempo en Meses</th>';
		html += '<th>SubTotal</th>';

		for (var j = 0; j < mcs; j++) {
			html += '<th> <label id="lbl_Mes_'+array[2]+'_'+j+'"></label> </th>';
			cod_mes = $("input[id='Mes_Dtail_"+j+"']").val();
			nombre_mes( cod_mes, array[2], j );
		}
		html += '</thead>';
		html += '<tbody>';

		for (var i = 0; i < nro; i++) {
			html += '<tr>';
			html += '<td><input type="text" id="Item_'+i+'" name="Item[]" class="form-control input2" value="'+( parseInt(i) + 1 )+'" readonly /></td>';
			html += '<td><input id="Item_Descripcion_'+array[2]+'_'+i+'" class="form-control" type="text" name="Item_Descripcion[]"> <div class="help-block has-error"></div></td>';
			html += '<td><input id="Cod_UM_'+array[2]+'_'+i+'" class="form-control input3 medida" type="text" maxlength="2" name="Cod_UM[]"> <input id="Unidad_Med_'+array[2]+'_'+i+'" class="form-control input13" type="text" readonly="true" name="Unidad_Med[]"> <div class="help-block has-error"></div></td>';
			html += '<td><input id="Cantidad_'+array[2]+'_'+i+'" class="form-control input13 dsubtotal" type="text" maxlength="6" name="Cantidad[]"> <div class="help-block has-error"></div></td>';
			html += '<td><input id="PrecioUnit_'+array[2]+'_'+i+'" class="form-control input13 dsubtotal" type="text" name="Precio_Unit[]"> <div class="help-block has-error"></div></td>';
			html += '<td><input id="Tiempo_'+array[2]+'_'+i+'" class="form-control input2 dsubtotal" type="text" maxlength="2" name="Tiempo[]"> <div class="help-block has-error"></div></td>';
			html += '<td><input id="SubTotal_Item_'+array[2]+'_'+i+'" class="form-control input8" type="text" readonly="true" name="SubTotal_Item[]"></td>';

			for (var x = 0; x < mcs; x++) {
				html += '<td><input id="Monto_Mes_'+x+'_Item_'+array[2]+'_'+i+'" class="form-control input8" type="text" name="Monto_Mes_Item[]"> <div class="help-block has-error"></div></td>';
			};
			html += '</tr>';
		}
		html += '</tbody>';
		html += '</table>';

		$('#dv_'+array[2]).append(html);
		$('#Item_Descripcion_'+array[2]+'_0').focus();
	}
});

function nombre_mes(codigo,nro_tbl,posi){
	$.getJSON(CI.site_url+'/general/general/meses', {codigo:codigo,ajax:1}, function(json_data, textStatus) {
		
		$('#lbl_Mes_'+nro_tbl+'_'+posi).text('');
		$.each(json_data, function(i,datos){
			$('#lbl_Mes_'+nro_tbl+'_'+posi).text(datos.Nombre);
		});

	});
}


$(document).on("change",'.gasto',function() {

	var campo = $(this);
	var cod = campo.attr('id');
	array = cod.split("_");

	codigo = campo.val();
	proyct = $("input[name='cod_pryct']").val();
	
	$.getJSON(CI.site_url+'/general/general/gasto_pptt', {codigo:codigo,proyct:proyct,area:1,anio:2014,ajax:1}, function(json_data, textStatus) {

		$('#Nombre_Part_'+array[2]).val('');
		$("#Nro_Part_"+array[2]).val('');
		$.each(json_data, function(i,datos){
			$('#Nombre_Part_'+array[2]).val(datos.Descripcion);
			$("#Nro_Part_"+array[2]).val(datos.Nro_Gasto);
		});
	});
});

$(document).on("change",'.medida',function() {

	var campo = $(this);
	var cod = campo.attr('id');
	array = cod.split("_");

	codigo = campo.val();
	
	$.getJSON(CI.site_url+'/general/general/unidad_medida', {codigo:codigo,ajax:1}, function(json_data, textStatus) {

		$('#Unidad_Med_'+array[2]).val('');
		$.each(json_data, function(i,datos){
			$('#Unidad_Med_'+array[2]+'_'+array[3]).val(datos.Unidad_Med);
		});
	});

});


$(document).on("change",'.dsubtotal',function() {

	var campo = $(this);
	var cod = campo.attr('id');
	array = cod.split("_");

	parm1 = $('#Cantidad_'+array[1]+'_'+array[2]).val();
	parm2 = $('#PrecioUnit_'+array[1]+'_'+array[2]).val();
	parm3 = $('#Tiempo_'+array[1]+'_'+array[2]).val();

	parm1 = ( parm1.trim() != '' ) ? parseFloat(parm1) : 0;
	parm2 = ( parm2.trim() != '' ) ? parseFloat(parm2) : 0;
	parm3 = ( parm3.trim() != '' ) ? parseFloat(parm3) : 0;
	
	monto = parm1*parm2*parm3;

	$('#SubTotal_Item_'+array[1]+'_'+array[2]).val(monto);
	
	suma_total_items( array[1], $('#Nro_Items_'+array[1]).val() );

});

function suma_total_items(param,nrofilas) {
	monto = 0;
	for (var i = 0; i < nrofilas; i++) {
		valor = $('#SubTotal_Item_'+param+'_'+i).val();
		valor = ( valor.trim() != '' ) ? valor : 0;
		monto = parseFloat(monto) + parseFloat(valor);
	}
	$('#Subtotal_Part_'+param).val(monto);
}


////////////////////////////////////////////////
////// FORM PPTT DETAIL
////////////////////////////////////////////////
$("#pptt_gnrl_dtail_frm").validate({
	rules: {
		Cod_Act: {
			required:true,
			number:true,
		},
		Name_Act: {
			required:true,
		},
		Cntdad_Partidas: {
			required:true,
			number:true,
		},
		'Cod_Gasto[]': {
			required:true,
			rangelength:[8,11],
		},
		'Nombre_Part[]': {
			required:true,
		},
		'Nro_Items[]': {
			required:true,
			number:true,
		},
		'Item_Descripcion[]': {
			required:true,
		},
		'Cod_UM[]': {
			required:true,
			number:true,
		},
		'Cantidad[]': {
			required:true,
			number:true,
		},
		'Precio_Unit[]': {
			required:true,
			number:true,
		},
		'Tiempo[]': {
			required:true,
			number:true,
			range:[0,62],
		},
		'Monto_Mes_Item[]': {
			required:true,
			number:true,
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

		var pptt_gnrl_dtail_data = $("#pptt_gnrl_dtail_frm").serializeArray();
		pptt_gnrl_dtail_data.push(
			{name: 'ajax',value:1},
			{name: 'codigo_proyecto',value: $("input[name='cod_pryct']").val()},
			{name: 'id_area',value:1}
		);

		var bdtail = $( "#pptt_gnrl_dtail_frm :submit" );
		// bdtail.attr("disabled", "disabled");
		$.ajax({
			url: CI.site_url + "/presupuesto/presupuesto/datos_detalle",
			type:'POST',
			cache:false,
			data:pptt_gnrl_dtail_data,
			dataType:'json',
			success:function(json){
				alert(json.msg);
				// bdtail.removeAttr('disabled');
			}
		});
	}
});


</script>