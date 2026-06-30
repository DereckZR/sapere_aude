import { apiFetch } from '../../services/api.js';
import { formatDateForInput } from '../../utils/formatDate.js';

export function initEditUser() {
    $(document).on('click', '.btn-edit', async function () {
        const loader = $('#modalLoader');
        const ModalError = $('#modalError');

        try {
            loader.removeClass('d-none');
            ModalError.addClass('d-none');
            const url = $(this).data('url');
            const data = await apiFetch(url);

            $('#document_number').val(data.document_number);
            $('#first_name').val(data.first_name);
            $('#last_name').val(data.last_name);
            $('#career').val(data.career);
            $('#phone_number').val(data.phone_number);
            $('#birth_date').val(
                formatDateForInput(data.birth_date)
            );

            const select = $('#role_id');
            const contenedor = select.closest('.form-group');
            contenedor.addClass('d-none');
            // Si existe un TomSelect, lo destruimos
            if (select[0]?.tomselect) {
                select[0].tomselect.destroy();
            }
            select.empty();


        } catch (error) {
            ModalError.removeClass('d-none');
            toastr.error(error.message);
        } finally {
            loader.addClass('d-none');
        }
    });
}
