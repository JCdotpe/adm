<?php 

////////////////////////////////////
////// DETALLE PRESUPUESTO /////////
////////////////////////////////////

$Cod_Act = array(
	'name'	=> 'Cod_Act',
	'id'	=> 'Cod_Act',
	'class' => 'form-control text-right input2',
	'maxlength' => 2,
);

$Name_Act = array(
	'name'	=> 'Name_Act',
	'id'	=> 'Name_Act',
	'class' => 'form-control input98p',
	'readonly' => 'true',
);

$Subtotal_Act = array(
	'name'	=> 'Subtotal_Act',
	'id'	=> 'Subtotal_Act',
	'class'	=> 'form-control text-right input9',
	'readonly' => 'true',
);

$Cntdad_Partidas = array(
	'name'	=> 'Cntdad_Partidas',
	'id'	=> 'Cntdad_Partidas',
	'class' => 'form-control text-right input2',
	'maxlength' => 2,
);

$attr = array('id' => 'pptt_gnrl_dtail_frm','accept-charset' => 'UTF-8');
echo form_open($this->uri->uri_string(),$attr);

?>

<div id="cabecera" class="form-inline" role="form">
	
<h2>ACTIVIDADES MODELO 01</h2>
	
<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          01) DIRECCIÓN Y METODOLOGÍA
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
      	<!-- body -->

<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#jaccordion" href="#jcollapseOne">
          2.3.27.11.99 - CONTRATO POR LOCACIÓN DE SERVICIOS
        </a>
      </h4>
    </div>
    <div id="jcollapseOne" class="panel-collapse collapse in">
      <div class="panel-body">

		<table class="table table-striped table-hover" id="">
			<thead>
				<tr>
					<th>Nro.</th>
					<th>Item</th>
					<th>Unidad Medida</th>
					<th>Cantidad</th>
					<th>Precio Unitario</th>
					<th>Veces o Tiempo en Meses</th>
					<th>SubTotal</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input type="text" readonly="" value="1" class="form-control input2" name="Item[]" id="Item_0_0"></td>
					<td><input type="text" name="Item_Descripcion[]" class="form-control" id="Item_Descripcion_0_0"> <div class="help-block has-error"></div></td>
					<td><input type="text" name="Cod_UM[]" maxlength="2" class="form-control input3 medida" id="Cod_UM_0_0"> <input type="text" name="Unidad_Med[]" readonly="true" class="form-control input13" id="Unidad_Med_0_0"> <div class="help-block has-error"></div></td>
					<td><input type="text" name="Cantidad[]" maxlength="6" class="form-control input13 dsubtotal" id="Cantidad_0_0"> <div class="help-block has-error"></div></td><td><input type="text" name="Precio_Unit[]" class="form-control input13 dsubtotal" id="PrecioUnit_0_0"> <div class="help-block has-error"></div></td>
					<td><input type="text" name="Tiempo[]" maxlength="2" class="form-control input2 dsubtotal" id="Tiempo_0_0"> <div class="help-block has-error"></div></td>
					<td><input type="text" name="SubTotal_Item[]" readonly="true" class="form-control input8" id="SubTotal_Item_0_0"></td>
				</tr>
				<tr>
					<td><input type="text" readonly="" value="1" class="form-control input2" name="Item[]" id="Item_0_0"></td>
					<td><input type="text" name="Item_Descripcion[]" class="form-control" id="Item_Descripcion_0_0"> <div class="help-block has-error"></div></td>
					<td><input type="text" name="Cod_UM[]" maxlength="2" class="form-control input3 medida" id="Cod_UM_0_0"> <input type="text" name="Unidad_Med[]" readonly="true" class="form-control input13" id="Unidad_Med_0_0"> <div class="help-block has-error"></div></td>
					<td><input type="text" name="Cantidad[]" maxlength="6" class="form-control input13 dsubtotal" id="Cantidad_0_0"> <div class="help-block has-error"></div></td><td><input type="text" name="Precio_Unit[]" class="form-control input13 dsubtotal" id="PrecioUnit_0_0"> <div class="help-block has-error"></div></td>
					<td><input type="text" name="Tiempo[]" maxlength="2" class="form-control input2 dsubtotal" id="Tiempo_0_0"> <div class="help-block has-error"></div></td>
					<td><input type="text" name="SubTotal_Item[]" readonly="true" class="form-control input8" id="SubTotal_Item_0_0"></td>
				</tr>
				<tr>
					<td><input type="text" readonly="" value="1" class="form-control input2" name="Item[]" id="Item_0_0"></td>
					<td><input type="text" name="Item_Descripcion[]" class="form-control" id="Item_Descripcion_0_0"> <div class="help-block has-error"></div></td>
					<td><input type="text" name="Cod_UM[]" maxlength="2" class="form-control input3 medida" id="Cod_UM_0_0"> <input type="text" name="Unidad_Med[]" readonly="true" class="form-control input13" id="Unidad_Med_0_0"> <div class="help-block has-error"></div></td>
					<td><input type="text" name="Cantidad[]" maxlength="6" class="form-control input13 dsubtotal" id="Cantidad_0_0"> <div class="help-block has-error"></div></td><td><input type="text" name="Precio_Unit[]" class="form-control input13 dsubtotal" id="PrecioUnit_0_0"> <div class="help-block has-error"></div></td>
					<td><input type="text" name="Tiempo[]" maxlength="2" class="form-control input2 dsubtotal" id="Tiempo_0_0"> <div class="help-block has-error"></div></td>
					<td><input type="text" name="SubTotal_Item[]" readonly="true" class="form-control input8" id="SubTotal_Item_0_0"></td>
				</tr>								
			</tbody>
		</table>

      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#jaccordion" href="#jcollapseTwo">
          2.3.28.12 - CONTRIBUCIONES A ESSALUD DE CAS
        </a>
      </h4>
    </div>
    <div id="jcollapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#jaccordion" href="#jcollapseThree">
          2.3.21.2.99 - OTROS GASTOS
        </a>
      </h4>
    </div>
    <div id="jcollapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
</div>

      	<!-- body -->
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          02) SEGMENTACION
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
          03) ARCHIVO, DISTRIBUCIÓN y RECEPCIÓN
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
</div>

<hr />

<h2>ACTIVIDADES MODELO 02</h2>
<?php echo form_hidden('Nro_Act'); ?>

	<table class="table table-striped table-hover">
		<thead>
			<th width="60px">COD</th>
			<th>ACTIVIDAD</th>
			<th width="120px">TOTAL</th>
			<th width="60px">PARTIDAS</th>
		</thead>
		<tbody>
			<tr>
				<td><?php echo form_input($Cod_Act); ?><div class="help-block has-error"></td>
				<td><?php echo form_input($Name_Act); ?><div class="help-block has-error"></td>
				<td class="text-right"><?php echo form_input($Subtotal_Act); ?><div class="help-block has-error"></td>
				<td class="text-right"><?php echo form_input($Cntdad_Partidas); ?><div class="help-block has-error"></td>
			</tr>
		</tbody>
	</table>

	<hr />

</div>
<br>

<div id="maestro">
	<!-- AJAX -->
</div>

<?php 
echo form_submit('enviar', 'Guardar','class="btn btn-primary"');
echo form_close();
?>
<script type="text/javascript">

////////////////////////////////////////////////
////// DETALLE DE PRESUPUESTO
////////////////////////////////////////////////
var proyct;

$(function(){
	$.each( <?php echo json_encode($presup_mes->result()) ?>, function(i, datos){
		html = '<input type="hidden" id="Mes_Dtail_'+i+'" name="Mes[]" value="'+datos.Mes+'">';
		$('#cabecera').append(html);
	});

	proyct = $("input[name='cod_pryct']").val();

});

$('#Cod_Act').change(function(event){

	codigo = $(this).val();

	$.getJSON(CI.site_url+'/presupuesto/presupuesto/actividad_pptt', {codigo:codigo,proyct:proyct,area:1,anio:2014,ajax:1}, function(json_data, textStatus) {

		$("input[name='Nro_Act']").val('');
		$('#Name_Act').val('');
		$('#Subtotal_Act').val('');
		$('#Cntdad_Partidas').val('');
		$.each(json_data, function(i,datos){
			$("input[name='Nro_Act']").val( datos.Nro_Act );
			$('#Name_Act').val( datos.Descripcion );
			$('#Subtotal_Act').val( datos.Monto_Act );
			if ( datos.Cntdad_Partidas > 0 ) { 
				$('#Cntdad_Partidas').val( datos.Cntdad_Partidas );
			}
			$('#Cntdad_Partidas').trigger('change');
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

		$.getJSON(CI.site_url+'/presupuesto/presupuesto/AG_Gasto', {codigo:$('#Cod_Act').val(),proyct:proyct,area:1,anio:2014,ajax:1}, function(json_data, textStatus) {

			$.each(json_data, function(i,datos){
				$('#Cod_Part_'+i).val( datos.Cod_Gasto );
				buscar_gastopptt( datos.Cod_Gasto, i);
				$('#Nro_Items_'+i).val( datos.Item );
				$('.items').trigger('change');
			});
		});
		
		$('#Cod_Part_0').focus();
	}
});

$(document).on("change",'.items',function() {
	var campo = $(this);
	var cod = campo.attr('id');
	array = cod.split("_");


	nro = campo.val();
	mcs = $('#Cantidad_Mes').val();
	posi_prtd = array[2];

	$('.tb_items_'+posi_prtd).remove();

	if (nro > 0)
	{
		html = '<table id="tb_'+posi_prtd+'" class="table table-striped table-hover tb_items_'+posi_prtd+'">';
		html += '<thead>';
		html += '<th>Nro.</th>';
		html += '<th>Item</th>';
		html += '<th>Unidad Medida</th>';
		html += '<th>Cantidad</th>';
		html += '<th>Precio Unitario</th>';
		html += '<th>Veces o Tiempo en Meses</th>';
		html += '<th>SubTotal</th>';

		for (var j = 0; j < mcs; j++) {
			html += '<th> <label id="lbl_Mes_'+posi_prtd+'_'+j+'"></label> </th>';
			cod_mes = $("input[id='Mes_Dtail_"+j+"']").val();
			nombre_mes( cod_mes, posi_prtd, j );
		}
		html += '</thead>';
		html += '<tbody>';

		for (var i = 0; i < nro; i++) {
			html += '<tr>';
			html += '<td><input type="text" id="Item_'+posi_prtd+'_'+i+'" name="Item[]" class="form-control input2" value="'+( parseInt(i) + 1 )+'" readonly /></td>';
			html += '<td><input id="Item_Descripcion_'+posi_prtd+'_'+i+'" class="form-control" type="text" name="Item_Descripcion[]"> <div class="help-block has-error"></div></td>';
			html += '<td><input id="Cod_UM_'+posi_prtd+'_'+i+'" class="form-control input3 medida" type="text" maxlength="2" name="Cod_UM[]"> <input id="Unidad_Med_'+posi_prtd+'_'+i+'" class="form-control input13" type="text" readonly="true" name="Unidad_Med[]"> <div class="help-block has-error"></div></td>';
			html += '<td><input id="Cantidad_'+posi_prtd+'_'+i+'" class="form-control input13 dsubtotal" type="text" maxlength="6" name="Cantidad[]"> <div class="help-block has-error"></div></td>';
			html += '<td><input id="PrecioUnit_'+posi_prtd+'_'+i+'" class="form-control input13 dsubtotal" type="text" name="Precio_Unit[]"> <div class="help-block has-error"></div></td>';
			html += '<td><input id="Tiempo_'+posi_prtd+'_'+i+'" class="form-control input2 dsubtotal" type="text" maxlength="2" name="Tiempo[]"> <div class="help-block has-error"></div></td>';
			html += '<td><input id="SubTotal_Item_'+posi_prtd+'_'+i+'" class="form-control input8" type="text" readonly="true" name="SubTotal_Item[]"></td>';

			for (var x = 0; x < mcs; x++) {
				html += '<td><input id="Monto_Mes_'+x+'_Item_'+posi_prtd+'_'+i+'" class="form-control input8" type="text" name="Monto_Mes_Item[]"> <div class="help-block has-error"></div></td>';
			};
			html += '</tr>';
		}
		html += '</tbody>';
		html += '</table>';

		$('#dv_'+posi_prtd).append(html);

		buscar_items( $('#Cod_Act').val(), $('#Cod_Part_'+posi_prtd).val(), posi_prtd );
		buscar_items_meses( $('#Cod_Act').val(), $('#Cod_Part_'+posi_prtd).val(), posi_prtd );

		$('#Item_Descripcion_'+posi_prtd+'_0').focus();
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

function buscar_items(actvdad, prtda, posi_prtd) {
	$.getJSON(CI.site_url+'/presupuesto/presupuesto/AG_Gasto_2', {actvdad:actvdad,proyct:proyct,area:1,anio:2014,prtda:prtda,ajax:1}, function(json_data, textStatus) {

		$.each(json_data, function(i,datos){
			$('#Item_'+posi_prtd+'_'+i).val( datos.Item );
			$('#Item_Descripcion_'+posi_prtd+'_'+i).val( datos.Item_Descripcion );
			$('#Cod_UM_'+posi_prtd+'_'+i).val( datos.Cod_UM.trim() );
			$('#Cantidad_'+posi_prtd+'_'+i).val( datos.Cantidad );
			$('#PrecioUnit_'+posi_prtd+'_'+i).val( datos.Precio_Unit );
			$('#Tiempo_'+posi_prtd+'_'+i).val( datos.Tiempo );
			buscar_medida( datos.Cod_UM.trim() , posi_prtd, i );
			subtotal_items( posi_prtd, i );
		});
		suma_total_items( posi_prtd, $('#Nro_Items_'+posi_prtd).val() );
	});
}

function buscar_items_meses(actvdad, prtda, posi_prtd) {
	
	var cod_mes;
	var ms = 0;
	var fila = 0;

	$.getJSON(CI.site_url+'/presupuesto/presupuesto/AGM_Gasto', {actvdad:actvdad,proyct:proyct,area:1,anio:2014,prtda:prtda,ajax:1}, function(json_data, textStatus) {

		$.each(json_data, function(i,datos){
			if ( i == 0)
			{
				$('#Monto_Mes_'+ms+'_Item_'+posi_prtd+'_'+fila).val( datos.Monto_Mes_Item );
				cod_mes = datos.Mes;
			}else{
				ms = ( cod_mes != datos.Mes ) ? ( ms + 1 ) : ms;
				fila = ( cod_mes != datos.Mes ) ? 0 : ( fila + 1 );
				$('#Monto_Mes_'+ms+'_Item_'+posi_prtd+'_'+fila).val( datos.Monto_Mes_Item );
				cod_mes = datos.Mes;
			}
		});

	});

}


$(document).on("change",'.gasto',function() {

	var campo = $(this);
	var cod = campo.attr('id');
	array = cod.split("_");

	codigo = campo.val();
	buscar_gastopptt(codigo,array[2]);
	
});

function buscar_gastopptt (code,posi) {

	$.getJSON(CI.site_url+'/presupuesto/presupuesto/gasto_pptt', {codigo:code,proyct:proyct,area:1,anio:2014,ajax:1}, function(json_data, textStatus) {

		$('#Nombre_Part_'+posi).val('');
		$("#Nro_Part_"+posi).val('');
		$.each(json_data, function(i,datos){
			$('#Nombre_Part_'+posi).val(datos.Descripcion);
			$("#Nro_Part_"+posi).val(datos.Nro_Gasto);
		});
	});

}

$(document).on("change",'.medida',function() {

	var campo = $(this);
	var cod = campo.attr('id');
	array = cod.split("_");

	codigo = campo.val();
	buscar_medida( codigo, array[2], array[3] );
	
});

function buscar_medida(uni_med,posi_prtd,fila) {

	$.getJSON(CI.site_url+'/general/general/unidad_medida', {codigo:uni_med,ajax:1}, function(json_data, textStatus) {

		$('#Unidad_Med_'+posi_prtd+'_'+fila).val('');
		$.each(json_data, function(i,datos){
			$('#Unidad_Med_'+posi_prtd+'_'+fila).val(datos.Unidad_Med);
		});
	});
	
}


$(document).on("change",'.dsubtotal',function() {

	var campo = $(this);
	var cod = campo.attr('id');
	array = cod.split("_");

	subtotal_items( array[1], array[2] );
	suma_total_items( array[1], $('#Nro_Items_'+array[1]).val() );

});

function subtotal_items(posi_prtd,fila) {
	
	parm1 = $('#Cantidad_'+posi_prtd+'_'+fila).val();
	parm2 = $('#PrecioUnit_'+posi_prtd+'_'+fila).val();
	parm3 = $('#Tiempo_'+posi_prtd+'_'+fila).val();

	parm1 = ( parm1.trim() != '' ) ? parseFloat(parm1) : 0;
	parm2 = ( parm2.trim() != '' ) ? parseFloat(parm2) : 0;
	parm3 = ( parm3.trim() != '' ) ? parseFloat(parm3) : 0;
	
	monto = parm1*parm2*parm3;

	$('#SubTotal_Item_'+posi_prtd+'_'+fila).val(monto);
}

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