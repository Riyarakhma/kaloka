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
function mapToKearifanItem(item) {
    const kategori = DIMENSI_TO_KATEGORI[item.dimensi] ?? 'tradisi';
    const cuplikan =
        item.deskripsi.length > 140 ? item.deskripsi.slice(0, 140) + '…' : item.deskripsi;
    return {
        slug: String(item.id),
        judul: item.judul,
        kategori,
        cuplikan,
        foto:
            item.jenis_media === 'Foto' && item.url_media
                ? item.url_media
                : PLACEHOLDER_BY_KATEGORI[kategori],
        narasumber: item.narasumber ?? undefined,
    };
}
function mapToKearifanDetail(item) {
    const kategori = DIMENSI_TO_KATEGORI[item.dimensi] ?? 'tradisi';

    return {
        slug: String(item.id),
        judul: item.judul,
        kategori,
        deskripsi: item.deskripsi,
        foto:
            item.jenis_media === 'Foto' && item.url_media
                ? item.url_media
                : PLACEHOLDER_BY_KATEGORI[kategori],
        kataKunci: item.kata_kunci ?? [],
        narasumber: item.narasumber ?? null,
        lokasi: item.lokasi ?? null,
        bahasa: item.bahasa ?? null,
        jenisMedia: item.jenis_media ?? null,
        tanggalDokumentasi: item.tanggal_dokumentasi ?? null,
        pendokumentasi: item.pendokumentasi ?? null,
        sumber: item.sumber ?? null,
        statusEtis: item.status_etis ?? null,
        statusKurasi: item.status_kurasi ?? null,
    };
}
export function useKearifanItems() {
    return useQuery({
        queryKey: ['kearifan-lokal'],
        queryFn: async () => {
            const res = await apiFetch('/kearifan-lokal');
            return res.data.map(mapToKearifanItem);
        },
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