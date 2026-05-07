import { formatDate } from '../../utils/formatDate.js';
import { DATATABLE_ES } from '../../utils/DATATABLE_ES.js';
export function initCyclesTable() {
    return $('#mainTable').DataTable({
        processing: true,
        data: [],
        order: [],
        columns: [
            {
                data: null,
                orderable: false,
                title: 'Ciclo',
                render: function (data, type, row, meta) {
                    if (data.deleted_at) {
                        return `<span class="text-muted">Ciclo eliminado</span>`;
                    }

                    const ordinalNames = {
                        1: 'Primer',
                        2: 'Segundo',
                        3: 'Tercer',
                        4: 'Cuarto',
                        5: 'Quinto',
                        6: 'Sexto',
                        7: 'Séptimo',
                        8: 'Octavo',
                        9: 'Noveno',
                        10: 'Décimo'
                    };

                    const cycleNumber = meta.row + 1;

                    const cycleLabel = ordinalNames[cycleNumber]
                        ? `${ordinalNames[cycleNumber]} ciclo`
                        : `${cycleNumber}° Ciclo`;

                    return cycleLabel;
                }

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
