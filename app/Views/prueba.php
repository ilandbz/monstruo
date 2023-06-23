
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/TR/REC-html40" lang="en">
    <head>
        <title>Sistema</title>
        
        <!--<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">--> 
        
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
        input[type=number] { -moz-appearance:textfield; }
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
                                    <span class="sr-only">Sistema</span>
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
                                                            <a href="<?php echo base_url()?>index.php/<?php echo $hijo['enlace']?>"><?php echo $hijo['modulo']?></a>
                                                        </li>
                                                    <?php }
                                                    ?>
                                                </ul>
                                            </li>
                                    <?php } ?>    
                                    <li><a href="<?PHP echo base_url(); ?>index.php/acceso/logout">Cerrar Sesión</a></li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">                                    
                                    <img width='100px' src='http://monstruo.demo/images/empresas/WhatsApp Image 2022-05-29 at 7.01.21 PM.jpeg'>                                    <li><strong>Sesión :</strong>&nbsp;JOSE&nbsp;&nbsp;&nbsp;&nbsp;</li>
                                    <li><b><span id="span_modo"></span></b><span id="span_beta"></span></li>
                                    <li><b><span id="span_empresa"></span></b></li>
                                </ul>
                            </div><!-- /.navbar-collapse -->                
                        </div><!-- /.container-fluid -->            
                    </nav>

                </div>                
            </div>
        </div>
        
    <script src="http://monstruo.demo/assets/js/monstruo/help.js"></script>
    <script type="text/javascript">
        
        var ls_empresa  = JSON.parse(localStorage.getItem("empresas"));
        var modo        = ls_empresa.modo;
        var empresa        = ls_empresa.empresa;
        if(modo == '0'){
            $("#span_modo").text("Modo: ");
            $("#span_beta").text("Beta");
        }
        $("#span_empresa").text(empresa);
    </script><div class="container-fluid" style="margin: 0 25px;">
    <div class="row">
        <div style="font-family: tahoma; font-size: 20px" class="col-md-12">
            <span>Bienvenido:</span> &nbsp;&nbsp;&nbsp;JOSE LUIS, HECTOR 
        </div>
    </div>
    <hr style="border:1px solid #F2F3F4;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-9">
                    <h3 class="panel-title">Venta mensuales:</h3>
                </div>
                <div class="col-md-3">
                    <select name="year" id="year" class="form-control">                        
                    </select>
                </div>
            </div>            
        </div>
        <div class="panel-body">
            <div id="chart_area" style="width: 1000px; height: 620px"></div>
        </div>        
    </div>    
    
</div>
<div class="container">
    <div class="sms"></div>
</div>

<div class="container-fluid" style="margin: 0 25px;">

</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="http://monstruo.demo/assets/js/monstruo/help.js"></script>
<script type="text/javascript">
    var base_url = 'http://monstruo.demo/';        
    
    $.getJSON(base_url + 'index.php/WS_variables_diversas/datos_accesorios')
    .done(function (data) {
        localStorage.setItem("datos_accesorios", JSON.stringify(data));
    });
    
    $.getJSON(base_url + 'index.php/WS_unidades/select_activos')
    .done(function (data) {
        localStorage.setItem("unidades_activas", JSON.stringify(data));
    });
    
    $.getJSON(base_url + 'index.php/WS_variables_diversas/ruta_guias')
    .done(function (data) {
        localStorage.setItem("ruta_guias", JSON.stringify(data));
    });
    
    $.getJSON(base_url + 'index.php/WS_producto_movimientos/ws_select_movimiento')
    .done(function (data) {
        localStorage.setItem("movimientos", JSON.stringify(data));
    });
    
    $.getJSON(base_url + 'index.php/WS_forma_pagos/select_all')
    .done(function (data) {
        localStorage.setItem("forma_pagos", JSON.stringify(data));
    });
    
    $.getJSON(base_url + 'index.php/WS_modo_pagos/select_all')
    .done(function (data) {
        localStorage.setItem("modo_pagos", JSON.stringify(data));
    });
    
    $.getJSON(base_url + 'index.php/WS_variables_diversas/select_all')
    .done(function (data) {
        localStorage.setItem("variables_diversas", JSON.stringify(data));
    });
        
    var url_serie = base_url + 'index.php/WS_series/series_defecto';
    $.getJSON(url_serie)
        .done(function (data) {
            localStorage.setItem("series_defecto", JSON.stringify(data.ws_select_series));        
    });
    
    $.getJSON(base_url + 'index.php/WS_monedas/monedas')
            .done(function (data) {
                localStorage.setItem("monedas", JSON.stringify(data.monedas));
    });
    
    $.getJSON(base_url + 'index.php/WS_tipo_documentos/tipo_documentos_all')
            .done(function (data) {                
                localStorage.setItem("tipo_documentos", JSON.stringify(data.tipo_documentos));
    });
    
    $.getJSON(base_url + 'index.php/WS_tipo_igvs/select_js')
            .done(function (data) {
                sortJSON(data.tipo_igv, 'id', 'asc');
                localStorage.setItem("tipo_igv", JSON.stringify(data.tipo_igv));
    });
    
    $.getJSON(base_url + 'index.php/WS_variables_diversas/datos_configuracion')
            .done(function (data) {
                localStorage.setItem("datos_configuracion", JSON.stringify(data.datos_configuracion));
    });
    
    $.getJSON(base_url + 'index.php/WS_tipo_entidades/select')
            .done(function (data) {
                localStorage.setItem("tipo_entidades", JSON.stringify(data.tipo_entidades));
    });
    
    $.getJSON(base_url + 'index.php/WS_bancos/select_js')
            .done(function (data) {
                localStorage.setItem("bancos", JSON.stringify(data.bancos));
    });
    
    $.getJSON(base_url + 'index.php/WS_tipo_cuentas/select_js')
            .done(function (data) {
                localStorage.setItem("tipo_cuentas", JSON.stringify(data.tipo_cuentas));
    });
    
    $.getJSON(base_url + 'index.php/WS_empresas/ws_select')
            .done(function (data) {
                localStorage.setItem("empresas", JSON.stringify(data));
    });

    ruta_select = base_url + 'index.php/WS_ventas/suma_mensual';
                
    for(var i = 0; i < 10; i++){
        $("#year").append($('<option>', {
            value: y - i,
            text: y- i
        }))
    }            
            
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback();

    function load_monthwise_data(year, title){
        var temp_title = title + ' ' + year + '';
        
        $.getJSON(ruta_select + '/' + year)
        .done(function (data) {
            drawMonthwiseChart(data, temp_title );
        });
    }
    
    function drawMonthwiseChart(chart_data, chart_main_title){
        var jsonData = chart_data;
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Mes');
        data.addColumn('number', 'Ventas');
        data.addColumn('number', 'Compras');
        $.each(jsonData, function(i, jsonData){
            var month = mes_texto(jsonData.mes);
            var ventas = parseFloat($.trim(jsonData.suma_ventas));
            var compras = parseFloat($.trim(jsonData.suma_compras));
            data.addRows([[month, ventas, compras]]);
        });
                                
        var options = {
            title:chart_main_title,
            hAxis:{
                title: "Meses"
            },
            vAxis:{
                title: "Monto"
            }
        };        
        var chart = new google.visualization.ColumnChart(document.getElementById("chart_area"));        
        chart.draw(data, options);
    }
    
    $(document).ready(function(){
        load_monthwise_data($("#year").val(), 'Ventas mensuales');
        
       $('#year').change(function(){
          var year = $(this).val();
          if(year != ''){
              console.log('anio: ' + year);
              load_monthwise_data(year, 'Ventas mensuales');
          }
       });
    });
</script>        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        
        <!-- Include all compiled plugins (below), or include individual files as needed -->        
        <script src="http://monstruo.demo/assets/bootstrap/js/bootstrap.min.js"></script> 
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        </div>	
    </body>
</html>