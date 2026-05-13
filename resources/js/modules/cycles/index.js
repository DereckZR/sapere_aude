import { initCyclesTable } from './table.js';
import { initForm } from '../../services/formService.js';
import { fillData } from '../../services/tableService.js';
import { initToggleDeleted } from '../../utils/toggleDeleted.js';
import { initEditCycle } from './edit.js';
import { initDeleteCycle } from './delete.js';
import { initRestoreCycle } from './restore.js';

$(async function () {
    const dataTable = initCyclesTable();

    fillData(dataTable);
    initToggleDeleted(() => fillData(dataTable));

    initForm({
        form: $('#formModal form'),
        modal: $('#formModal'),
        reloadTable: () => fillData(dataTable)
    });

    initEditCycle();
    initDeleteCycle(() => fillData(dataTable));
    initRestoreCycle(() => fillData(dataTable));
});



