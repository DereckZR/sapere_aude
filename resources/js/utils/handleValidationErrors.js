// utils/handleValidationErrors.js

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

        const feedback = input.parentElement.querySelector('.invalid-feedback');

        if (input.tomselect) {
            input.tomselect.wrapper.classList.add('is-invalid');
        } else {
            input.classList.add('is-invalid');
        }

        if (feedback && feedback.classList.contains('invalid-feedback')) {
            feedback.textContent = errors[field][0]; // solo el primer error
        }
    });
}
