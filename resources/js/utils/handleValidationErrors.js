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

        const container = input.closest('.form-group');
        const feedback = container?.querySelector('.invalid-feedback');

        if (feedback && feedback.classList.contains('invalid-feedback')) {
            feedback.textContent = '';
            feedback.style.display = 'none';
        }
    });

    // asignar nuevos errores
    Object.keys(errors).forEach(field => {
        const input = document.querySelector(`[name="${field}"]`);

        if (!input) return;

        const container = input.closest('.form-group');
        const feedback = container?.querySelector('.invalid-feedback');

        // TomSelect support
        if (input.tomselect) {
            input.tomselect.wrapper.classList.add('is-invalid');
        } else {
            input.classList.add('is-invalid');
        }

        if (feedback && feedback.classList.contains('invalid-feedback')) {
            feedback.textContent = errors[field][0];
            feedback.style.display = 'block';
        }
    });
}
