import { useQuery } from '@tanstack/react-query';

// Dummy image
import ecoprint from '../assets/ecoprint.jpg';
import keripik from '../assets/keripik.jpg';
import pupuk from '../assets/pupuk.jpg';
import lele from '../assets/lele.jpg';

const DUMMY_UMKM = [
    {
        id: 1,
        nama: 'Batik Ecoprint Sobokerto',
        kategori: 'kerajinan',
        deskripsi:
            'Produk kain ecoprint yang dibuat menggunakan daun dan pewarna alami dengan motif khas Desa Sobokerto.',
        foto: ecoprint,
    },
    {
        id: 2,
        nama: 'Keripik Tulang Ikan',
        kategori: 'kuliner',
        deskripsi:
            'Olahan keripik berbahan dasar tulang ikan yang renyah, bergizi, dan menjadi salah satu produk unggulan UMKM.',
        foto: keripik,
    },
    {
        id: 3,
        nama: 'Stik Kangkung',
        kategori: 'kuliner',
        deskripsi:
            'Camilan stik berbahan kangkung dengan cita rasa gurih dan cocok dijadikan oleh-oleh khas Sobokerto.',
        foto: keripik,
    },
    {
        id: 4,
        nama: 'Pupuk Organik Eceng Gondok',
        kategori: 'pertanian',
        deskripsi:
            'Pupuk organik hasil pengolahan eceng gondok yang ramah lingkungan dan bermanfaat bagi tanaman.',
        foto: pupuk,
    },
    {
        id: 5,
        nama: 'Budidaya Lele',
        kategori: 'budidaya',
        deskripsi:
            'Usaha budidaya ikan lele yang dikelola masyarakat sebagai salah satu sumber ekonomi desa.',
        foto: lele,
    },
    {
        id: 6,
        nama: 'Budidaya Maggot',
        kategori: 'budidaya',
        deskripsi:
            'Budidaya maggot sebagai pakan alternatif bernilai ekonomi sekaligus solusi pengolahan limbah organik.',
        foto: lele,
    },
];

const LABEL = {
    kerajinan: 'Kerajinan',
    kuliner: 'Kuliner',
    pertanian: 'Pertanian',
    budidaya: 'Budidaya',
};

function mapToUMKMItem(item) {
    return {
        slug: String(item.id),
        nama: item.nama,
        kategori: item.kategori,
        kategoriLabel: LABEL[item.kategori],
        deskripsi:
            item.deskripsi.length > 140
                ? item.deskripsi.slice(0, 140) + '…'
                : item.deskripsi,
        foto: item.foto,
    };
}

export function useUMKMItems() {
    return useQuery({
        queryKey: ['umkm'],
        queryFn: async () => {
            return DUMMY_UMKM.map(mapToUMKMItem);
        },
    });
}