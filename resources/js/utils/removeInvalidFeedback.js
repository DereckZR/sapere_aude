function removeInvalidFeedback(input) {
    $(input).removeClass('is-invalid');
    const feedback = $(input).next('.invalid-feedback');
    if (feedback.length) {
        feedback.text('');
    }
}

export function initRemoveInvalidFeedback() {
    // Eliminar feedback al cambiar inputs
    $('input').each(function () {
        $(this).on('change', function () {
            removeInvalidFeedback(this);
        });
    });

}
