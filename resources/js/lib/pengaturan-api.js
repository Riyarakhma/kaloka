import { useQuery } from '@tanstack/react-query';
import { apiFetch } from './api';

export function usePengaturan() {
    return useQuery({
        queryKey: ['pengaturan'],
        queryFn: async () => {
            const response = await apiFetch('/pengaturan');
            return response?.data ?? {};
        },
        staleTime: 5 * 60 * 1000,
    });
}

/** Ekstrak video ID YouTube dari berbagai format URL (youtu.be, watch?v=, embed/). */
export function ekstrakYoutubeId(url) {
    if (!url) return null;
    const match = url.match(
        /(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([a-zA-Z0-9_-]{11})/,
    );
    return match ? match[1] : null;
}