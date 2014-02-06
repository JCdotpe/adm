<?php 

////////////////////////////////////
////// DATOS GENERALES /////////////
////////////////////////////////////

$Nro_Meses = array(
	'name'	=> 'Nro_Meses',
	'id'	=> 'Nro_Meses',
	'maxlength'	=> 2,
);

$attr = array('id' => 'dtgeneral_form');

echo form_open($this->uri->uri_string(),$attr);

?>

<div>
	Cantidad de Meses <?php echo form_input($Nro_Meses); ?>
</div>