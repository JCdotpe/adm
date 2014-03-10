<script src="<?php echo base_url('js/jquery.validate.min.js'); ?>"></script>
<script src="<?php echo base_url('js/validate.js'); ?>"></script>

<?php 

$Proyecto = array(
	'name'	=> 'Proyecto',
	'id'	=> 'Proyecto',
	'class'	=> 'form-control',
);

$Meta = array(
	'name'	=> 'Meta',
	'id'	=> 'Meta',
	'class'	=> 'form-control',
);

$Director_Tecnico = array(
	'name'	=> 'Director_Tecnico',
	'id'	=> 'Director_Tecnico',
	'class'	=> 'form-control',
);

$Jefe_Proyecto = array(
	'name'	=> 'Jefe_Proyecto',
	'id'	=> 'Jefe_Proyecto',
	'class'	=> 'form-control',
);

$Mes_Inicio = array(
	'name'	=> 'Mes_Inicio',
	'id'	=> 'Mes_Inicio',
	'maxlength'	=> 2,
	'class' => 'form-control meses',
);

$Mes_Inicio_N = array(
	'name'	=> 'Mes_N_Inicio',
	'id'	=> 'Mes_N_Inicio',
	'readonly' => 'true',
	'class' => 'form-control',
);

$Mes_Fin = array(
	'name'	=> 'Mes_Fin',
	'id'	=> 'Mes_Fin',
	'maxlength'	=> 2,
	'class' => 'form-control meses',
);

$Mes_Fin_N = array(
	'name'	=> 'Mes_N_Fin',
	'id'	=> 'Mes_N_Fin',
	'readonly' => 'true',
	'class' => 'form-control',
);

$attr = array('id' => 'matricula_frm','accept-charset' => 'UTF-8', 'role' => 'form');

?>
<div class="col-md-5">
<?php echo form_open($this->uri->uri_string(),$attr); ?>

	<h2>Matricula del Proyecto</h2>
		
	<div class="form-group">
		<label>Nombre del Proyecto</label>
		<?php echo form_input($Proyecto); ?>
	</div>

	<div class="form-group">
		<label>Meta</label>
		<?php echo form_input($Meta); ?>
	</div>

	<div class="form-group">
		<label>Fuente de Financiamiento</label>
		<select id="ff" name="Financiamiento" class="form-control">
			<option value="-1">Seleccione...</option>
			<option value="1">Ordinario</option>
			<option value="2">Donaciones y Transferencias</option>
			<option value="3">Otros Recursos</option>
		</select>
	</div>

	<div class="form-group">
		<label>Dirección Técnica</label>
		<select id="dt" name="Id_Area" class="form-control">
			<option value="0">Seleccione...</option>
			
		</select>
	</div>
		
	<div class="form-group">
		<label>Director Técnico</label>
		<?php echo form_input($Director_Tecnico); ?>
	</div>

	<div class="form-group">
		<label>Jefe de Proyecto</label>
		<?php echo form_input($Jefe_Proyecto); ?>
	</div>

	<div class="form-group">
		<label>Periodo</label>
		<div class="row">
			
			<div class="col-md-1">
				<?php echo form_input($Mes_Inicio); ?>
			</div>
			<div class="col-md-4">
				<?php echo form_input($Mes_Inicio_N); ?>
			</div>
			
			<div class="col-md-1">
				-
			</div>

			<div class="col-md-1">
				<?php echo form_input($Mes_Fin); ?>
			</div>
			<div class="col-md-4">
				<?php echo form_input($Mes_Fin_N); ?>
			</div>

			
		</div>
	</div>
	<div class="form-group">
		<label>Actividades</label>
		<div id="la"></div>
	</div>
	
<?php 

echo form_submit('enviar', 'Guardar','class="btn btn-primary"');
echo form_close();

?>
</div>

<script type="text/javascript">
	
	$(function () {
		
		$.getJSON(CI.site_url+'/general/general/area_usuaria', {ajax:1}, function(json_data, textStatus) {

			$('#dt').empty();

			$.each(json_data, function(i,datos){
				$("#dt").append('<option value="' + datos.Id_Area + '">' + datos.Nombre + '</option>');
			});
			$("#dt").prepend("<option value='-1' selected='true'>Seleccione...</value>");
		});

		$.getJSON(CI.site_url+'/general/general/actividades', {ajax:1}, function(json_data, textStatus) {

			html = '';

			$.each(json_data, function(i,datos){
				html += '<input type="checkbox" name="lst_a[]" id="lst_a_'+i+'" value="'+datos.Cod_Act+'"> '+datos.Descripcion+' <br>';
			});
			
			$('#la').html(html);
		});


		$(document).on("change",'.meses',function() {
			var campo = $(this);
			var id = campo.attr('id');
			array=id.split("_");
			buscar_meses(campo.val(),array[1]);// consulta mes por codigo
		});

		function buscar_meses(codigo,posi){
			$.getJSON(CI.site_url+'/general/general/meses_by', {codigo:codigo,ajax:1}, function(json_data, textStatus) {

				$('#Mes_N_'+posi).val('');
				$.each(json_data, function(i,datos){
					$('#Mes_N_'+posi).val(datos.Nombre);
				});
			});
		}


		$("#matricula_frm").validate({
			rules: {
				// 'Mes[]':{
				// 	required:true,
				// 	number:true,
				// 	range:[1,12],
				// 	valNotEquals:['Mes_','Cantidad_Mes'],
				// },
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

				var matricula_data = $("#matricula_frm").serializeArray();
				matricula_data.push(
					{name: 'ajax',value:1}
				);

				var bmatri = $( "#matricula_frm :submit" );
				// bmatri.attr("disabled", "disabled");
				$.ajax({
					url: CI.site_url + "/matricula/matricula/datos_generales",
					type:'POST',
					cache:false,
					data:matricula_data,
					dataType:'json',
					success:function(json){
						alert(json.msg);
						// bgnrl.removeAttr('disabled');
					}
				});
			}
		});



	});

</script>