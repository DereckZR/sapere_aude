import { fillData } from "../../services/tableService";
import { initMembersTable } from "./table";
import { initCreateMember } from "./create";
import { initEditMember } from "./edit";
import { initToggleDeleted } from '../../utils/toggleDeleted.js';
import { initForm } from "../../services/formService.js";
import { initDeleteAction, initRestoreAction } from '../../services/actionService.js';

$(async function () {
    const dataTable = initMembersTable();

    fillData(dataTable);
    initToggleDeleted(() => fillData(dataTable));

    initForm({ reloadTable: () => fillData(dataTable) });

    initCreateMember();
    initEditMember();

    initDeleteAction(() => fillData(dataTable));
    initRestoreAction(() => fillData(dataTable));
});



