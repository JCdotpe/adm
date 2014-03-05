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
	'class' => 'form-control',
);

$Mes_Inicio_N = array(
	'name'	=> 'Mes_Inicio_N',
	'id'	=> 'Mes_Inicio_N',
	'readonly' => 'true',
	'class' => 'form-control',
);

$Mes_Fin = array(
	'name'	=> 'Mes_Fin',
	'id'	=> 'Mes_Fin',
	'maxlength'	=> 2,
	'class' => 'form-control',
);

$Mes_Fin_N = array(
	'name'	=> 'Mes_Fin_N',
	'id'	=> 'Mes_Fin_N',
	'readonly' => 'true',
	'class' => 'form-control',
);

$attr = array('id' => 'pptt_gnrl_frm','accept-charset' => 'UTF-8', 'role' => 'form');

echo form_open($this->uri->uri_string(),$attr);

?>
<div class="col-md-5">
	<h2>Matricula del Proyecto</h2>
		
	<div class="form-group">
		<label>Meta</label>
		<?php echo form_input($Meta); ?>
	</div>

	<div class="form-group">
		<label>Nombre del Proyecto</label>
		<?php echo form_input($Proyecto); ?>
	</div>

	<div class="form-group">
		<label>Fuente de Financiamiento</label>
		<select id="ff" class="form-control">
			<option value="0">Seleccione...</option>
			<option value="1">Ordinario</option>
			<option value="2">Donaciones y Transferencias</option>
			<option value="3">Otros Recursos</option>
		</select>
	</div>

	<div class="form-group">
		<label>Dirección Técnica</label>
		<select id="dt" class="form-control">
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
	</div>
	
</div>