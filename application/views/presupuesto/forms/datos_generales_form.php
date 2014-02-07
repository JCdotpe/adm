<?php 

////////////////////////////////////
////// DATOS GENERALES /////////////
////////////////////////////////////

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

$attr = array('id' => 'dtgeneral_form');

echo form_open($this->uri->uri_string(),$attr);

?>

<div>
	Cantidad de Meses <?php echo form_input($Nro_Meses); ?>
	<table id="pptt_meses" border="1">
		<thead>
			<th>Nro</th>
			<th>Nombre Meses</th>
			<th>SubTotal</th>
			<th>IGV</th>
			<th>Total General</th>
		</thead>
		<tbody>
			<!-- <tr>
				<td>07</td>
				<td>JULIO</td>
				<td>25000</td>
				<td>0</td>
				<td>25000</td>
			</tr>
			<tr>
				<td>08</td>
				<td>JULIO</td>
				<td>25000</td>
				<td>0</td>
				<td>25000</td>
			</tr> -->
		</tbody>
	</table>

	Cantidad de Actividades <?php echo form_input($Nro_Actividades); ?>
	<table id="pptt_actividades" border="1">
		<thead>
			<th>Nro</th>
			<th>Nombre Actividad</th>
			<th>SubTotal</th>
			<th class='prct'>%</th>
		</thead>
		<tbody>
			<!-- <tr>
				<td>07</td>
				<td>JULIO</td>
				<td>25000</td>
				<td>0</td>
			</tr>
			<tr>
				<td>08</td>
				<td>JULIO</td>
				<td>25000</td>
				<td>0</td>
			</tr> -->
		</tbody>
	</table>
</div>

<?php 
echo form_close();
?>

<script type="text/javascript">

$('#Nro_Meses').change(function(event) {

	nro = $(this).val();
	$('#pptt_meses > tbody > tr').remove();

	if (nro > 0){
		html = '';
		for (var i = 0; i < nro; i++){
			html += '<tr>';
			html += '<td>'+i+'</td>';
			html += '<td>JULIO</td>';
			html += '<td>25000</td>';
			html += '<td>0</td>';
			html += '<td>25000</td>';
			html += '</tr>';
		}
		$('#pptt_meses > tbody').append(html);
	}
	$('#Nro_Actividades').trigger('change');
});


$('#Nro_Actividades').change(function(event){

	mss = $('#Nro_Meses').val();
	
	$('.th_meses').remove();
	if (mss > 0){
		html = '';
		for (var i = 0; i < mss; i++) {
			html += '<th class = "th_meses" >'+i+'</th>';
		}
		$('.prct').after(html);

		act = $(this).val();
		$('#pptt_actividades > tbody > tr').remove();
		if (act > 0){
			html2 = '';
			for (var j = 0; j < act; j++) {
				html2 += '<tr>';
				html2 += '<td>'+j+'</td>';
				html2 += '<td>SEGMENTACION</td>';
				html2 += '<td>4350</td>';
				html2 += '<td>0.62</td>';
				for (var m = 0; m < mss; m++) {
					html2 += '<td>'+m+'</td>';
				}
				html2 += '</tr>';
			}
			$('#pptt_actividades > tbody').append(html2);
		}
	}

});

</script>