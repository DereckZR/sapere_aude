import './bootstrap';

import $ from 'jquery';
window.$ = window.jQuery = $;

import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import 'admin-lte/dist/js/adminlte.min.js';

/*
|--------------------------------------------------------------------------
| Librerías y plugins
|--------------------------------------------------------------------------
*/

// DataTables
import 'datatables.net-bs4';
import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';

// SweetAlert2
import Swal from 'sweetalert2';
window.Swal = Swal;

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

import TomSelect from 'tom-select';
import 'tom-select/dist/css/tom-select.bootstrap4.css';

window.TomSelect = TomSelect;

/*
|--------------------------------------------------------------------------
| Utils
|--------------------------------------------------------------------------
*/
import { initRemoveInvalidFeedback } from './utils/removeInvalidFeedback.js';

/*
|--------------------------------------------------------------------------
| Modulos
|--------------------------------------------------------------------------
*/

const module = document.body.dataset.module;

if (module === 'cycles') {
    import('./modules/cycles');
}

if (module === 'members') {
    import('./modules/members');
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

initRemoveInvalidFeedback();


