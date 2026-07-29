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
| formatDatetime
| Función para formatear fecha y hora en formato DD/MM/YYYY 
|--------------------------------------------------------------------------
*/
export function formatDatetime(dateString) {
    if (!dateString) return '';

    const date = new Date(dateString);
    
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    const seconds = String(date.getSeconds()).padStart(2, '0');

    return `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
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


