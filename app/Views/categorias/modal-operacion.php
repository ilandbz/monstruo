<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="titulo-modal">Registrar Categor&iacute;a</h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="modal_categoria_id"/>
                    <div class="form-group row">
                        <label for="modal_categoria" class="col-md-2">Categoria</label>
                        <div class="col-md-8">
                            <input type="text" id="modal_categoria" name="modal_categoria" class="form-control input-sm">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="modal_codigo" class="col-md-2">Código</label>
                        <div class="col-md-8">
                            <input type="text" id="modal_codigo" name="modal_codigo" class="form-control input-sm">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="glyphicon glyphicon-remove"></i> Cerrar
                </button>
                <button type="button" class="btn btn-primary" id="btn_guardar_categoria">
                    <i class="glyphicon glyphicon-floppy-disk"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>