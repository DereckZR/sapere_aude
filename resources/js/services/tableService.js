import { apiFetch } from './api.js';

export async function fillData(dataTable, tableSelector = '#mainTable') {

    try {
        const table = $(tableSelector);

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
