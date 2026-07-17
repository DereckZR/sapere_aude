import { apiFetch } from '../../services/api.js';
import { loadTomSelectOptions } from '../../utils/loadTomSelectOptions.js';

export function initCreateTransaction() {
    $('#btnCreate').on('click', async function () {
        const loader = $('#modalLoader');
        const ModalError = $('#modalError');

        try {
            loader.removeClass('d-none');
            ModalError.addClass('d-none');

            const selectIsCash = $('#is_cash');

            const IsCashOptions = [
                { id: 1, text: 'Si' },
                { id: 0, text: 'No' }
            ];

            loadTomSelectOptions({
                selector: '#is_cash',
                options: IsCashOptions,
                placeholder: 'Seleccione si es efectivo'
            });

            const urls = [
                $(this).data('cycles-url'),
                $(this).data('transaction-categories-url'),
                $(this).data('members-url'),
            ];

            await Promise.all(urls.map(url => apiFetch(url)))
                .then(([cycles, transactionCategories, members]) => {
                    loadTomSelectOptions({
                        selector: '#cycle_id',
                        options: cycles,
                        placeholder: 'Seleccione el ciclo de ingreso'
                    });

                    loadTomSelectOptions({
                        selector: '#transaction_category_id',
                        options: transactionCategories,
                        placeholder: 'Seleccione la categoría de transacción'
                    });

                    loadTomSelectOptions({
                        selector: '#responsible_member_id',
                        options: members,
                        placeholder: 'Seleccione el miembro'
                    });
                })
                .catch(error => {
                    ModalError.removeClass('d-none');
                    toastr.error(error.message);
                });

        } catch (error) {
            ModalError.removeClass('d-none');
            toastr.error(error.message);
        } finally {
            loader.addClass('d-none');
        }
    });
}
