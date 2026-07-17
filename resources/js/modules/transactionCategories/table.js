import { formatDate } from '../../utils/formatDate.js';
import { DATATABLE_ES } from '../../utils/DATATABLE_ES.js';
import { renderTableActions } from '../../utils/renderTableActions.js';
import { MovementType } from '../../enums/movementType.js';

export function initTransactionCategoriesTable() {
    return $('#mainTable').DataTable({
        processing: true,
        data: [],
        order: [],
        autoWidth: false,
        columns: [
            {
                data: 'name',
                title: 'Nombre',
            },
            {
                data: 'description',
                title: 'Descripción',
                orderable: false,
            },
            {
                data: 'type',
                title: 'Tipo',
                render: function (data) {
                    if (data === MovementType.IN) {
                        return 'Ingreso';
                    } else if (data === MovementType.OUT) {
                        return 'Egreso';
                    } else {
                        return data;
                    }
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
                    const isProtected = data.is_protected;
                    const actions = renderTableActions(routes, id,
                        {
                            canEdit: (data.deleted_at ? false : true) && !isProtected,
                            canDelete: (data.deleted_at ? false : true) && !isProtected,
                            canRestore: data.deleted_at ? true : false
                        },
                        {}
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
