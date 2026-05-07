import { apiFetch } from '../../services/api.js';
import { confirmAction } from '../../services/swal.js';

export function initRestoreCycle(reloadTable) {
    $(document).on('click', '.btn-restore', async function () {
        const url = $(this).data('url');
        const result = await confirmAction(
            'Se va a restaurar el registro'
        );

        if (!result.isConfirmed) {
            return;
        }

        try {
            await apiFetch(url, {
                method: 'PATCH',
            });
            await reloadTable();
            toastr.success('Restaurado correctamente');
        } catch (error) {
            toastr.error(error.message);
        }
    });
}
