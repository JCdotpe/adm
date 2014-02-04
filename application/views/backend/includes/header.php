<!DOCTYPE html>

<html class="no-js"> 
    
    <head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    <title>
        <?php
            $title = isset($title) ? $title : 'Panel';
            echo 'CIE - ' . $title;
         ?>
    </title>
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    

    <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.spacelab.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/bootstrap-responsive.min.css'); ?>">
    <!--<link rel="stylesheet" href="--><?php //echo base_url('css/jquery.dataTables.css'); ?><!--">-->
    
    <link rel="stylesheet" href="<?php echo base_url('css/smoothness/jquery-ui-1.10.3.custom.min.css') ?>">
    
    <link rel="stylesheet" href="<?php echo base_url('css/TableTools.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/ui.jqgrid.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/main.css'); ?>">
     <link rel="stylesheet" href="<?php echo base_url('css/basic.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('img/ico/favicon.ico'); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo base_url('img/ico/apple-touch-icon-57x57-precomposed.png'); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url('img/ico/apple-touch-icon-114x114-precomposed.png'); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url('img/ico/apple-touch-icon-72x72-precomposed.png'); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url('img/ico/apple-touch-icon-144x144-precomposed.png'); ?>">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url('img/ico/apple-touch-icon-57-precomposed.png'); ?>">
    
    
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>-->    
    <!--<script src="<?php echo base_url('js/general/jquery-1.8.3.min.js'); ?>"></script>-->
    
    <script src="<?php echo base_url('js/general/jquery-1.10.2.min.js'); ?>"></script>
    <script src="<?php echo base_url('js/general/jquery-ui-1.10.2.custom.min.js'); ?>"></script>
    <script src="<?php echo base_url('js/general/basic.js'); ?>"></script>

    <script src="<?php echo base_url('js/general/jquery.validate.min.js'); ?>"></script>
    <script src="<?php echo base_url('js/general/jquery.cookie.js'); ?>"></script>
    <script src="<?php echo base_url('js/jqgrid/i18n/grid.locale-es.js'); ?>"></script>
    <script src="<?php echo base_url('js/jqgrid/jquery.jqGrid.min.js'); ?>"></script>

    <script src="<?php echo base_url('js/general/jquery-migrate-1.0.0.js'); ?>"></script>
        
    <script src="<?php echo base_url('js/general/bootstrap.min.js'); ?>"></script>
        
    <script src="<?php echo base_url('js/general/modernizr-2.6.2-respond-1.1.0.min.js'); ?>"></script>
        
     <!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBRWqVZ3W4STXTofBB1i7BvCKmhPfA4GM8&sensor=false"></script> -->
    
    <!-- Le fav and touch icons -->
   
    <script type="text/javascript">
        <!--
            var CI = {
              'base_url': '<?php echo base_url(); ?>',
              'site_url': '<?php echo site_url(); ?>',
              'year' : <?php echo date("Y"); ?>,
              'cct' : $.cookie('csrf_cookie_name')
            };            
        -->
    </script>

    </head>
    
    <body>

