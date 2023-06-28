<?= view($header) ?>
<style>    
    .derecha_text { 
        text-align: right; 
    }
    .centro_text { 
        text-align: center; 
    }
    .tamanio_pequenio{
        font-size: 15px;
    }
    .text_capital { 
        text-transform:capitalize; 
    } 
</style>
<h2 align="center">Empleados</h2>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <button id="btn_nueva_empleado" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">Nueva Empleado</button>
            <a class="btn btn-primary btn-sm" id="exportar_entidad"> Reporte Entidades</a>
            <button id="btn_subir_empleado"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Importar Entidades</button>            
        </div>
    
        <div class="col-md-1" >
        </div> 
        <div class="col-md-4">
        </div>   

        <div class="col-md-1" >            
        </div>                   
    </div>
    <br>
    <div class="row-fluid">
        <table role="grid" style="height: auto;" id="tabla_empleado_id" class="table table-bordered table-responsive table-hover">
            <thead>
                <tr>
                    <th>N.</th>
                    <th>Tipo Empleado</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Nombres</th>
                    <th>DNI</th>
                    <th>Teléfono F.</th>
                    <th>Celular</th>
                    <th>Email</th>
                    <th class="centro_text"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></th>
                    <th class="centro_text"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></th>
                    <th class="centro_text"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>                    
                </tr>
            </thead>
            <tbody role="rowgroup">
                
            </tbody>
        </table>
    </div>    
    
    <div id='div_contenedor'>
        <ul id="lista_id_pagination" class="pagination lista_paginacion">
        </ul>
    </div>
</div>
<?= view($footer) ?>
<?= view($script) ?>