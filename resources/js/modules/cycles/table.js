import { formatDate } from '../../utils/formatDate.js';
import { DATATABLE_ES } from '../../utils/DATATABLE_ES.js';
export function initCyclesTable() {

    return $('#cyclesTable').DataTable({
        processing: true,
        data: [],
        columns: [
            {
                data: 'id',
                title: '#'
            },
            {
                data: 'start_date',
                title: 'Fecha de inicio',
                render: function (data) {
                    return formatDate(data);
                }
            },
            {
                data: 'end_date',
                title: 'Fecha de cierre',
                render: function (data) {
                    return formatDate(data);
                }
            },
            {
                data: 'actions',
                title: 'Acciones',
                orderable: false,
                searchable: false,
                render: function (data) {
                    return data.join(' ');
                }
            }
        ],
        createdRow: function (row, data) {
            if (data.deleted_at) {
                $(row).addClass('table-deleted');
            }
        },
        language: DATATABLE_ES
    });
}
