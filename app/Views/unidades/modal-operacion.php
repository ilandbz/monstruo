<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="titulo-modal">Registrar Unidad</h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="modal-unidad-id"/>
                    <div class="form-group row">
                        <label for="modal-codigo" class="col-md-2">Código</label>
                        <div class="col-md-10">
                            <input type="text" id="modal-codigo" name="modal-codigo" class="form-control input-sm">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="modal-unidad" class="col-md-2">Unidad</label>
                        <div class="col-md-10">
                            <input type="text" id="modal-unidad" name="modal-unidad" class="form-control input-sm">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="glyphicon glyphicon-remove"></i> Cerrar
                </button>
                <button type="button" class="btn btn-primary" id="btn-guardar-unidad">
                    <i class="glyphicon glyphicon-floppy-disk"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>