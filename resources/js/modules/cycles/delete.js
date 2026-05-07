import { apiFetch } from '../../services/api.js';
import { confirmAction } from '../../services/swal.js';

export function initDeleteCycle(reloadTable) {
    $(document).on('click', '.btn-delete', async function () {
        const url = $(this).data('url');
        const result = await confirmAction(
            'Se va a eliminar el registro'
        );

        if (!result.isConfirmed) {
            return;
        }

        try {
            await apiFetch(url, {
                method: 'DELETE',
            });
            await reloadTable();
            toastr.success('Eliminado correctamente');
        } catch (error) {
            toastr.error(error.message);
        }
    });
}
