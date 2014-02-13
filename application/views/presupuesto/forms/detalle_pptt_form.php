<?php 

////////////////////////////////////
////// DATOS GENERALES /////////////
////////////////////////////////////

$Cod_Actividad = array(
	'name'	=> 'Cod_Actividad',
	'id'	=> 'Cod_Actividad',
);

$Cod_Partida = array(
	'name'	=> 'Cod_Partida',
	'id'	=> 'Cod_Partida',
);

$Nro_Items = array(
	'name'	=> 'Nro_Items',
	'id'	=> 'Nro_Items',
);

$attr = array('id' => 'pptt_gnrl_dtail_frm');

echo form_open($this->uri->uri_string(),$attr);

?>

<div>

	Codigo de Actividad <?php echo form_input($Cod_Actividad); ?>
	Codigo de Partida <?php echo form_input($Cod_Partida); ?>
	Cantidad de Items <?php echo form_input($Nro_Items); ?>

</div>

<?php 
echo form_submit('send', 'Guardar','class="btn btn-primary"');
echo form_close();
?>
