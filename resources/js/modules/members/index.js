import { fillData } from "../../services/tableService";
import { initMembersTable } from "./table";
import { initCreateMember } from "./create";

$(async function () {
    const dataTable = initMembersTable();

    fillData(dataTable);

    initCreateMember();
});



