import { fillData } from '../../services/tableService.js';
import { initToggleDeleted } from '../../utils/toggleDeleted.js';
import { initForm } from '../../services/formService.js';
import { initDeleteAction, initRestoreAction, } from '../../services/actionService.js';
import { initTransactionsTable } from './table.js';
import { initCreateTransaction } from './create.js';

$(async function () {
    const dataTable = initTransactionsTable();

    fillData(dataTable);
    initToggleDeleted(() => fillData(dataTable));

    initForm({ reloadTable: () => fillData(dataTable) });

    initCreateTransaction();

    initDeleteAction(() => fillData(dataTable));
    initRestoreAction(() => fillData(dataTable));
});
