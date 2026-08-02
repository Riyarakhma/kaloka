import { useQuery } from '@tanstack/react-query';
import { apiFetch } from './api';

export const KATEGORI_WISATA = [
    'Destinasi',
    'Kuliner',
    'Kerajinan',
    'Event',
];

export function warnaKategoriWisata(kategori) {
    return 'bg-primary-soft text-primary';
}

const KATEGORI_EN = {
    Destinasi: 'Destination',
    Kuliner: 'Culinary',
    Kerajinan: 'Craft',
    Event: 'Event',
};

export function kategoriEn(kategori) {
    return KATEGORI_EN[kategori] ?? kategori;
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