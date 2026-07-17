export function initFormInputNumber() {
    const inputNumberElements = document.querySelectorAll('.input-number');
    inputNumberElements.forEach(input => {
        const isDecimal = input.dataset.isDecimal === '1';

        input.addEventListener('input', function () {
            if (isDecimal) {
                validateDecimalInput(this);
            } else {
                validateIntegerInput(this);
            }
        });
    });
}

function validateDecimalInput(input) {
    let value = input.value;

    // Permitir solo números, punto y coma
    value = value.replace(/[^0-9.,]/g, '');

    // Convertir comas a puntos
    value = value.replace(/,/g, '.');

    // Permitir solo un punto decimal
    const parts = value.split('.');
    if (parts.length > 2) {
        value = parts[0] + '.' + parts.slice(1).join('');
    }

    // Limitar a 2 decimales
    if (value.includes('.')) {
        const [integer, decimal] = value.split('.');
        value = integer + '.' + decimal.slice(0, 2);
    }

    input.value = value;
}

function validateIntegerInput(input) {
    const value = input.value;
    const integerPattern = /^\d*$/;

    if (!integerPattern.test(value)) {
        input.value = value.replace(/[^0-9]/g, '');
    }
}
