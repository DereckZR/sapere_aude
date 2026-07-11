import { formatDate } from '../../utils/formatDate.js';
import { DATATABLE_ES } from '../../utils/DATATABLE_ES.js';
import { getCycleLabel } from '../../utils/getCycleLabel.js';
import { renderTableActions, ActionType } from '../../utils/renderTableActions.js';

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
                    return getCycleLabel(data, meta);
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
                data: null,
                title: 'Acciones',
                orderable: false,
                searchable: false,
                render: function (data) {
                    const routes = $('#mainTable').data()
                    const id = data.id;
                    const actions = renderTableActions(routes, id,
                        {
                            canShow: false,
                            canEdit: data.deleted_at ? false : true,
                            canDelete: data.deleted_at ? false : true,
                            canRestore: data.deleted_at ? true : false
                        }
                    );
                    return actions
                        .map(action => $(action).prop('outerHTML'))
                        .join(' ');
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
