import { apiFetch } from '../../services/api.js';
import { loadTomSelectOptions } from '../../utils/loadTomSelectOptions.js';

export function initCreateMember() {
    $('#btnCreate').on('click', async function () {
        const loader = $('#modalLoader');
        const ModalError = $('#modalError');

        try {
            loader.removeClass('d-none');
            ModalError.addClass('d-none');

            const url = $(this).data('cycles-url');
            const cycles = await apiFetch(url);

            loadTomSelectOptions({
                selector: '#admission_cycle_id',
                options: cycles,
                placeholder: 'Seleccione el ciclo de ingreso'
            });

            loadTomSelectOptions({
                selector: '#last_active_cycle_id',
                options: cycles,
                placeholder: 'Seleccione el último ciclo activo'
            });

        } catch (error) {
            ModalError.removeClass('d-none');
            toastr.error(error.message);
        } finally {
            loader.addClass('d-none');
        }
    });
};
