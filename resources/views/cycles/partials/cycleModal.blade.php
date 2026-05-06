<div class="modal fade" id="formModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content position-relative">
            {{-- Loader --}}
            <div id="modalLoader" class="d-none modalLoader">
                <div class="text-center">
                    <div class="spinner-border text-primary"></div>
                    <div class="mt-2">Procesando...</div>
                </div>
            </div>

            {{-- Form --}}
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
                        <label for="start_date">Fecha de inicio</label>
                        <input type="date" class="form-control" name="start_date" id="start_date" required>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group">
                        <label for="end_date">Fecha de cierre</label>
                        <input type="date" class="form-control" name="end_date" id="end_date" required>
                        <span class="invalid-feedback"></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
