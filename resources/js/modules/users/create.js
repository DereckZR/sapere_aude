import { apiFetch } from "../../services/api.js";
import { loadTomSelectOptions } from "../../utils/loadTomSelectOptions.js";
import { resetToggleVisibilityPassword } from "../../utils/toggleVisibilityPassword.js";

export function initCreateUser() {
    $("#btnCreate").on("click", async function () {
        const loader = $("#modalLoader");
        const ModalError = $("#modalError");

        try {
            resetToggleVisibilityPassword();

            loader.removeClass("d-none");
            ModalError.addClass("d-none");

            const urlMembers = $(this).data("members-url");
            const urlRoles = $(this).data("roles-url");

            const members = await apiFetch(urlMembers);
            const roles = await apiFetch(urlRoles);

            $('#password__container').removeClass('d-none');
            $('#password_confirmation__container').removeClass('d-none');

            $('#password').prop('required', true);
            $('#password_confirmation').prop('required', true);
            $('#member_id').prop('required', true);

            loadTomSelectOptions({
                selector: "#role_id",
                options: roles,
                placeholder: "Seleccione un role",
            });

            loadTomSelectOptions({
                selector: "#member_id",
                options: members,
                placeholder: "Seleccione un miembro",
            });
        } catch (error) {
            ModalError.removeClass("d-none");
            toastr.error(error.message);
        } finally {
            loader.addClass("d-none");
        }
    });
}
