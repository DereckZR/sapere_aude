import { fillDataTable } from "../../utils/fillDataTable";
import { initMembersTable } from "./table";
import { initCreateMember } from "./create";

$(async function () {
    const dataTable = initMembersTable();

    fillDataTable(dataTable);

    initCreateMember();
});



