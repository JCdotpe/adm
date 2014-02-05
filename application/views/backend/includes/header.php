<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>
        <?php
            $title = isset($title) ? $title : 'Panel';
            echo 'CIE - ' . $title;
         ?>
    </title>

    <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/font-awesome.min.css'); ?>">    

    <link rel="stylesheet/less" type="text/css" href="<?php echo base_url('js/style.less'); ?>" />
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    </head>
    
    <body>


    <script src="<?php echo base_url('js/less-1.6.2.min.js'); ?>"></script>
    <script src="<?php echo base_url('js/jquery.js'); ?>"></script>
    <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>

    <div style="display: block;" id="header">
        <a href="#" id="logo"><img alt="CIE2013" src="http://webinei.inei.gob.pe/cie/2013/web/img/brand_gps.png"></a>
        <div id="oted">Oficina Técnica de Estadísticas Departamentales - OTED</div>
    </div>    