
<script src="<?PHP echo base_url(); ?>assets/js/monstruo/help.js"></script>
<script type="text/javascript">
    //var base_url = '<?php echo base_url();?>';
    var total_filas = 0;
    var filas_por_pagina = 10;
    var pagina_inicial = 1;
    // let datos_configuracion = JSON.parse(localStorage.getItem("datos_configuracion"));
    // var param_stand_url = datos_configuracion.param_stand_url;
    var modal_categoria_id;
    var buscar = "";



    $(document).ready(function(){                     
                
        $("#tabla_empleado_id").on('click','.btn_modificar_empleado', function(){
            var empleado_id = $(this).attr('id');
            ruta_url = base_url + 'index.php/empleados/modal_operacion/';
            $("#myModal").load(ruta_url);                                    

            ruta_url_item = base_url + 'index.php/WS_empleados/ws_select_item/' + empleado_id;
            console.log(ruta_url_item);
            $.getJSON(ruta_url_item)
                    .done(function (data){
                        tipo_empleado_id_select = data.tipo_empleado_id;
                        $('#modal_o_empleado_id').val(empleado_id);
                        $('#modal_o_apellido_paterno').val(data.apellido_paterno);
                        $('#modal_o_apellido_materno').val(data.apellido_materno);
                        $('#modal_o_nombres').val(data.nombres);
                        $('#modal_o_contrasena').val(data.contrasena);
                        $('#modal_o_fecha_nacimiento').val(data.fecha_nacimiento);
                        $('#modal_o_dni').val(data.dni);
                        $('#modal_o_domicilio').val(data.domicilio);
                        $('#modal_o_telefono_fijo').val(data.telefono_fijo);
                        $('#modal_o_movil').val(data.movil);
                        $('#modal_o_email_1').val(data.email_1);
                        $('#modal_o_email_2').val(data.email_2);
                    })                        
        });      
        //Perfil - Detalle
        $("#tabla_empleado_id").on('click','.btn_perfil_empleado', function(){
            var empleado_id = $(this).attr('id');
            ruta_url = base_url + 'index.php/empleados/modal_detalle/';
            $("#myModal").load(ruta_url);                                    

            ruta_url_item = base_url + 'index.php/WS_empleados/ws_select_item/' + empleado_id;
            console.log(ruta_url_item);
            $.getJSON(ruta_url_item)
                    .done(function (data){                                       
                        $('#modal_tipo_empleado').text(data.tipo_empleado);
                        $('#modal_apellido_paterno').text(data.apellido_paterno);
                        $('#modal_apellido_materno').text(data.apellido_materno);
                        $('#modal_nombres').text(data.nombres);
                        $('#modal_fecha_nacimiento').text(data.fecha_nacimiento);
                        $('#modal_dni').text(data.dni);
                        $('#modal_domicilio').text(data.domicilio);
                        $('#modal_telefono_fijo').text(data.telefono_fijo);
                        $('#modal_movil').text(data.movil);
                        $('#modal_email_1').text(data.email_1);
                        $('#modal_email_2').text(data.email_2);
                        
                        $('#foto_empleado_id').val(empleado_id);
                        foto_imagen = (data.foto == null) ? 'sin_foto.jpg' : data.foto
                        $("#img_empleado").attr('src', base_url + 'images/empleados/'+foto_imagen);
                    });                        
        });
        //foto
        $("#tabla_empleado_id").on('click','.btn_foto_empleado', function(){
            var empleado_id = $(this).attr('id');
                        
            ruta_url = base_url + 'index.php/empleados/modal_foto/';
            $("#myModal").load(ruta_url);
                    
            ruta_url_item = base_url + 'index.php/WS_empleados/ws_select_item/' + empleado_id;
            $.getJSON(ruta_url_item)
                    .done(function (data){
                        $("#datos_emplado").text(data.apellido_paterno+'-'+data.apellido_materno+', '+data.nombres);
                        
                        $('#foto_empleado_id').val(empleado_id);
                        foto_imagen = (data.foto == null) ? 'sin_foto.jpg' : data.foto
                        $("#img_empleado").attr('src', base_url + 'images/empleados/'+foto_imagen);
                    });
                    
        });
        
        $("#tabla_empleado_id").on('click', '.btn_eliminar_empleado', function(){            
            var empleado_id = $(this).attr('id');            
            var x = confirm("Desea eliminar esta empleado:");
            if (x){ 
                ruta_url_item = base_url + 'index.php/WS_empleados/delete_item/' + empleado_id;
                $.getJSON(ruta_url_item)
                        .done(function (data){
                            console.log('elimiación correcta' + data);
                        });
                        
                var parent = $(this).parent("td").parent("tr");
                parent.fadeOut('slow'); //Borra la fila afectada                
//                $("#tabla_empleado_id > tbody").remove();
//                $("#lista_id_pagination > li").remove();
//                carga_inicial();
            }
        });        
    });
    
    $("#btn_nueva_empleado").click(function(){
        $("#myModal").load('<?php echo base_url()?>index.php/empleados/modal_operacion');
    }); 
    
    carga_inicial();
    
    function carga_inicial(){



        //CARGA INICIAL

        $.ajax({
            dataType:'json',
            url: '<?=base_url('wsempleados/todos')?>',
            data: {
                page: pagina_inicial,
                paginacion: filas_por_pagina,
                buscar: buscar
            },
            success: function(data) {
                let carga =1;
                //js/mostruo/help.js
                construir_paginacion(data.total_filas,filas_por_pagina,carga)
                let numero_orden = 1;
                (data.data).forEach(function(repo) {
                    agregarFila(numero_orden,repo)
                    numero_orden++;
                });
            }
        })



            
    }
   
    function agregarFila(numero_orden, tabla){        
        
        
        var fila = '<tr class="seleccionado tabla_fila">';        
        fila += '<td align="center"><a id="'+tabla.id+'" class="btn btn-default btn-xs btn_perfil_empleado" data-toggle="modal" data-target="#myModal">'+numero_orden+'</a></td>';
        fila += '<td>'+tabla.tipo_empleado+'</td>';
        fila += '<td>'+tabla.apellido_paterno+'</td>';
        fila += '<td>'+tabla.apellido_materno+'</td>';
        fila += '<td>'+tabla.nombres+'</td>';
        fila += '<td>'+tabla.dni+'</td>';
        fila += '<td>'+tabla.telefono_fijo+'</td>';
        fila += '<td>'+tabla.telefono_movil+'</td>';
        fila += '<td>'+tabla.email_1+'</td>';        
        fila += '<td align="center"><a id="'+tabla.id+'" class="btn btn-default btn-xs btn_foto_empleado" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-camera"></i></a></td>';
        fila += '<td align="center"><a id="'+tabla.id+'" class="btn btn-default btn-xs btn_modificar_empleado" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-pencil"></i></a></td>';
        fila += '<td align="center"><a id="'+tabla.id+'" class="btn btn-danger btn-xs btn_eliminar_empleado"><i class="glyphicon glyphicon-remove"></i></a></td>';
        
        fila += '</tr>';
        $("#tabla_empleado_id").append(fila);    
    }                
    
</script>    