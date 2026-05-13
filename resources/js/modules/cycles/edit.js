import { apiFetch } from '../../services/api.js';
import { formatDateForInput } from '../../utils/formatDate.js';

export function initEditCycle() {
    $(document).on('click', '.btn-edit', async function () {
        const loader = $('#modalLoader');
        const ModalError = $('#modalError');
        try {
            loader.removeClass('d-none');
            ModalError.addClass('d-none');
            const url = $(this).data('url');
            const data = await apiFetch(url);

            $('#start_date').val(
                formatDateForInput(data.start_date)
            );

            $('#end_date').val(
                formatDateForInput(data.end_date)
            );

        } catch (error) {
            ModalError.removeClass('d-none');
            toastr.error(error.message);
        } finally {
            loader.addClass('d-none');
        }
    });
}
