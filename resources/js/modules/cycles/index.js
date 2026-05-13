import { initCyclesTable } from './table.js';
import { initForm } from '../../services/formService.js';
import { fillData } from '../../services/tableService.js';
import { initToggleDeleted } from '../../utils/toggleDeleted.js';
import { initEditCycle } from './edit.js';
import { initDeleteAction, initRestoreAction } from '../../services/actionService.js';

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

    initDeleteAction(() => fillData(dataTable));
    initRestoreAction(() => fillData(dataTable));
});



