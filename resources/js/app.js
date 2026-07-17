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
| Modulos
|--------------------------------------------------------------------------
*/

const module = document.body.dataset.module;

if (module === 'auth') {
    import('./modules/auth');
}

if (module === 'cycles') {
    import('./modules/cycles');
}

if (module === 'members') {
    import('./modules/members');
}

if (module === 'users') {
    import('./modules/users');
}

if (module === 'products') {
    import('./modules/products');
}

/*
|--------------------------------------------------------------------------
| Inicializar App
|--------------------------------------------------------------------------
*/

import { initApp } from './services/appService.js';

$(function () {
    initApp();
});

