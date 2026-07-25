import { fillData } from '../../services/tableService.js';
import { initLatestTransactionsTable } from './tableLatestTransactions.js';

$(async function () {
    const dataTable = initLatestTransactionsTable();

    fillData(dataTable, "#tableTransactions");
});
