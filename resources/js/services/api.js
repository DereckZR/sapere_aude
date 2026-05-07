export async function apiFetch(url, options = {}) {

    const token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute('content');

    const response = await fetch(url, {
        headers: {
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            ...options.headers
        },
        ...options
    });

    const data = await response.json();

    if (!response.ok) {
        throw {
            message: data.message || 'Error en la solicitud',
            status: response.status,
            data
        };
    }

    return data;
}
