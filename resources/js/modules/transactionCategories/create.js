import { MovementType } from '../../enums/movementType.js';
import { apiFetch } from '../../services/api.js';
import { loadTomSelectOptions } from '../../utils/loadTomSelectOptions.js';

export function initCreateTransactionCategory() {
    $('#btnCreate').on('click', function () {
        const loader = $('#modalLoader');
        const ModalError = $('#modalError');
        try {
            loader.removeClass('d-none');
            ModalError.addClass('d-none');

            const select = $('#type');
            select.prop('required', true);


            const types = [
                { id: MovementType.IN, text: 'Ingreso' },
                { id: MovementType.OUT, text: 'Egreso' }
            ];

            loadTomSelectOptions({
                selector: '#type',
                options: types,
                placeholder: 'Seleccione el tipo de transacción'
            });

        } catch (error) {
            ModalError.removeClass('d-none');
            toastr.error(error.message);
        } finally {
            loader.addClass('d-none');
        }
    });
}
