import { formatDatetime, formatDate } from "../../utils/formatDate.js";
import { DATATABLE_ES } from "../../utils/DATATABLE_ES.js";
import { renderTableActions } from "../../utils/renderTableActions.js";
import { MovementType } from "../../enums/movementType.js";

export function initLatestTransactionsTable() {
    return $("#tableTransactions").DataTable({
        processing: true,
        data: [],
        order: [],
        autoWidth: false,
        searching: false,
        paging: false,
        info: false,
        lengthChange: false,
        columns: [
            {
                data: "transaction_category.name",
                title: "Categoría",
            },
            {
                data: "transaction_category.type",
                title: "Tipo",
                render: function (data) {
                    if (data === MovementType.IN) {
                        return "Ingreso";
                    } else if (data === MovementType.OUT) {
                        return "Egreso";
                    } else {
                        return data;
                    }
                },
            },
            {
                data: "responsible_member",
                title: "Responsable",
                render: function (data) {
                    return `${data.first_name} ${data.last_name}`;
                },
            },
            {
                data: "amount",
                title: "Monto (Bs)",
            },
            {
                data: "transaction_date",
                title: "Fecha de la transacción",
                render: function (data) {
                    return formatDate(data);
                },
            },
            {
                data: "created_at",
                title: "Fecha y hora de registro",
                render: function (data) {
                    return formatDatetime(data);
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
