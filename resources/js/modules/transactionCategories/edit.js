import { apiFetch } from '../../services/api.js';

export function initEditTransactionCategory() {
    $(document).on('click', '.btn-edit', async function () {
        const loader = $('#modalLoader');
        const ModalError = $('#modalError');

        try {
            loader.removeClass('d-none');
            ModalError.addClass('d-none');

            const url = $(this).data('url');
            const data = await apiFetch(url);

            $('#name').val(data.name);
            $('#description').val(data.description);

            const select = $('#type');
            const contenedor = select.closest('.form-group');

            contenedor.addClass('d-none');
            select.prop('required', false);

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
