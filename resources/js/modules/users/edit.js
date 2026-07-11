import { apiFetch } from '../../services/api.js';
import { loadTomSelectOptions } from "../../utils/loadTomSelectOptions.js";

export function initEditUser() {
    $(document).on('click', '.btn-edit', async function () {
        const loader = $('#modalLoader');
        const ModalError = $('#modalError');

        try {
            loader.removeClass('d-none');
            ModalError.addClass('d-none');
            const url = $(this).data('url');
            const data = await apiFetch(url);

            const urlRoles = $('#btnCreate').data("roles-url");
            const roles = await apiFetch(urlRoles);

            $('#password__container').addClass('d-none');
            $('#password_confirmation__container').addClass('d-none');

            $('#password').prop('required', false);
            $('#password_confirmation').prop('required', false);
            $('#member_id').prop('required', false);

            const select = $('#member_id');
            const contenedor = select.closest('.form-group');
            contenedor.addClass('d-none');
            // Si existe un TomSelect, lo destruimos
            if (select[0]?.tomselect) {
                select[0].tomselect.destroy();
            }
            select.empty();

            loadTomSelectOptions({
                selector: '#role_id',
                options: roles,
                placeholder: 'Seleccione un role',
            });

            const roleSelect = $('#role_id');

            if (roleSelect[0]?.tomselect) {
                roleSelect[0].tomselect.setValue(data.role_id);
            }
        } catch (error) {
            ModalError.removeClass('d-none');
            toastr.error(error.message);
        } finally {
            loader.addClass('d-none');
        }
    });
}
