export const KATEGORI = {
    ekologi: {
        id: 'ekologi',
        label: 'Ekologi Waduk Cengklik',
        deskripsi: 'Air, ikan, dan ekosistem sekitar waduk.',
        badgeClass: 'bg-[oklch(0.92_0.05_220)] text-[oklch(0.30_0.10_220)]',
        dotClass: 'bg-water',
    },
    pertanian: {
        id: 'pertanian',
        label: 'Pertanian & Pangan Lokal',
        deskripsi: 'Sawah, panen, dan resep dari dapur desa.',
        badgeClass: 'bg-primary-soft text-primary',
        dotClass: 'bg-leaf',
    },
    tradisi: {
        id: 'tradisi',
        label: 'Tradisi Lisan & Sejarah',
        deskripsi: 'Cerita rakyat, upacara, dan sejarah desa.',
        badgeClass: 'bg-[oklch(0.94_0.05_60)] text-[oklch(0.35_0.09_50)]',
        dotClass: 'bg-earth',
    },
    'wisata-komunitas': {
        id: 'wisata-komunitas',
        label: 'Wisata Berbasis Komunitas',
        deskripsi: 'Kegiatan wisata yang dikelola warga.',
        badgeClass: 'bg-[oklch(0.94_0.07_75)] text-[oklch(0.38_0.12_60)]',
        dotClass: 'bg-sun',
    },
};

export const KATEGORI_LIST = Object.values(KATEGORI);