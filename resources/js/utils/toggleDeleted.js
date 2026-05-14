// utils/toggleDeleted.js

/*
|--------------------------------------------------------------------------
| initToggleDeleted
| Función para inicializar la funcionalidad de mostrar/ocultar registros eliminados
|--------------------------------------------------------------------------
*/
export function initToggleDeleted(reloadTable) {
    $('#showDeleted').on('change', async function () {
        this.disabled = true;
        await reloadTable();
        this.disabled = false;
    });
}
