import { formatDate, handleValidationErrors } from '../../utils.js';

$(async function () {
    const table = $('#cyclesTable').DataTable({
        processing: true,
        data: [],
        columns: [
            { data: 'id' },
            {
                data: 'start_date',
                render: function (data) {
                    return formatDate(data);
                }
            },
            {
                data: 'end_date',
                render: function (data) {
                    return formatDate(data);
                }
            },
            {
                data: 'actions',
                orderable: false,
                searchable: false,
                render: function (data) {
                    return data.join(' ');
                }
            }
        ]
    });

    async function fillTableData() {
        try {
            const url = $('#cyclesTable').data('url');
            const response = await fetch(url);

            if (!response.ok) {
                throw new Error('Error fetching data');
            }

            const data = await response.json();

            console.log(data);


            // cargar datos dinámicamente
            table.clear();
            table.rows.add(data);
            table.draw();


        } catch (error) {
            console.error(error);
        }
    }

    fillTableData();

    const modal = $('#formModal');
    const form = $('#formModal form');

    form.on('submit', async (e) => {
        e.preventDefault();

        const url = form.attr('action');
        const method = $('#formMethod').val();
        const formData = new FormData(form[0]);

        try {
            const response = await fetch(url, {
                method: method,
                body: formData,
                headers: {
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
                    throw new Error('Error submitting form');
                }
            }

            fillTableData();

            toastr.success('Registrado correctamente');

            modal.modal('hide');
        } catch (error) {
            toastr.error(error.message);
        }
    });

});


