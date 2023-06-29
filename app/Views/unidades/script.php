<script src="<?PHP echo base_url(); ?>js/monstruo/help.js"></script>
<script type="text/javascript">
    //var base_url = '<?php echo base_url();?>';
    var total_filas = 0;
    var filas_por_pagina = 10;
    var pagina_inicial = 1;
    //let datos_configuracion = JSON.parse(localStorage.getItem("datos_configuracion"));
    //var param_stand_url = datos_configuracion.param_stand_url;
    //var param_stand_url = datos_configuracion.param_stand_url;
    var modal_unidad_id;
    var buscar = "";
    var mostrar_data ="activos";

    carga_inicial();

    $(document).ready(function(){
        //BUSCAR filtros
        //param_unidad_id = ($('#unidad_id').val() == '') ? param_stand_url :  $('#unidad_id').val();
        $('#btn-buscar-unidad').on('click', function(){

            param_unidad_id = $('#unidad_id').val();
            
            $.ajax({
                dataType:'json',
                url: '<?=base_url('wsunidades')?>',
                data: {
                    page: pagina_inicial,
                    paginacion: filas_por_pagina,
                    mostrar: 'todos',
                    unidad_id: param_unidad_id
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
            param_unidad_id = $('#unidad_id').val();

            $('li').removeClass('active');
            $(this).parent().addClass('active');

            pagina = $(this).text();
            pagina_inicial = $(this).text();

            $.ajax({
                dataType:'json',
                url: '<?=base_url('wsunidades')?>',
                data: {
                    page: pagina,
                    paginacion: filas_por_pagina,
                    mostrar:mostrar_data,
                    unidad_id: param_unidad_id
                },
                success: function(data) {
                    $(".tabla_fila").remove();
                    let carga =1;
                    let numero_orden = data.from;
                    (data.data).forEach(function(repo) {
                        agregarFila(numero_orden,repo)
                        numero_orden++;
                    });
                }
            });
        });

        $("#tabla-unidad").on('click', '.btn-modificar-unidad', function(){

            $.ajax({
                dataType:'json',
                url: '<?=base_url('wsunidades/item')?>',
                data: {
                    id: $(this).attr('id')
                },
                success: function(data) {
                    limpiarDatos();
                    $('#modal-unidad').val(data.unidad);
                    $('#modal-codigo').val(data.codigo);
                    $('#modal-unidad-id').val(data.unidad_id);
                    $('#titulo-modal').text('Modificar Unidad');
                    $('#btn-guardar-unidad').text('Modificar');
                    $("#myModal").modal('show');
                }
            })
        });

        $("#tabla-unidad").on('click', '.btn-eliminar-unidad', function() {
            var unidad_id = $(this).attr('id');
            var x = confirm("Desea eliminar la unidad seleccionada?");
            if(x) {
                $.ajax({
                    type:'POST',
                    dataType:'json',
                    url: '<?=base_url('wsunidades/delete-item')?>',
                    data: {
                        id: unidad_id
                    },
                    success: function(data) {
                        if(data.resultado===true)
                        {
                            toast('Success',1500,'Unidad eliminada satisfactoriamente');
                            $(".tabla_fila").remove();
                            $("#lista_id_pagination > li").remove();
                            carga_inicial();
                        }
                    }
                })
            }
        });

        //subir imagen
        $("#tabla_unidad_id").on('click', '.btn_imagen', function(){
            modal_unidad_id = $(this).attr('id');
            $("#myModal").load(base_url + 'index.php/categorias/modal_imagen');
        });

        $("#btn-guardar-unidad").on('click', function(){

            var data = {
                id:$('#modal-unidad-id').val(),
                unidad:$('#modal-unidad').val(),
                codigo:$('#modal-codigo').val(),
                activo:1
            };

            $('.text-danger').remove();

            $.ajax({
                method:'POST',
                url:'<?=base_url('unidades/guardar')?>',
                data: data,
                success:function(data) {
                    if(data.success === true)
                    {
                        $('.text-danger').remove();
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
                            $("input[name='modal-"+key+"']").closest('.col-md-10')
                            .append('<small class="text-danger">' + value + '</small>');
                        });
                    }
                }
            })
        });
    });

    $("#btn-nueva-unidad").click(function() {
        $('.text-danger').remove();
        limpiarDatos();
        $('#titulo-modal').html('Registrar Unidad');
        $("#myModal").modal('show');
    });


    function limpiarDatos()  {
        $('.text-danger').remove();
        $('#modal-unidad').val("");
        $('#modal-codigo').val("");
        $('#modal-unidad-id').val("");
    }

    $('#unidad').autocomplete({
        minLength: 1,
        source: function(request, response){
            $.ajax({
                url:'<?=base_url('wsunidades/buscar')?>',
                type:'GET',
                data:request,
                success: function(data) {
                    //console.log(data)
                    response($.map(JSON.parse(data),function(el){
                        return {
                            id: el.id,
                            value: el.unidad
                        }
                    }));
                }
            })
        },
        select: function (event, ui) {
            $('#unidad_id').val(ui.item.id);
        }
    });

    function carga_inicial(){
        param_unidad_id = $('#unidad_id').val();
        pagina_inicial = 1;
        //getData('activos');
        $.ajax({
            dataType:'json',
            url: '<?=base_url('wsunidades')?>',
            data: {
                page: pagina_inicial,
                paginacion: filas_por_pagina,
                mostrar:'activos',
                unidad_id: param_unidad_id
            },
            success: function(data) {
                let carga =1;
                //js/mostruo/help.js
                construir_paginacion(data.total_filas,filas_por_pagina,carga)
                //$('#div_contenedor2').html(data.pager)
                let numero_orden = data.from;
                (data.data).forEach(function(repo) {
                    agregarFila(numero_orden,repo)
                    numero_orden++;
                });
            }
        })
    }

    function agregarFila(numero_orden, tabla)
    {
        if(tabla.activo == 1){
            color = 'alert-success';
            texto_unidad = 'Activo';
        }
        if(tabla.activo == 0){
            color = 'alert-default';
            texto_unidad = 'Inactivo';
        }

        var fila = '<tr class="seleccionado tabla_fila">';
        fila += '<td align="center">'+numero_orden+'</td>';
        fila += '<td>'+(tabla.codigo == null ? "" : tabla.codigo ) +'</td>';
        fila += '<td>'+tabla.unidad+'</td>';
        fila += '<td align="center"><span data-activo="' + tabla.activo + '" id="' + tabla.id + '" class="badge ' + color + ' btn_activar">' + texto_unidad + '</span></td>';
        if(tabla.activo == 1){
            fila += '<td align="center"><a id="'+tabla.id+'" class="btn btn-default btn-xs btn-modificar-unidad"><i class="glyphicon glyphicon-pencil"></i></a></td>';
            fila += '<td align="center"><a id="'+tabla.id+'" class="btn btn-danger btn-xs btn-eliminar-unidad"><i class="glyphicon glyphicon-remove"></i></a></td>';
        } else {
            fila += '<td></td>';
            fila += '<td align="center"><a id="'+tabla.id+'" class="btn btn-danger btn-xs btn-eliminar-unidad"><i class="glyphicon glyphicon-remove"></i></a></td>';
        }
        fila += '</tr>';
        
        $("#tabla-unidad").append(fila);
    }

    function getData(e,mostrar='activos')
    {
        e.preventDefault();
        param_unidad_id = $('#unidad_id').val();
        mostrar_data = mostrar;
        pagina_inicial = 1;

        $.ajax({
            dataType:'json',
            url: '<?=base_url('wsunidades')?>',
            data: {
                page: pagina_inicial,
                paginacion: filas_por_pagina,
                mostrar:mostrar,
                unidad_id: param_unidad_id
            },
            success: function(data) {
                $(".tabla_fila").remove();
                $("#lista_id_pagination > li").remove();
                let carga =1;
                //js/mostruo/help.js
                construir_paginacion(data.total_filas,filas_por_pagina,carga)
                //$('#div_contenedor2').html(data.pager)
                let numero_orden = data.from;
                (data.data).forEach(function(repo) {
                    agregarFila(numero_orden,repo)
                    numero_orden++;
                });
            }
        });
    }

</script>