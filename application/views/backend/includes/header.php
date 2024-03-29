<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>
		<?php 
			$title = isset($title) ? $title : 'Panel';
			echo 'CIE - '.$title;
		?>
	</title>
	<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('css/font-awesome.min.css'); ?>">
	<link rel="stylesheet/less" type="text/css" href="<?php echo base_url('js/style.less'); ?>" />
</head>

<body class="inei">
	<script src="<?php echo base_url('js/less-1.6.2.min.js'); ?>"></script>
	<script src="<?php echo base_url('js/jquery.js'); ?>"></script>
	<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>

	<script src="<?php echo base_url('js/main.js'); ?>"></script>
	<script type="text/javascript">
		var CI = {
			'site_url': '<?php echo site_url(); ?>'
		};
	</script>

	<div style="display: block;" id="header">
		<a href="#" id="logo"><img alt="CIE2013" src="http://webinei.inei.gob.pe/cie/2013/web/img/brand_gps.png"></a>
		<div id="oted">OFICINA TECNICA DE ESTADISTICAS DEPARTAMENTALES - OTED</div>
	</div>