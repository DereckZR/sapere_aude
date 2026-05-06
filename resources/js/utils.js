// utils.js

/*
|--------------------------------------------------------------------------
| formatDate
| Función para formatear fechas en formato DD/MM/YYYY
|--------------------------------------------------------------------------
*/
export function formatDate(dateString) {
    if (!dateString) return '';

    const date = new Date(dateString);

    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();

    return `${day}/${month}/${year}`;
}

/*
|--------------------------------------------------------------------------
| handleValidationErrors
| Función para manejar errores de validación en formularios
|--------------------------------------------------------------------------
*/

export function handleValidationErrors(errors) {
    // limpiar estados previos
    document.querySelectorAll('.form-control').forEach(input => {
        input.classList.remove('is-invalid');

        const feedback = input.nextElementSibling;
        if (feedback && feedback.classList.contains('invalid-feedback')) {
            feedback.textContent = '';
        }
    });

    // asignar nuevos errores
    Object.keys(errors).forEach(field => {
        const input = document.querySelector(`[name="${field}"]`);

        if (!input) return;

        input.classList.add('is-invalid');

        const feedback = input.nextElementSibling;
        if (feedback && feedback.classList.contains('invalid-feedback')) {
            feedback.textContent = errors[field][0]; // solo el primer error
        }
    });
}
