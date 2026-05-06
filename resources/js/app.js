import './bootstrap';

import $ from 'jquery';
window.$ = window.jQuery = $;

import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import 'admin-lte/dist/js/adminlte.min.js';

// DataTables
import 'datatables.net-bs4';
import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';

// Toastr
import toastr from 'toastr';
import 'toastr/build/toastr.min.css';

toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: 'toast-top-right',
    timeOut: '3000'
};

window.toastr = toastr;

/*
|--------------------------------------------------------------------------
| Modulos
|--------------------------------------------------------------------------
*/

const module = document.body.dataset.module;

if (module === 'cycles') {
    import('./modules/cycles');
}

/*
|--------------------------------------------------------------------------
| FormModal
|--------------------------------------------------------------------------
*/

const modal = $('#formModal');
const form = $('#formModal form');

// CREAR
$('#btnCreate').on('click', function () {
    form.attr('action', form.data('createurl'));
    $('#formMethod').val('POST');

    $('#modalTitle').text('Registrar');
    $('#submitBtn').text('Guardar');

    form.trigger('reset');

    modal.modal('show');
});

// EDITAR
$(document).on('click', '.btn-edit', function () {
    const cycle = $(this).data('cycle');

    form.attr('action', form.data('updateurl').replace(':id', cycle.id));
    $('#formMethod').val('PUT');

    $('#modalTitle').text('Editar ciclo');
    $('#submitBtn').text('Actualizar');

    $('#start_date').val(cycle.start_date);
    $('#end_date').val(cycle.end_date);

    modal.modal('show');
});


