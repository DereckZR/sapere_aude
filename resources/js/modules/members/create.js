import { apiFetch } from '../../services/api.js';

export function initCreateMember() {
    $('#btnCreate').on('click', async function () {
        const loader = $('#modalLoader');
        try {
            loader.removeClass('d-none');
            const select = $('#admission_cycle_id');
            if (select[0].tomselect) {
                select[0].tomselect.destroy();
            }
            select.empty();


            const url = $(this).data('cycles-url');
            const cycles = await apiFetch(url);

            select.append('<option value="">Seleccione un ciclo</option>');
            cycles.forEach(cycle => {
                select.append(
                    `<option value="${cycle.id}">${cycle.text}</option>`
                );
            });

            new TomSelect('#admission_cycle_id', {
                create: false,
                dropdownParent: 'body'
            });

        } catch (error) {
            toastr.error(error.message);
        } finally {
            loader.addClass('d-none');
        }
    });
};
