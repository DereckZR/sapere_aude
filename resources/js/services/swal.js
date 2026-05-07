import Swal from 'sweetalert2';
export async function confirmAction(text) {
    return Swal.fire({
        title: '¿Estás seguro?',
        text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
    });
}
