import { apiFetch } from '../../services/api.js';
import { handleValidationErrors } from '../../utils/handleValidationErrors.js';

export function initForm({
    form,
    modal,
    reloadTable
}) {
    const loader = $('#modalLoader');

    form.on('submit', async (e) => {
        e.preventDefault();

        const url = form.attr('action');
        const formData = new FormData(form[0]);

        try {
            loader.removeClass('d-none');

            await apiFetch(url, {
                method: 'POST',
                body: formData
            });

            await reloadTable();

            toastr.success('Registrado correctamente');
            modal.modal('hide');
        } catch (error) {
            if (error.status === 422) {
                handleValidationErrors(error.data.errors);
                toastr.error('Por favor, corrige los errores en el formulario');
            }
            else {
                toastr.error(error.message);
                console.log(error.message);
            }
        } finally {
            loader.addClass('d-none');
        }
    });
}
