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

export function useKearifanItems() {
    return useQuery({
        queryKey: ['kearifan-lokal'],
        queryFn: async () => {
            const res = await apiFetch('/kearifan-lokal');
            return res.data.map(mapToKearifanItem);
        },
    });
}