import { formatDate } from "../../utils/formatDate.js";
import { DATATABLE_ES } from "../../utils/DATATABLE_ES.js";

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
                title:"Nombre completo"
            },
            // {
            //     data: "document_number",
            //     title: "C.I.",
            //     orderable: false,
            // },
            // {
            //     data: "first_name",
            //     title: "Nombres",
            // },
            // {
            //     data: "last_name",
            //     title: "Apellidos",
            // },
            {
                data: "actions",
                title: "Acciones",
                orderable: false,
                searchable: false,
                render: function (data) {
                    return data.join(" ");
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
