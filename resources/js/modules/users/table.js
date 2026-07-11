import { formatDate } from "../../utils/formatDate.js";
import { DATATABLE_ES } from "../../utils/DATATABLE_ES.js";
import { renderTableActions } from '../../utils/renderTableActions.js';

export function initUsersTable() {
    return $("#mainTable").DataTable({
        processing: true,
        data: [],
        order: [],
        columns: [
            {
                data: "username",
                title: "Usuario",
                orderable: false,
            },
            {
                data: "role_name",
                title: "Rol",
            },
            {
                data: "full_name",
                title: "Nombre completo"
            },
            {
                data: null,
                title: "Acciones",
                orderable: false,
                searchable: false,
                render: function (data) {
                    const routes = $('#mainTable').data()
                    const id = data.id;
                    const actions = renderTableActions(routes, id,
                        {
                            canShow: true,
                            canEdit: data.deleted_at ? false : true,
                            canDelete: data.deleted_at ? false : true,
                            canRestore: data.deleted_at ? true : false
                        },
                        {
                            show: 'Perfil',
                        }
                    );
                    return actions
                        .map(action => $(action).prop('outerHTML'))
                        .join(' ');
                },
            },
        ],
        createdRow: function (row, data) {
            if (data.deleted_at) {
                $(row).addClass("table-deleted");
            }
        },
        language: DATATABLE_ES,
    });
}
