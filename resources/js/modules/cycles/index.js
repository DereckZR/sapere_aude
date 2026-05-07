import { formatDate, formatDateForInput, handleValidationErrors } from '../../utils.js';
import { DATATABLE_ES } from '../../utils.js';

$(async function () {
    const table = $('#cyclesTable');
    const dataTable = table.DataTable({
        processing: true,
        data: [],
        columns: [
            {
                data: 'id',
                title: '#'
            },
            {
                data: 'start_date',
                title: 'Fecha de inicio',
                render: function (data) {
                    return formatDate(data);
                }
            },
            {
                data: 'end_date',
                title: 'Fecha de cierre',
                render: function (data) {
                    return formatDate(data);
                }
            },
            {
                data: 'actions',
                title: 'Acciones',
                orderable: false,
                searchable: false,
                render: function (data) {
                    return data.join(' ');
                }
            }
        ],
        createdRow: function (row, data) {

            if (data.deleted_at) {
                $(row).addClass('table-deleted');
            }
        },
        language: DATATABLE_ES
    });

    async function fillTableData() {
        try {
            dataTable.processing(true);
            const showDeleted = $('#showDeleted').is(':checked');
            const url = showDeleted ? table.data('deleted-url') : table.data('url');
            const response = await fetch(url);

            if (!response.ok) {
                throw new Error('Error fetching data');
            }

            const data = await response.json();

            // cargar datos dinámicamente
            dataTable.clear();
            dataTable.rows.add(data);
            dataTable.draw();
        } catch (error) {
            console.error(error);
        } finally {
            dataTable.processing(false);
        }
    }

    fillTableData();

    $('#showDeleted').on('change', async function () {
        this.disabled = true;
        await fillTableData();
        this.disabled = false;
    });

    const modal = $('#formModal');
    const form = $('#formModal form');
    const loader = $('#modalLoader');
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    form.on('submit', async (e) => {
        e.preventDefault();

        const url = form.attr('action');
        const formData = new FormData(form[0]);

        try {
            loader.removeClass('d-none');


            const response = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (!response.ok) {
                if (response.status === 422) {
                    handleValidationErrors(data.errors);
                    throw new Error('Por favor, corrige los errores en el formulario');
                } else {
                    console.log('status', response.status);
                    throw new Error('Error submitting form');
                }
            }

            await fillTableData();

            toastr.success('Registrado correctamente');
            modal.modal('hide');
        } catch (error) {
            toastr.error(error.message);
        } finally {
            loader.addClass('d-none');
        }
    });

    // Fill form data for editing
    $(document).on('click', '.btn-edit', async function () {
        try {
            loader.removeClass('d-none');
            const url = $(this).data('url');
            const response = await fetch(url);

            if (!response.ok) {
                throw new Error('Error fetching data');
            }

            const cycle = await response.json();
            $('#start_date').val(formatDateForInput(cycle.start_date));
            $('#end_date').val(formatDateForInput(cycle.end_date));
        } catch (error) {
            toastr.error(error.message);
        } finally {
            loader.addClass('d-none');
        }
    });

    $(document).on('click', '.btn-delete', function () {
        const url = $(this).data('url');
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Se va a eliminar el registro",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const response = await fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Error deleting record');
                    }

                    await fillTableData();
                    toastr.success('Eliminado correctamente');
                } catch (error) {
                    toastr.error(error.message);
                }
            }
        });
    });

    $(document).on('click', '.btn-restore', function () {
        const url = $(this).data('url');
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Se va a restaurar el registro",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, restaurar',
            cancelButtonText: 'Cancelar'
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const response = await fetch(url, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Error restoring record');
                    }

                    await fillTableData();
                    toastr.success('Restaurado correctamente');
                } catch (error) {
                    toastr.error(error.message);
                }
            }
        });
    });
});



