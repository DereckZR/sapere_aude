// utils/loadTomSelectOptions.js

/*
|--------------------------------------------------------------------------
| loadTomSelectOptions
| Función para cargar opciones en un TomSelect
|--------------------------------------------------------------------------
*/
export function loadTomSelectOptions({
    selector,
    options,
    placeholder = 'Seleccione una opción'
}) {

    const select = $(selector);

    const contenedor = select.closest('.form-group');
    contenedor.removeClass('d-none');

    if (select[0]?.tomselect) {
        select[0].tomselect.destroy();
    }

    select.empty();

    select.append(`<option value="">${placeholder}</option>`);

    options.forEach(option => {
        select.append(
            `<option value="${option.id}">${option.text}</option>`
        );
    });

    new TomSelect(selector, {
        create: false,
        dropdownParent: 'body'
    });
}
