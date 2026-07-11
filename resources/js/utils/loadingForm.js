export function initLoadingForm() {
    $("form").on("submit", function () {
        $("#btnSubmit").prop("disabled", true);

        $("#loader").removeClass("d-none").addClass('d-flex');;
    });
}
