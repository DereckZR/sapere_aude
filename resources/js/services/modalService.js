/*
|--------------------------------------------------------------------------
| initFormModal
| Función para inicializar el modal de formulario
|--------------------------------------------------------------------------
*/

export function initFormModal() {
    const modal = $('#formModal');
    const form = $('#formModal form');

    // CREAR
    $('#btnCreate').on('click', function () {
        form.attr('action', form.data('createurl'));
        $('#formMethod').val('POST');
        $('#modalTitle').text('Registrar');

        form.trigger('reset');
        form.find('.is-invalid').removeClass('is-invalid');
        form.find('.invalid-feedback').text('');
        modal.modal('show');
    });

    // EDITAR
    $(document).on('click', '.btn-edit', function () {
        const id = $(this).data('id');
        form.attr('action', form.data('updateurl').replace(':id', id));
        $('#formMethod').val('PUT');
        $('#modalTitle').text('Editar');
        form.trigger('reset');
        form.find('.is-invalid').removeClass('is-invalid');
        form.find('.invalid-feedback').text('');
        modal.modal('show');
    });
}
