<div class="modal fade" id="formModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" data-createUrl="{{ route('cycles.store') }}"
                data-updateUrl="{{ route('cycles.update', ['id' => ':id']) }}">
                @csrf
                <input type="hidden" name="_method" id="formMethod">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <span id="modalTitle"></span> Ciclo
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Fecha de inicio</label>
                        <input type="date" class="form-control" name="start_date" id="start_date" required>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group">
                        <label>Fecha de cierre</label>
                        <input type="date" class="form-control" name="end_date" id="end_date" required>
                        <span class="invalid-feedback"></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn"></button>
                </div>
            </form>
        </div>
    </div>
</div>
