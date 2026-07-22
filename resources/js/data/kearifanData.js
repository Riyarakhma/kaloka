import wadukCengklik from '../assets/waduk-cengklik.png';
import kearifanEkologi from '../assets/kearifan-ekologi.jpg';
import kearifanPertanian from '../assets/kearifan-pertanian.jpg';
import kearifanTradisi from '../assets/kearifan-tradisi.jpg';
import wisataCengklik from '../assets/wisata-cengklik.jpg';

export const KATEGORI_KEARIFAN = [
    {
        id: 'ekologi',
        label: 'Ekologi Waduk Cengklik',
    },
    {
        id: 'pertanian',
        label: 'Pertanian & Pangan Lokal',
    },
    {
        id: 'sejarah',
        label: 'Tradisi Lisan & Sejarah',
    },
    {
        id: 'wisata',
        label: 'Wisata Berbasis Komunitas',
    },
];

export const KEARIFAN_ITEMS = [
    {
        slug: 'ekosistem-waduk-cengklik',
        judul: 'Ekosistem Waduk Cengklik',
        kategori: 'ekologi',
        deskripsi:
            'Mengenal kondisi lingkungan, sumber daya air, dan kehidupan masyarakat di sekitar Waduk Cengklik.',

        kataKunci: [
            'Waduk Cengklik',
            'Ekosistem',
            'Perairan',
            'Sumber Daya Air',
            'Masyarakat',
            'Kelestarian',
        ],

        narasumber: {
            nama: 'Slamet Riyadi',
            keterangan: 'Petani dan pembudidaya ikan',
            asal: 'Warga Desa Sobokerto',
        },

        lokasi:
            'Waduk Cengklik, Desa Sobokerto, Kecamatan Ngemplak, Kabupaten Boyolali, Jawa Tengah',

        bahasa: 'Bahasa Indonesia',
        jenisMedia: 'Foto',
        tanggalDokumentasi: '12 Mei 2024',
        pendokumentasi: 'Tim KALOKA',
        sumber: 'Wawancara langsung dan observasi lapangan',

        statusEtis: {
            label: 'Etis',
            keterangan:
                'Telah memperoleh persetujuan narasumber untuk dokumentasi dan publikasi.',
        },

        statusKurasi: {
            label: 'Terverifikasi',
            keterangan:
                'Konten telah diperiksa dan diverifikasi oleh tim kurasi KALOKA.',
        },

        foto: wadukCengklik,

        isi: [
            'Waduk Cengklik merupakan salah satu kawasan perairan yang memiliki peran penting bagi kehidupan masyarakat di sekitarnya. Selain menjadi sumber daya air, kawasan ini juga mendukung kegiatan perikanan, pertanian, dan berbagai aktivitas ekonomi warga.',
            'Keberadaan waduk membentuk hubungan yang erat antara masyarakat dan lingkungan. Sebagian warga memanfaatkan perairan untuk mencari ikan, mengelola keramba, serta mendukung kebutuhan pertanian di kawasan sekitar Desa Sobokerto.',
            'Kelestarian ekosistem Waduk Cengklik membutuhkan keterlibatan seluruh pihak. Menjaga kebersihan, mengurangi sampah, dan menggunakan sumber daya secara bijak menjadi langkah penting agar manfaat waduk tetap dapat dirasakan oleh generasi berikutnya.',
        ],
    },

    {
        slug: 'menjaga-lingkungan-waduk',
        judul: 'Menjaga Lingkungan Waduk',
        kategori: 'ekologi',
        deskripsi:
            'Upaya sederhana masyarakat dalam menjaga kebersihan dan kelestarian lingkungan Waduk Cengklik.',
        kataKunci: [
            'Lingkungan',
            'Waduk',
            'Kebersihan',
            'Konservasi',
        ],
        narasumber: {
            nama: 'Warga Desa Sobokerto',
            keterangan: 'Masyarakat sekitar waduk',
            asal: 'Desa Sobokerto',
        },
        lokasi: 'Waduk Cengklik, Desa Sobokerto, Boyolali',
        bahasa: 'Bahasa Indonesia',
        jenisMedia: 'Foto',
        tanggalDokumentasi: '15 Mei 2024',
        pendokumentasi: 'Tim KALOKA',
        sumber: 'Observasi lapangan',
        statusEtis: {
            label: 'Etis',
            keterangan:
                'Dokumentasi telah mendapatkan persetujuan pihak terkait.',
        },
        statusKurasi: {
            label: 'Terverifikasi',
            keterangan:
                'Konten telah diperiksa oleh tim kurasi KALOKA.',
        },
        foto: kearifanEkologi,
        isi: [
            'Lingkungan Waduk Cengklik menjadi bagian penting dari kehidupan masyarakat yang tinggal di sekitarnya.',
            'Warga berperan menjaga kebersihan melalui kegiatan sederhana seperti tidak membuang sampah ke perairan dan merawat lingkungan sekitar.',
            'Kerja sama masyarakat dan pemerintah desa diperlukan untuk menjaga kelestarian kawasan waduk.',
        ],
    },

    {
        slug: 'budidaya-padi-sobokerto',
        judul: 'Budidaya Padi di Sobokerto',
        kategori: 'pertanian',
        deskripsi:
            'Kegiatan pertanian padi yang menjadi bagian penting dari kehidupan masyarakat Desa Sobokerto.',
        kataKunci: ['Pertanian', 'Padi', 'Petani', 'Pangan Lokal'],
        narasumber: {
            nama: 'Kelompok Tani Sobokerto',
            keterangan: 'Petani padi',
            asal: 'Desa Sobokerto',
        },
        lokasi: 'Area persawahan Desa Sobokerto, Boyolali',
        bahasa: 'Bahasa Indonesia dan Bahasa Jawa',
        jenisMedia: 'Foto',
        tanggalDokumentasi: '18 Mei 2024',
        pendokumentasi: 'Tim KALOKA',
        sumber: 'Wawancara dan dokumentasi lapangan',
        statusEtis: {
            label: 'Etis',
            keterangan:
                'Dokumentasi dilakukan dengan persetujuan narasumber.',
        },
        statusKurasi: {
            label: 'Terverifikasi',
            keterangan:
                'Konten telah diverifikasi oleh tim kurasi KALOKA.',
        },
        foto: kearifanPertanian,
        isi: [
            'Pertanian padi menjadi salah satu kegiatan utama masyarakat Desa Sobokerto.',
            'Pengetahuan mengenai pengolahan lahan, pemilihan bibit, penanaman, dan masa panen diwariskan melalui pengalaman masyarakat.',
            'Budidaya padi tidak hanya menyediakan pangan, tetapi juga menjadi sumber penghidupan bagi keluarga petani.',
        ],
    },

    {
        slug: 'hasil-pertanian-warga',
        judul: 'Hasil Pertanian Warga',
        kategori: 'pertanian',
        deskripsi:
            'Beragam hasil pertanian lokal yang dibudidayakan dan dimanfaatkan oleh masyarakat Sobokerto.',
        kataKunci: ['Pertanian', 'Produk Lokal', 'Pangan', 'Petani'],
        narasumber: {
            nama: 'Kelompok Tani Sobokerto',
            keterangan: 'Petani lokal',
            asal: 'Desa Sobokerto',
        },
        lokasi: 'Desa Sobokerto, Kabupaten Boyolali',
        bahasa: 'Bahasa Indonesia dan Bahasa Jawa',
        jenisMedia: 'Foto',
        tanggalDokumentasi: '18 Mei 2024',
        pendokumentasi: 'Tim KALOKA',
        sumber: 'Observasi lapangan',
        statusEtis: {
            label: 'Etis',
            keterangan:
                'Dokumentasi telah disetujui oleh pihak yang terlibat.',
        },
        statusKurasi: {
            label: 'Terverifikasi',
            keterangan:
                'Informasi telah diperiksa oleh tim kurasi KALOKA.',
        },
        foto: kearifanPertanian,
        isi: [
            'Masyarakat Sobokerto menghasilkan berbagai komoditas pertanian untuk kebutuhan keluarga maupun dipasarkan.',
            'Hasil pertanian mencerminkan kemampuan masyarakat dalam mengelola sumber daya lokal.',
            'Pengolahan dan pemasaran produk dapat dikembangkan untuk meningkatkan nilai ekonomi.',
        ],
    },

    {
        slug: 'sejarah-desa-sobokerto',
        judul: 'Sejarah Desa Sobokerto',
        kategori: 'sejarah',
        deskripsi:
            'Cerita mengenai perkembangan Desa Sobokerto yang diwariskan melalui penuturan masyarakat.',
        kataKunci: ['Sejarah Desa', 'Tradisi Lisan', 'Sobokerto'],
        narasumber: {
            nama: 'Tokoh Masyarakat Sobokerto',
            keterangan: 'Penutur sejarah lokal',
            asal: 'Desa Sobokerto',
        },
        lokasi: 'Desa Sobokerto, Kabupaten Boyolali',
        bahasa: 'Bahasa Indonesia dan Bahasa Jawa',
        jenisMedia: 'Teks dan Foto',
        tanggalDokumentasi: '20 Mei 2024',
        pendokumentasi: 'Tim KALOKA',
        sumber: 'Wawancara dengan tokoh masyarakat',
        statusEtis: {
            label: 'Etis',
            keterangan:
                'Narasumber telah memberikan persetujuan dokumentasi.',
        },
        statusKurasi: {
            label: 'Dalam Kurasi',
            keterangan:
                'Konten sedang melalui proses pemeriksaan lanjutan.',
        },
        foto: kearifanTradisi,
        isi: [
            'Sejarah Desa Sobokerto tersimpan dalam berbagai cerita yang diwariskan secara lisan.',
            'Cerita tersebut menggambarkan perkembangan wilayah dan kehidupan sosial masyarakat.',
            'Pendokumentasian diperlukan agar sejarah desa tetap dapat dipelajari oleh generasi muda.',
        ],
    },

    {
        slug: 'cerita-warga-tepian-waduk',
        judul: 'Cerita Warga Tepian Waduk',
        kategori: 'sejarah',
        deskripsi:
            'Kisah kehidupan warga yang menjalani aktivitas sehari-hari di sekitar Waduk Cengklik.',
        kataKunci: ['Warga', 'Waduk Cengklik', 'Cerita Lokal'],
        narasumber: {
            nama: 'Warga Tepian Waduk',
            keterangan: 'Masyarakat sekitar Waduk Cengklik',
            asal: 'Desa Sobokerto',
        },
        lokasi: 'Tepian Waduk Cengklik, Desa Sobokerto',
        bahasa: 'Bahasa Indonesia dan Bahasa Jawa',
        jenisMedia: 'Foto dan Teks',
        tanggalDokumentasi: '21 Mei 2024',
        pendokumentasi: 'Tim KALOKA',
        sumber: 'Wawancara langsung',
        statusEtis: {
            label: 'Etis',
            keterangan:
                'Narasumber menyetujui penggunaan dokumentasi.',
        },
        statusKurasi: {
            label: 'Terverifikasi',
            keterangan:
                'Konten telah diverifikasi oleh tim KALOKA.',
        },
        foto: kearifanTradisi,
        isi: [
            'Kehidupan masyarakat tepian waduk memiliki hubungan kuat dengan lingkungan perairan.',
            'Mencari ikan, bertani, berdagang, dan mengelola wisata menjadi bagian dari kehidupan warga.',
            'Cerita masyarakat menjadi bagian penting dari identitas lokal Desa Sobokerto.',
        ],
    },

    {
        slug: 'wisata-waduk-cengklik',
        judul: 'Wisata Waduk Cengklik',
        kategori: 'wisata',
        deskripsi:
            'Potensi wisata alam Waduk Cengklik yang dapat dikembangkan bersama masyarakat.',
        kataKunci: ['Wisata', 'Waduk Cengklik', 'Wisata Desa'],
        narasumber: {
            nama: 'Pengelola Wisata',
            keterangan: 'Pengelola kawasan Waduk Cengklik',
            asal: 'Kabupaten Boyolali',
        },
        lokasi: 'Kawasan Wisata Waduk Cengklik, Boyolali',
        bahasa: 'Bahasa Indonesia',
        jenisMedia: 'Foto',
        tanggalDokumentasi: '22 Mei 2024',
        pendokumentasi: 'Tim KALOKA',
        sumber: 'Observasi kawasan wisata',
        statusEtis: {
            label: 'Etis',
            keterangan:
                'Dokumentasi dilakukan sesuai persetujuan pihak terkait.',
        },
        statusKurasi: {
            label: 'Terverifikasi',
            keterangan:
                'Konten telah lolos proses kurasi KALOKA.',
        },
        foto: wisataCengklik,
        isi: [
            'Waduk Cengklik menawarkan pemandangan alam yang menjadi daya tarik wisata.',
            'Pengembangan wisata perlu memperhatikan kelestarian lingkungan dan keterlibatan warga.',
            'Wisata berbasis komunitas dapat menciptakan manfaat ekonomi bagi masyarakat lokal.',
        ],
    },

    {
        slug: 'peran-warga-dalam-wisata',
        judul: 'Peran Warga dalam Wisata',
        kategori: 'wisata',
        deskripsi:
            'Keterlibatan masyarakat dalam pengelolaan dan pengembangan wisata desa.',
        kataKunci: ['Masyarakat', 'Wisata Desa', 'Ekonomi Lokal'],
        narasumber: {
            nama: 'Pelaku Wisata Lokal',
            keterangan: 'Pelaku usaha dan pengelola wisata',
            asal: 'Desa Sobokerto',
        },
        lokasi: 'Desa Sobokerto dan Waduk Cengklik',
        bahasa: 'Bahasa Indonesia',
        jenisMedia: 'Foto dan Teks',
        tanggalDokumentasi: '22 Mei 2024',
        pendokumentasi: 'Tim KALOKA',
        sumber: 'Wawancara dan observasi lapangan',
        statusEtis: {
            label: 'Etis',
            keterangan:
                'Dokumentasi telah disetujui oleh narasumber.',
        },
        statusKurasi: {
            label: 'Terverifikasi',
            keterangan:
                'Konten telah diperiksa oleh tim kurasi KALOKA.',
        },
        foto: wisataCengklik,
        isi: [
            'Masyarakat menjadi bagian utama dalam pengembangan wisata berbasis komunitas.',
            'Warga dapat terlibat melalui pelayanan pengunjung, kuliner, promosi, dan pengelolaan kawasan.',
            'Keterlibatan masyarakat dapat meningkatkan manfaat ekonomi dan rasa memiliki terhadap wisata desa.',
        ],
    },
];