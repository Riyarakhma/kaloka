const ENV_API_URL = import.meta.env.VITE_API_URL;

/*
|--------------------------------------------------------------------------
| API BASE URL
|--------------------------------------------------------------------------
| Kalau VITE_API_URL tidak diisi, otomatis memakai /api.
| Cocok kalau React dan Laravel berada dalam project yang sama.
*/
const API_URL = (ENV_API_URL || '/api').replace(/\/+$/, '');

export class ApiError extends Error {
    constructor(status, message, data = null) {
        super(message);

        this.name = 'ApiError';
        this.status = status;
        this.data = data;
    }
}

function createApiUrl(path = '') {
    const normalizedPath = path.startsWith('/')
        ? path
        : `/${path}`;

    return `${API_URL}${normalizedPath}`;
}

async function parseResponse(response) {
    const contentType = response.headers.get('content-type') || '';

    if (response.status === 204) {
        return null;
    }

    if (contentType.includes('application/json')) {
        return response.json().catch(() => null);
    }

    const text = await response.text().catch(() => '');

    return text || null;
}

export async function apiFetch(path, options = {}) {
    const url = createApiUrl(path);

    const headers = {
        Accept: 'application/json',
        ...options.headers,
    };

    /*
    |--------------------------------------------------------------------------
    | Content-Type
    |--------------------------------------------------------------------------
    | Jangan pasang application/json saat mengirim FormData,
    | karena browser harus membuat boundary secara otomatis.
    */
    if (
        !(options.body instanceof FormData) &&
        !headers['Content-Type']
    ) {
        headers['Content-Type'] = 'application/json';
    }

    let response;

    try {
        response = await fetch(url, {
            ...options,
            headers,
            credentials: 'same-origin',
        });
    } catch (error) {
        throw new ApiError(
            0,
            'Tidak dapat terhubung ke server. Pastikan Laravel sedang berjalan.',
            error,
        );
    }

    const body = await parseResponse(response);

    if (!response.ok) {
        const message =
            body?.message ||
            body?.error ||
            `Permintaan gagal dengan status ${response.status}`;

        throw new ApiError(
            response.status,
            message,
            body,
        );
    }

    return body;
}