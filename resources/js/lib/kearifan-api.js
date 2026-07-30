import { useQuery } from '@tanstack/react-query';
import { apiFetch } from './api';

import kearifanEkologi from '../assets/kearifan-ekologi.jpg';
import kearifanPertanian from '../assets/kearifan-pertanian.jpg';
import kearifanTradisi from '../assets/kearifan-tradisi.jpg';
import wisataCengklik from '../assets/wisata-cengklik.jpg';

const DIMENSI_TO_KATEGORI = {
    'Ekologi Waduk Cengklik': 'ekologi',
    'Pertanian & Pangan': 'pertanian',
    'Tradisi Lisan & Sejarah': 'tradisi',
    'Wisata Komunitas': 'wisata-komunitas',
};
const PLACEHOLDER_BY_KATEGORI = {
    ekologi: kearifanEkologi,
    pertanian: kearifanPertanian,
    tradisi: kearifanTradisi,
    'wisata-komunitas': wisataCengklik,
};

function mapToKearifanItem(item = {}) {
    const kategori =
        DIMENSI_TO_KATEGORI[item?.dimensi] ?? 'tradisi';

    const deskripsi =
        typeof item?.deskripsi === 'string'
            ? item.deskripsi
            : '';

    const cuplikan =
        deskripsi.length > 140
            ? `${deskripsi.slice(0, 140)}…`
            : deskripsi;

    const fotoPlaceholder =
        PLACEHOLDER_BY_KATEGORI[kategori] ?? kearifanTradisi;

    const menggunakanFotoApi =
        typeof item?.url_media === 'string' &&
        item.url_media.trim() !== '';

    return {
        slug: String(item?.id ?? ''),
        judul:
            typeof item?.judul === 'string' &&
            item.judul.trim() !== ''
                ? item.judul
                : 'Cerita Kearifan Lokal',

        kategori,

        cuplikan:
            cuplikan.trim() !== ''
                ? cuplikan
                : 'Cerita dan pengetahuan lokal masyarakat Desa Sobokerto.',

        foto: menggunakanFotoApi
            ? item.url_media
            : fotoPlaceholder,

        narasumber:
            typeof item?.narasumber === 'string' &&
            item.narasumber.trim() !== ''
                ? item.narasumber
                : undefined,
    };
}

function mapToKearifanDetail(item) {
    const kategori = DIMENSI_TO_KATEGORI[item.dimensi] ?? 'tradisi';

    return {
        slug: String(item.id),
        judul: item.judul,
        kategori,
        deskripsi: item.deskripsi,
        foto: item.url_media
            ? item.url_media
            : PLACEHOLDER_BY_KATEGORI[kategori],
        kataKunci: item.kata_kunci ?? [],
        narasumber: item.narasumber ?? null,
        lokasi: item.lokasi ?? null,
        bahasa: item.bahasa ?? null,
        tanggalDokumentasi: item.tanggal_dokumentasi ?? null,
        pendokumentasi: item.pendokumentasi ?? null,
        sumber: item.sumber ?? null,
        statusEtis: item.status_etis ?? null,
        statusKurasi: item.status_kurasi ?? null,
        dokumenUrl: item.dokumen_url ?? null,
    };
}

function getDataArray(response) {
    if (Array.isArray(response)) {
        return response;
    }

    if (Array.isArray(response?.data)) {
        return response.data;
    }

    if (Array.isArray(response?.data?.data)) {
        return response.data.data;
    }

    return [];
}

export function useKearifanItems() {
    return useQuery({
        queryKey: ['kearifan-lokal'],

        queryFn: async () => {
            const response = await apiFetch('/kearifan-lokal');

            const items = getDataArray(response);

            return items
                .filter(Boolean)
                .map(mapToKearifanItem)
                .filter((item) => item.slug !== '');
        },

        retry: 1,
        staleTime: 5 * 60 * 1000,
        refetchOnWindowFocus: false,
    });
}

export function useKearifanDetail(slug) {
    return useQuery({
        queryKey: ['kearifan-lokal', slug],
        queryFn: async () => {
            const res = await apiFetch(`/kearifan-lokal/${slug}`);
            return mapToKearifanDetail(res.data);
        },
        enabled: Boolean(slug),
    });
}