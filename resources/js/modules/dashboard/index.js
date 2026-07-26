import { fillData } from "../../services/tableService.js";
import { initLatestTransactionsTable } from "./tableLatestTransactions.js";
import { initForm } from "../../services/formService.js";
import { initCreateTransaction } from "../transactions/create.js";

$(async function () {
    const dataTable = initLatestTransactionsTable();
    const idTable = "#tableTransactions";

    fillData(dataTable, idTable);

    initForm({ reloadTable: () => fillData(dataTable, idTable) });

    initCreateTransaction();
});
