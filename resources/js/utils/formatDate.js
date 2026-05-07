// utils/formatDate.js

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
| formatDateForInput
| Función para formatear fechas en formato YYYY-MM-DD (para inputs de tipo date)
|--------------------------------------------------------------------------
*/
export function formatDateForInput(dateString) {
    if (!dateString) return '';
    return dateString.split('T')[0];
}


