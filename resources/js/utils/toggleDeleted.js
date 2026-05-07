export function initToggleDeleted(reloadTable) {

    $('#showDeleted').on('change', async function () {
        this.disabled = true;
        await reloadTable();
        this.disabled = false;
    });
}
