import { fillData } from "../../services/tableService";
import { initUsersTable } from "./table";
import { initCreateUser } from "./create";
import { initEditUser } from "./edit";
import { initToggleDeleted } from "../../utils/toggleDeleted.js";
import {
    initDeleteAction,
    initRestoreAction,
} from "../../services/actionService.js";
import { initForm } from "../../services/formService.js";
import { initToggleVisibilityPassword } from "../../utils/toggleVisibilityPassword.js";

$(async function () {
    const dataTable = initUsersTable();

    fillData(dataTable);
    initToggleDeleted(() => fillData(dataTable));

    initForm({ reloadTable: () => fillData(dataTable) });

    initCreateUser();
    initEditUser();

    initDeleteAction(() => fillData(dataTable));
    initRestoreAction(() => fillData(dataTable));

    initToggleVisibilityPassword();
});
