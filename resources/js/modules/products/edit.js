import { apiFetch } from '../../services/api.js';
import { formatDateForInput } from '../../utils/formatDate.js';

export function initEditProduct() {
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
            $('#price').val(data.price);
            $('#stock_quantity').val(data.stock_quantity);
            $('#author_comission_percentage').val(data.author_comission_percentage);

        } catch (error) {
            ModalError.removeClass('d-none');
            toastr.error(error.message);
        } finally {
            loader.addClass('d-none');
        }
    });
}
