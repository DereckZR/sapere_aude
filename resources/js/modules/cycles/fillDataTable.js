import { apiFetch } from '../../services/api.js';

export async function fillDataTable(dataTable) {
    try {
        const table = $('#cyclesTable');

        dataTable.processing(true);

        const showDeleted = $('#showDeleted').is(':checked');

        const url = showDeleted
            ? table.data('deleted-url')
            : table.data('url');

        const data = await apiFetch(url);

        // cargar datos dinámicamente
        dataTable.clear();
        dataTable.rows.add(data);
        dataTable.draw();

    } catch (error) {
        console.error(error);
    } finally {
        dataTable.processing(false);
    }
}
