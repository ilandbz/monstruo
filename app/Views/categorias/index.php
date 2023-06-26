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
<h2 class="centro_text " >Categor&iacute;as</h2>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <button id="btn_nueva_categoria" class="btn btn-success btn-sm" >
                <i class="glyphicon glyphicon-plus"></i>&nbsp;Nueva Categoria
            </button>
        </div>

        <div class="col-md-1" >
        </div> 
        <div class="col-md-2" >        
        </div> 
        <div class="col-md-4">
            <input type="text" class="form-control form-control-sm" id="categoria" placeholder="Buscar categoria">
            <input type="hidden" id="categoria_id" />
        </div>   

        <div class="col-md-1" >
            <button class="btn btn-default" type="button" id="btn_buscar_categoria" name="btn_buscar_categoria"><span class="glyphicon glyphicon-search"></span></button>   
        </div>                   
    </div>
    <br>
    <div class="row-fluid">
        <table role="grid" style="height: auto;" id="tabla_categoria_id" class="table table-bordered table-responsive table-hover">
            <thead>
                <tr>
                    <th>N.</th>
                    <th>Código</th>
                    <th>Categoria</th>
                    <th class="centro_text"><span class="glyphicon glyphicon-camera" aria-hidden="true"></span></th>
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