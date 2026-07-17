import { apiFetch } from '../../services/api.js';
import { formatDateForInput } from '../../utils/formatDate.js';

export function initCreateProduct() {
    $('#btnCreate').on('click', async function () {
        const loader = $('#modalLoader');
        const ModalError = $('#modalError');

        try {
            loader.removeClass('d-none');
            ModalError.addClass('d-none');

            const input = $('#stock_quantity');
            const contenedor = input.closest('.form-group');
            contenedor.removeClass('d-none');
            input.prop('required', true);

        } catch (error) {
            ModalError.removeClass('d-none');
            toastr.error(error.message);
        } finally {
            loader.addClass('d-none');
        }
    });
}
