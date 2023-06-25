<script src="<?PHP echo base_url(); ?>js/monstruo/help.js"></script>
<script type="text/javascript"> 
    //var base_url = '<?php echo base_url();?>';
    var total_filas = 0;
    var filas_por_pagina = 10;
    var pagina_inicial = 1;
    // let datos_configuracion = JSON.parse(localStorage.getItem("datos_configuracion"));
    // var param_stand_url = datos_configuracion.param_stand_url;
    var modal_categoria_id;
    var buscar = "";

    carga_inicial();

    $(document).ready(function(){
        //BUSCAR filtros
        $('#btn_buscar_categoria').on('click', function(){
            // pagina = 1; //
            // param_categoria_id = ($('#categoria_id').val() == '') ? param_stand_url :  $('#categoria_id').val();
            // $("#tabla_categoria_id > tbody").remove();

            // var ruta_url = base_url + 'index.php/WS_categorias/ws_select/' + pagina + '/' + filas_por_pagina + '/' + param_categoria_id;               
            // console.log(ruta_url);
            // $.getJSON(ruta_url)
            //     .done(function (data) {
            //         console.log(data);
            //         carga = 1;//se usa para activar la pagina N. 1
            //         total_filas = data.total_filas;
            //         $("#lista_id_pagination > li").remove();
            //         construir_paginacion(total_filas, filas_por_pagina, carga)
                    
            //         var numero_orden = filas_por_pagina*(pagina-1)+1;                    
            //         (data.ws_select_categorias).forEach(function (repo) {
            //             agregarFila(numero_orden, repo.codigo, repo.categoria, repo.categoria_id);
            //             numero_orden ++;
            //         });
            // });
        });
        
        //PAGINACION
        $('#div_contenedor').on('click', '.pajaro', function(){
            param_categoria_id = ($('#categoria_id').val() == '') ? param_stand_url :  $('#categoria_id').val();
            
            $('li').removeClass('active');
            $(this).parent().addClass('active');
                        
            pagina = $(this).text();
            $("#tabla_categoria_id > tbody").remove();

            var url_l = base_url + 'index.php/WS_categorias/ws_select/' + pagina + '/' + filas_por_pagina + '/' + param_categoria_id;            
            $.getJSON(url_l)
                .done(function (data) {

                    total_filas = data.total_filas; 
                    var numero_orden = filas_por_pagina*(pagina-1)+1;
                    (data.ws_select_categorias).forEach(function (repo) {                                                
                        agregarFila(numero_orden, repo.codigo, repo.categoria, repo.categoria_id);
                        numero_orden ++;
                    });
            });            
        });                                                                
        
        $("#tabla_categoria_id").on('click', '.btn_modificar_categoria', function(){
            var categoria_id = $(this).attr('id');
            ruta_url = base_url + 'index.php/categorias/modal_operacion/';
            $("#myModal").load(ruta_url);                                    

            ruta_url_item = base_url + 'index.php/WS_categorias/select_item/' + categoria_id;
            $.getJSON(ruta_url_item)
                    .done(function (data){                        
                        $('#modal_categoria').val(data[0].categoria);
                        $('#modal_codigo').val(data[0].codigo);
                        $('#modal_categoria_id').val(categoria_id);
                        $('#titulo_modal').text('Modificar Categoria');
                        $('#btn_guardar_categoria').text('Modificar');
                    })                        
        });
        
        $("#tabla_categoria_id").on('click', '.btn_eliminar_categoria', function(){            
            var categoria_id = $(this).attr('id');            
            var x = confirm("Desea eliminar esta categoria:");
            if (x){ 
                ruta_url_item = base_url + 'index.php/WS_categorias/delete_item/' + categoria_id;
                $.getJSON(ruta_url_item)
                        .done(function (data){
                            console.log('elimiación correcta' + data);
                        });
                        
    //                var parent = $(this).parent("td").parent("tr");
    //                parent.fadeOut('slow'); //Borra la fila afectada                
                $("#tabla_categoria_id > tbody").remove();
                $("#lista_id_pagination > li").remove();
                carga_inicial();
            }
        });
        
        //subir imagen
        $("#tabla_categoria_id").on('click', '.btn_imagen', function(){
            modal_categoria_id = $(this).attr('id');
            $("#myModal").load(base_url + 'index.php/categorias/modal_imagen');
        });
    });

    $("#btn_nueva_categoria").click(function(){
        $("#myModal").load('<?php echo base_url()?>index.php/categorias/modal_operacion');
    }); 

    $('#categoria').autocomplete({
        source: base_url + 'index.php/WS_categorias/buscador_categoria',
        minLength: 2,
        select: function (event, ui) {
            $('#categoria_id').val(ui.item.id);
        }
    });


    function carga_inicial(){
        //CARGA INICIAL

        $.ajax({
            dataType:'json',
            url: '<?=base_url('wscategorias/todos')?>',
            data: {
                page: pagina_inicial,
                paginacion: filas_por_pagina,
                buscar: buscar
            },
            success: function(data) {
                console.log(data)
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
        fila += '<td align="center">'+numero_orden+'</td>';
        fila += '<td>'+(tabla.codigo == null ? "" : tabla.codigo ) +'</td>';        
        fila += '<td>'+tabla.categoria+'</td>';        
        fila += '<td align="center"><a id="'+tabla.id+'" class="btn btn-default btn-xs btn_imagen" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-camera"></i></a></td>';
        if(tabla.id != 1){
            fila += '<td align="center"><a id="'+tabla.id+'" class="btn btn-default btn-xs btn_modificar_categoria" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-pencil"></i></a></td>';
            fila += '<td align="center"><a id="'+tabla.id+'" class="btn btn-danger btn-xs btn_eliminar_categoria"><i class="glyphicon glyphicon-remove"></i></a></td>';
        }
                
        fila += '</tr>';
        $("#tabla_categoria_id").append(fila);    
    }

</script>