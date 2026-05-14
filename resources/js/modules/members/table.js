import { formatDate } from '../../utils/formatDate.js';
import { DATATABLE_ES } from '../../utils/DATATABLE_ES.js';

export function initMembersTable() {
    return $('#mainTable').DataTable({
        processing: true,
        data: [],
        order: [],
        columns: [
            {
                data: 'id',
                title: '#'
            },
            {
                data: 'first_name',
                title: 'Nombres',
            },
            {
                data: 'last_name',
                title: 'Apellidos',
            },
            {
                data: 'career',
                title: 'Carrera',
            },
            {
                data: 'phone_number',
                title: 'Teléfono',
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
