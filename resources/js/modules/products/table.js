import { formatDate } from '../../utils/formatDate.js';
import { DATATABLE_ES } from '../../utils/DATATABLE_ES.js';
import { renderTableActions } from '../../utils/renderTableActions.js';

export function initProductsTable() {
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
                data: 'price',
                title: 'Precio',
            },
            {
                data: 'stock_quantity',
                title: 'Stock',
                orderable: false,
            },
            {
                data: 'author_comission_percentage',
                title: 'Comisión del autor (%)',
                orderable: false,
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
                            canShow: data.deleted_at ? false : true,
                            canEdit: data.deleted_at ? false : true,
                            canDelete: data.deleted_at ? false : true,
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
