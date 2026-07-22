import { useQuery } from '@tanstack/react-query';
import { apiFetch } from './api';

export const KATEGORI_WISATA = [
    'Destinasi',
    'Kuliner',
    'Kerajinan',
    'Event',
];

const WARNA_KATEGORI = {
    Destinasi: 'bg-primary-soft text-primary',

    Kuliner:
        'bg-[oklch(0.94_0.07_30)] text-[oklch(0.4_0.15_25)]',

    Kerajinan:
        'bg-[oklch(0.94_0.07_75)] text-[oklch(0.38_0.12_60)]',

    Event:
        'bg-[oklch(0.92_0.05_220)] text-[oklch(0.30_0.10_220)]',
};

export function warnaKategoriWisata(kategori) {
    return (
        WARNA_KATEGORI[kategori] ??
        WARNA_KATEGORI.Destinasi
    );
}

export function useWisataItems(kategori = 'semua') {
    return useQuery({
        queryKey: ['wisata', kategori],

        queryFn: async () => {
            const queryString =
                kategori && kategori !== 'semua'
                    ? `?kategori=${encodeURIComponent(kategori)}`
                    : '';

            const response = await apiFetch(
                `/wisata${queryString}`,
            );

            return response?.data ?? [];
        },
    });
}

export function useWisataDetail(slugOrId) {
    return useQuery({
        queryKey: ['wisata-detail', slugOrId],

        queryFn: async () => {
            if (!slugOrId) {
                throw new Error('Slug atau ID wisata tidak tersedia.');
            }

            const response = await apiFetch(
                `/wisata/${encodeURIComponent(slugOrId)}`,
            );

            return response?.data ?? response;
        },

        enabled: Boolean(slugOrId),

        retry: 1,
    });
}