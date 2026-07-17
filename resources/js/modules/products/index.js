import { fillData } from '../../services/tableService.js';
import { initProductsTable } from './table.js';
import { initCreateProduct } from './create.js';
import { initEditProduct } from './edit.js';
import { initToggleDeleted } from '../../utils/toggleDeleted.js';
import { initForm } from '../../services/formService.js';
import {
    initDeleteAction,
    initRestoreAction,
} from '../../services/actionService.js';

$(async function () {
    const dataTable = initProductsTable();

    fillData(dataTable);
    initToggleDeleted(() => fillData(dataTable));

    initForm({ reloadTable: () => fillData(dataTable) });

    initCreateProduct();
    initEditProduct();

    initDeleteAction(() => fillData(dataTable));
    initRestoreAction(() => fillData(dataTable));
});
