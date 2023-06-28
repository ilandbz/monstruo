<script src="<?PHP echo base_url(); ?>js/monstruo/help.js"></script>
<script type="text/javascript"> 
    //var base_url = '<?php echo base_url();?>';
    var total_filas = 0;
    var filas_por_pagina = 10;
    var pagina_inicial = 1;
    //let datos_configuracion = JSON.parse(localStorage.getItem("datos_configuracion"));
    //var param_stand_url = datos_configuracion.param_stand_url;
    //var param_stand_url = datos_configuracion.param_stand_url;
    var modal_categoria_id;
    var buscar = "";

    carga_inicial();

    $(document).ready(function(){
        //BUSCAR filtros
        //param_categoria_id = ($('#categoria_id').val() == '') ? param_stand_url :  $('#categoria_id').val();
        $('#btn_buscar_categoria').on('click', function(){

            param_categoria_id = $('#categoria_id').val();

            $.ajax({
                dataType:'json',
                url: '<?=base_url('wscategorias/todos')?>',
                data: {
                    page: pagina_inicial,
                    paginacion: filas_por_pagina,
                    categoria_id: param_categoria_id
                },
                success: function(data) {

                    $(".tabla_fila").remove();
                    $("#lista_id_pagination > li").remove();
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

            $.ajax({
                dataType:'json',
                url: '<?=base_url('wscategorias/item')?>',
                data: {
                    id: $(this).attr('id')
                },
                success: function(data) {
                    limpiarDatos();
                    $('#modal_categoria').val(data.categoria);
                    $('#modal_codigo').val(data.codigo);
                    $('#modal_categoria_id').val(data.categoria_id);
                    $('#titulo-modal').text('Modificar Categoria');
                    $('#btn_guardar_categoria').text('Modificar');
                    $("#myModal").modal('show');                    
                }
            })                 
        });
        
        $("#tabla_categoria_id").on('click', '.btn_eliminar_categoria', function() {            
            var categoria_id = $(this).attr('id');            
            var x = confirm("Desea eliminar esta categoria:");
            if(x) {
                $.ajax({
                    type:'POST',
                    dataType:'json',
                    url: '<?=base_url('wscategorias/deleteItem')?>',
                    data: {
                        id: categoria_id
                    },
                    success: function(data) {
                        if(data.resultado===true)
                        {
                            toast('Success',1500,'Categoría eliminada satisfactoriamente');
                            $(".tabla_fila").remove();
                            $("#lista_id_pagination > li").remove();
                            carga_inicial();
                        }
                    }
                })
            }
        });
        
        //subir imagen
        $("#tabla_categoria_id").on('click', '.btn_imagen', function(){
            modal_categoria_id = $(this).attr('id');
            $("#myModal").load(base_url + 'index.php/categorias/modal_imagen');
        });

        $("#btn_guardar_categoria").on('click', function(){

            var data = {
                id:$('#modal_categoria_id').val(),
                categoria:$('#modal_categoria').val(),
                codigo:$('#modal_codigo').val(),
            };

            $('.alert-danger').remove();

            $.ajax({    
                method:'POST',
                url:'<?=base_url('categorias/guardar')?>',
                data: data,
                success:function(data) {
                    if(data.success === true)
                    {
                        $('.alert-danger').remove();
                        toast('Success',1500,data.message);
                        $("#myModal").modal('hide');

                        $(".tabla_fila").remove();
                        $("#lista_id_pagination > li").remove();
                        carga_inicial();
                    }
                },
                error: function(xhr) {
                    let res = xhr.responseJSON
                    if($.isEmptyObject(res) === false) {
                        $.each(res.errors,function (key, value){
                            $("input[name='"+key+"']").closest('.col-md-8')
                            .append('<small class="alert-danger">' + value + '</small>');
                        });
                    }
                }
            })             
        });
    });

    $("#btn_nueva_categoria").click(function() {
        $('.alert-danger').remove();
        limpiarDatos();
        $('#titulo-modal').html('Registrar Categoría');
        $("#myModal").modal('show');
    }); 


    function limpiarDatos()  {
        $('.alert-danger').remove();
        $('#modal_categoria').val("");
        $('#modal_codigo').val("");
        $('#modal_categoria_id').val("");
    }

    $('#categoria').autocomplete({
        minLength: 1,
        source: function(request, response){
            $.ajax({
                url:'<?=base_url('wscategorias/buscar')?>',
                type:'GET',
                data:request,
                success: function(data) {
                    //console.log(data)
                    response($.map(JSON.parse(data),function(el){
                        return {
                            id: el.id,
                            value: el.value
                        }
                    }));
                }
            })
        },            
        select: function (event, ui) {
            $('#categoria_id').val(ui.item.id);
        }
    });

    function carga_inicial(){      
        param_categoria_id = $('#categoria_id').val();  
        $.ajax({
            dataType:'json',
            url: '<?=base_url('wscategorias/todos')?>',
            data: {
                page: pagina_inicial,
                paginacion: filas_por_pagina,
                categoria_id: param_categoria_id
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
        fila += '<td align="center">'+numero_orden+'</td>';
        fila += '<td>'+(tabla.codigo == null ? "" : tabla.codigo ) +'</td>';        
        fila += '<td>'+tabla.categoria+'</td>';        
        fila += '<td align="center"><a id="'+tabla.id+'" class="btn btn-default btn-xs btn_imagen" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-camera"></i></a></td>';
        if(tabla.id != 1){
            fila += '<td align="center"><a id="'+tabla.id+'" class="btn btn-default btn-xs btn_modificar_categoria"><i class="glyphicon glyphicon-pencil"></i></a></td>';
            fila += '<td align="center"><a id="'+tabla.id+'" class="btn btn-danger btn-xs btn_eliminar_categoria"><i class="glyphicon glyphicon-remove"></i></a></td>';
        }
                
        fila += '</tr>';
        $("#tabla_categoria_id").append(fila);    
    }

</script>