<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/TR/REC-html40" lang="en">
    <head>
        <title>Sistema</title>
              
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">      
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>images/siti01.ico" />       
        <link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/chosen/chosen.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/themes-smoothness-jquery-ui.css">         
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.toast.min.css">         
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-confirm.min.css">         
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/style_hector.css">  
        <!-- custom css -->
        <link rel="stylesheet" href="<?php echo base_url();?>css/custom.css">        
          
        <script src="<?php echo base_url(); ?>js/jquery-2.2.4.min.js"></script> 
        <script src="<?php echo base_url(); ?>plugins/chosen/chosen.jquery.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery-ui-1.11.0.js"></script>        
        <script src="<?php echo base_url(); ?>js/jquery.toast.min.js"></script>        
        <script src="<?php echo base_url(); ?>js/jquery-confirm.min.js"></script>        
        <script src="<?php echo base_url(); ?>js/function_dashboard.js"></script>
        <script src="<?php echo base_url(); ?>js/chart.min.js"></script>
        <script src="<?php echo base_url(); ?>js/monstruo/config.js"></script>

        <style type="text/css" >
            input[type=number]::-webkit-inner-spin-button, 
            input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
            }
            input[type=number] { -moz-appearance:textfield;appearance:textfield }
        </style>                                                                                       
    </head>
    <body>
        <div class="container-fluid" style="margin: 0 25px;">
            <!-- Example row of columns -->
            <div class="row">                
                <div class="col-md-12">
                    <nav class="navbar navbar-default" role="navigation" style="background: #fff;border-bottom:1px solid #D6DBDF;border-left:1px solid #D6DBDF;border-right:  1px solid #D6DBDF;">
                        <div class="container-fluid">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Sistema </span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    
                                </ul>
                                <ul class="nav navbar-nav">                                                                    
                                    <?php 
                                        foreach($_SESSION['padres'] as $padre){?>
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= $padre['direccion_icono']." ".$padre['modulo']?><span class="caret"></span></a>
                                                <ul class="dropdown-menu" role="menu">                                                    
                                                    <?php
                                                        foreach($_SESSION['hijos'][$padre['modulo_id']] as $hijo){?>
                                                        <li>                                                            
                                                            <a href="<?php echo base_url()?><?php echo $hijo['enlace']?>"><?php echo $hijo['modulo']?></a>
                                                        </li>
                                                    <?php }
                                                    ?>
                                                </ul>
                                            </li>
                                    <?php } ?>    
                                    <li><a href="<?PHP echo base_url(); ?>index.php/acceso/logout">Cerrar Sesión</a></li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">                                    
                                    <?php                                                                                 
                                    echo "<img width='100px' src='".base_url()."images/empresas/".$empresa['foto']."'>";

                                    $nombre = $session['nombres']
                                    ?>
                                    <li><strong>Sesión :</strong>&nbsp;<?PHP echo $nombre; ?>&nbsp;&nbsp;&nbsp;&nbsp;</li>
                                    <li><b><span id="span_modo"></span></b><span id="span_beta"></span></li>
                                    <li><b><span id="span_empresa"></span></b></li>
                                </ul>
                            </div><!-- /.navbar-collapse -->                
                        </div><!-- /.container-fluid -->            
                    </nav>

                </div>                
            </div>
        </div>
        
    <script src="<?PHP echo base_url(); ?>js/monstruo/help.js"></script>
    <script type="text/javascript">
        
        // var ls_empresa  = JSON.parse(localStorage.getItem("empresas"));
        // var modo        = ls_empresa.modo;
        // var empresa        = ls_empresa.empresa;
        // if(modo == '0'){
        //     $("#span_modo").text("Modo: ");
        //     $("#span_beta").text("Beta");
        // }
        // $("#span_empresa").text(empresa);
    </script>