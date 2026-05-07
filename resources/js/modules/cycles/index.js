import { initCyclesTable } from './table.js';
import { initCycleForm } from './form.js';
import { fillDataTable } from './fillDataTable.js';
import { initToggleDeleted } from '../../utils/toggleDeleted.js';
import { initEditCycle } from './edit.js';
import { initDeleteCycle } from './delete.js';
import { initRestoreCycle } from './restore.js';

$(async function () {
    const dataTable = initCyclesTable();

    fillDataTable(dataTable);
    initToggleDeleted(() => fillDataTable(dataTable));

    initCycleForm({
        form: $('#formModal form'),
        modal: $('#formModal'),
        reloadTable: () => fillDataTable(dataTable)
    });

    initEditCycle();
    initDeleteCycle(() => fillDataTable(dataTable));
    initRestoreCycle(() => fillDataTable(dataTable));
});



