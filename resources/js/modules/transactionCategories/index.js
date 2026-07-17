import { fillData } from '../../services/tableService.js';
import { initTransactionCategoriesTable } from './table.js';
import { initToggleDeleted } from '../../utils/toggleDeleted.js';
import { initForm } from '../../services/formService.js';
import { initDeleteAction, initRestoreAction, } from '../../services/actionService.js';
import { initCreateTransactionCategory } from './create.js';
import { initEditTransactionCategory } from './edit.js';

$(async function () {
    const dataTable = initTransactionCategoriesTable();

    fillData(dataTable);
    initToggleDeleted(() => fillData(dataTable));

    initForm({ reloadTable: () => fillData(dataTable) });

    initCreateTransactionCategory();
    initEditTransactionCategory();

    initDeleteAction(() => fillData(dataTable));
    initRestoreAction(() => fillData(dataTable));
});
