import { apiFetch } from './api.js';
import { confirmAction } from './swal.js';

export function initDeleteAction(reloadTable) {
    initAction({
        selector: '.btn-delete',
        method: 'DELETE',
        confirmText: '¿Estás seguro de que deseas eliminar este registro?',
        successText: 'Eliminado correctamente',
        reloadTable
    });
}

export function initRestoreAction(reloadTable) {
    initAction({
        selector: '.btn-restore',
        method: 'PATCH',
        confirmText: '¿Estás seguro de que deseas restaurar este registro?',
        successText: 'Restaurado correctamente',
        reloadTable
    });
}

export function initAction({
    selector,
    method,
    confirmText,
    successText,
    reloadTable
}) {
    $(document).on('click', selector, async function () {
        const url = $(this).data('url');

        const result = await confirmAction(confirmText);

        if (!result.isConfirmed) {
            return;
        }

        try {
            await apiFetch(url, {
                method,
            });

            await reloadTable();

            toastr.success(successText);
        } catch (error) {
            toastr.error(error.message);
        }
    });
}
