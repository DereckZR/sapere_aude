import { formatDate } from '../../utils/formatDate.js';
import { DATATABLE_ES } from '../../utils/DATATABLE_ES.js';

export function initMembersTable() {
    return $('#mainTable').DataTable({
        processing: true,
        data: [],
        columns: [
            {
                data: 'id',
                title: '#'
            },
            {
                data: 'name',
                title: 'Nombre',
            },
            {
                data: 'last_name',
                title: 'Apellido',
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
