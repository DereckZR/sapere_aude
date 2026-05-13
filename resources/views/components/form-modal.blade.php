<div class="modal fade" id="formModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content position-relative">
            {{-- Loader --}}
            <div id="modalLoader" class="d-none modalOverlay modalLoader">
                <div class="text-center">
                    <div class="spinner-border text-primary"></div>
                    <div class="mt-2">Procesando...</div>
                </div>
            </div>

            {{-- Error Message --}}
            <div id="modalError" class="d-none modalOverlay modalError">
                <div class="text-center">
                    <i class="fas fa-times-circle text-danger fa-2x"></i>
                    <div class="mt-2">Ocurrió un error. Por favor, intente nuevamente.</div>
                </div>
            </div>

            {{-- Form --}}
            <form method="POST" data-createUrl="{{ $createUrl }}" data-updateUrl="{{ $updateUrl }}">
                @csrf
                <input type="hidden" name="_method" id="formMethod">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <span id="modalTitle"></span> {{ $title }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    {{ $slot }}
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
