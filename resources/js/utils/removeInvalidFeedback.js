// utils/removeInvalidFeedback.js

/*
|--------------------------------------------------------------------------
| removeInvalidFeedback
| Función para eliminar el feedback de validación de un input específico
|--------------------------------------------------------------------------
*/
function removeInvalidFeedback(input) {
    $(input).removeClass('is-invalid');
    const container = input.closest('.form-group');
    const feedback = container?.querySelector('.invalid-feedback');
    if (feedback && feedback.length) {
        feedback.text('');
        feedback.style.display = 'none';
    }
}


// function removeInvalidFeedback(input) {
//     $(input).removeClass('is-invalid');
//     const feedback = $(input).next('.invalid-feedback');
//     if (feedback.length) {
//         feedback.text('');
//     }
// }

/*
|--------------------------------------------------------------------------
| initRemoveInvalidFeedback
| Función para inicializar la eliminación del feedback de validación de los inputs
|--------------------------------------------------------------------------
*/
export function initRemoveInvalidFeedback() {
    // Eliminar feedback al cambiar inputs
    $('input').each(function () {
        $(this).on('change', function () {
            removeInvalidFeedback(this);
        });
    });

}
