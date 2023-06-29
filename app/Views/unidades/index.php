<?= view($header) ?>
<style>
    .derecha_text {
        text-align: right;
    }
    .centro_text {
        text-align: center;
    }
    .is-invalid {
        border-color: #dc3545;
    }
</style>
<h2 style="text-align: center;">Unidades</h2>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <button id="btn-nueva-unidad" class="btn btn-success btn-sm">
                <i class="glyphicon glyphicon-plus"></i>&nbsp;Nueva Unidad
            </button>
        </div>

        <div class="col-md-2">
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Mostrar <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="" onclick="getData(event,'todos')">Todos</a></li>
                    <li><a href="" onclick="getData(event,'activos')">Activos</a></li>
                    <li><a href="" onclick="getData(event,'inactivos')">Inactivos</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-2">
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control form-control-sm" id="unidad" 
                    placeholder="Buscar Unidad">
            <input type="hidden" id="unidad_id" />
        </div>

        <div class="col-md-1">
            <button class="btn btn-default" type="button" id="btn-buscar-unidad" 
                name="btn-buscar-categoria">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </div>
    </div>
    <br>
    <div class="row-fluid">
        <table role="grid" style="height: auto;" id="tabla-unidad" class="table table-bordered table-responsive table-hover">
            <thead>
                <tr>
                    <th>N.</th>
                    <th>Código</th>
                    <th>Unidad</th>
                    <th class="centro_text">Activar</th>
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

<?= view($modal_operacion) ?>

<?= view($footer) ?>

<?= view($script) ?>