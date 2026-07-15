const API_URL = import.meta.env.VITE_API_URL;

export class ApiError extends Error {
    constructor(status, message) {
        super(message);
        this.status = status;
    }
}

export async function apiFetch(path, options) {
    const res = await fetch(`${API_URL}${path}`, {
        ...options,
        headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
            ...options?.headers,
        },
    });

    if (!res.ok) {
        const body = await res.json().catch(() => null);
        throw new ApiError(res.status, body?.message ?? 'Terjadi kesalahan');
    }

    return res.json();
}