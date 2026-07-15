<?php

namespace Database\Seeders;

use App\Models\KearifanLokal;
use App\Models\User;
use Illuminate\Database\Seeder;

class KearifanLokalSeeder extends Seeder
{
    public function run(): void
    {
        $pengelola = User::where('role', 'pengelola')->first() ?? User::first();

        $data = [
            /* ===================== Dimensi: Ekologi Waduk Cengklik ===================== */
            [
                'judul' => 'Ekosistem dan Burung Air Waduk Cengklik',
                'dimensi' => 'Ekologi Waduk Cengklik',
                'deskripsi' => "Waduk Cengklik menjadi habitat penting bagi beragam burung air seperti blekok, kuntul, dan belibis yang singgah mencari makan. Keberadaan mereka menjadi penanda kesehatan ekosistem perairan. Masyarakat menjaga area tepian agar tetap menjadi ruang hidup satwa.",
                'kata_kunci' => 'ekologi, burung air, blekok, keanekaragaman hayati',
                'narasumber' => 'Kelompok Pengawas Lingkungan',
                'lokasi' => 'Tepi Waduk Cengklik',
                'bahasa' => 'Indonesia', 'jenis_media' => 'Foto',
                'tanggal_dokumentasi' => '2026-05-15', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Observasi lapangan',
                'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],
            [
                'judul' => 'Sistem Irigasi dan Tata Air Waduk Cengklik',
                'dimensi' => 'Ekologi Waduk Cengklik',
                'deskripsi' => "Waduk Cengklik dibangun untuk mengairi ribuan hektar sawah di Boyolali dan sekitarnya. Masyarakat memiliki kearifan dalam pembagian air (gilir air) antarpetak sawah agar adil dan berkelanjutan, dikelola bersama kelompok tani.",
                'kata_kunci' => 'irigasi, tata air, gilir air, pertanian',
                'narasumber' => 'Gabungan Kelompok Tani', 'lokasi' => 'Saluran Irigasi Cengklik',
                'bahasa' => 'Indonesia', 'jenis_media' => 'Teks',
                'tanggal_dokumentasi' => '2026-05-16', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],
            [
                'judul' => 'Pelestarian Ikan Endemik Perairan Waduk',
                'dimensi' => 'Ekologi Waduk Cengklik',
                'deskripsi' => "Upaya warga menjaga populasi ikan lokal melalui penebaran benih (restocking) dan kesepakatan larangan penangkapan dengan setrum/racun. (Entri sedang diverifikasi.)",
                'kata_kunci' => 'ikan lokal, restocking, konservasi',
                'narasumber' => 'Kelompok Pembudidaya Ikan', 'lokasi' => 'Waduk Cengklik',
                'bahasa' => 'Indonesia', 'jenis_media' => 'Teks',
                'tanggal_dokumentasi' => '2026-05-17', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara', 'status_etis' => 'Umum', 'status_kurasi' => 'Terverifikasi',
            ],

            /* ===================== Dimensi: Pertanian & Pangan ===================== */
            [
                'judul' => 'Tradisi Mina Padi di Tepian Waduk Cengklik',
                'dimensi' => 'Pertanian & Pangan',
                'deskripsi' => "Mina padi menggabungkan budidaya padi dengan pemeliharaan ikan di petak sawah yang sama. Memanfaatkan ketersediaan air waduk, petani meningkatkan hasil panen sekaligus pendapatan dari ikan nila.",
                'kata_kunci' => 'mina padi, ikan nila, pertanian terpadu',
                'narasumber' => 'Pak Sutarno', 'lokasi' => 'Dukuh Ngandong',
                'bahasa' => 'Jawa', 'jenis_media' => 'Teks',
                'tanggal_dokumentasi' => '2026-05-10', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara lapangan', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],
            [
                'judul' => 'Olahan Pangan Lokal: Abon Lele dan Keripik Belut',
                'dimensi' => 'Pertanian & Pangan',
                'deskripsi' => "Ibu-ibu PKK mengolah hasil perikanan menjadi produk bernilai tambah seperti abon lele, keripik belut, dan nugget ikan. Produk ini menjadi oleh-oleh khas dan sumber ekonomi keluarga.",
                'kata_kunci' => 'abon lele, keripik belut, UMKM, pangan',
                'narasumber' => 'Kelompok PKK Desa', 'lokasi' => 'Dukuh Sobokerto',
                'bahasa' => 'Indonesia', 'jenis_media' => 'Foto',
                'tanggal_dokumentasi' => '2026-05-11', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],
            [
                'judul' => 'Pranata Mangsa: Kalender Tanam Tradisional',
                'dimensi' => 'Pertanian & Pangan',
                'deskripsi' => "Pranata mangsa adalah penanggalan musim warisan leluhur Jawa yang dipakai petani untuk menentukan waktu tanam, pengairan, dan panen berdasarkan tanda-tanda alam.",
                'kata_kunci' => 'pranata mangsa, kalender tanam, kearifan jawa',
                'narasumber' => 'Mbah Karto', 'lokasi' => 'Desa Sobokerto',
                'bahasa' => 'Jawa', 'jenis_media' => 'Teks',
                'tanggal_dokumentasi' => '2026-05-12', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Tutur lisan', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],

            /* ===================== Dimensi: Tradisi Lisan & Sejarah ===================== */
            [
                'judul' => 'Legenda Asal Mula Waduk Cengklik',
                'dimensi' => 'Tradisi Lisan & Sejarah',
                'deskripsi' => "Cerita rakyat yang dituturkan turun-temurun mengenai asal mula kawasan Waduk Cengklik dan makna namanya bagi masyarakat sekitar.",
                'kata_kunci' => 'legenda, cerita rakyat, sejarah',
                'narasumber' => 'Mbah Karto', 'lokasi' => 'Dukuh Sobokerto',
                'bahasa' => 'Jawa', 'jenis_media' => 'Teks',
                'tanggal_dokumentasi' => '2026-05-12', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Tutur lisan', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],
            [
                'judul' => 'Sejarah Pembangunan Waduk Cengklik Era Kolonial',
                'dimensi' => 'Tradisi Lisan & Sejarah',
                'deskripsi' => "Waduk Cengklik dibangun pada masa pemerintahan kolonial Belanda sekitar tahun 1926-1928 sebagai bendungan irigasi. Catatan dan tutur warga melengkapi jejak sejarah pembangunannya.",
                'kata_kunci' => 'sejarah, kolonial, bendungan, 1928',
                'narasumber' => 'Sesepuh Desa', 'lokasi' => 'Waduk Cengklik',
                'bahasa' => 'Indonesia', 'jenis_media' => 'Teks',
                'tanggal_dokumentasi' => '2026-05-13', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Arsip & wawancara', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],
            [
                'judul' => 'Ritual Sedekah Waduk (Bersih Desa)',
                'dimensi' => 'Tradisi Lisan & Sejarah',
                'deskripsi' => "Ritual adat sebagai ungkapan syukur masyarakat atas berkah air waduk. Sebagian tata cara bersifat sakral dan tidak untuk dipublikasikan secara terbuka.",
                'kata_kunci' => 'ritual, sedekah, bersih desa, adat',
                'narasumber' => 'Sesepuh Desa', 'lokasi' => 'Dukuh Sobokerto',
                'bahasa' => 'Jawa', 'jenis_media' => 'Teks',
                'tanggal_dokumentasi' => '2026-05-20', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara terbatas', 'status_etis' => 'Sakral', 'status_kurasi' => 'Terbit',
            ],
            [
                'judul' => 'Tembang dan Mantra Tani Warisan Leluhur',
                'dimensi' => 'Tradisi Lisan & Sejarah',
                'deskripsi' => "Kumpulan tembang dan ujaran tani yang dilantunkan dalam kegiatan pertanian. Sebagian bersifat terbatas dan hanya boleh diakses kalangan tertentu.",
                'kata_kunci' => 'tembang, mantra tani, tradisi lisan',
                'narasumber' => 'Sesepuh Desa', 'lokasi' => 'Desa Sobokerto',
                'bahasa' => 'Jawa', 'jenis_media' => 'Teks',
                'tanggal_dokumentasi' => '2026-05-21', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara terbatas', 'status_etis' => 'Terbatas', 'status_kurasi' => 'Terbit',
            ],

            /* ===================== Dimensi: Wisata Komunitas ===================== */
            [
                'judul' => 'Pokdarwis dan Paket Wisata Edukasi Desa',
                'dimensi' => 'Wisata Komunitas',
                'deskripsi' => "Kelompok Sadar Wisata (Pokdarwis) mengelola paket wisata edukasi: belajar mina padi, mengolah hasil ikan, dan menyusuri tepian waduk. Pendapatan dikelola untuk kas dan kegiatan desa.",
                'kata_kunci' => 'pokdarwis, wisata edukasi, komunitas',
                'narasumber' => 'Pokdarwis Sobokerto', 'lokasi' => 'Desa Sobokerto',
                'bahasa' => 'Indonesia', 'jenis_media' => 'Teks',
                'tanggal_dokumentasi' => '2026-05-18', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara Pokdarwis', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],
            [
                'judul' => 'Homestay dan Kuliner Berbasis Warga',
                'dimensi' => 'Wisata Komunitas',
                'deskripsi' => "Beberapa rumah warga disiapkan menjadi homestay sederhana, memberi pengalaman menginap di desa lengkap dengan sajian kuliner rumahan khas Sobokerto.",
                'kata_kunci' => 'homestay, kuliner, ekonomi warga',
                'narasumber' => 'Warga Dukuh Sobokerto', 'lokasi' => 'Desa Sobokerto',
                'bahasa' => 'Indonesia', 'jenis_media' => 'Foto',
                'tanggal_dokumentasi' => '2026-05-19', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],
            [
                'judul' => 'Wisata Perahu Menyusuri Waduk Cengklik',
                'dimensi' => 'Wisata Komunitas',
                'deskripsi' => "Rintisan wisata perahu untuk menikmati panorama dan matahari terbenam di Waduk Cengklik. (Entri masih draf, sedang disusun paketnya.)",
                'kata_kunci' => 'wisata perahu, sunset, rintisan',
                'narasumber' => 'Pokdarwis Sobokerto', 'lokasi' => 'Dermaga Waduk Cengklik',
                'bahasa' => 'Indonesia', 'jenis_media' => 'Teks',
                'tanggal_dokumentasi' => '2026-05-22', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara', 'status_etis' => 'Umum', 'status_kurasi' => 'Draf',
            ],

            /* ===================== Tambahan: Ekologi Waduk Cengklik ===================== */
            [
                'judul' => 'Sempadan Hijau dan Tanaman Tepi Waduk',
                'dimensi' => 'Ekologi Waduk Cengklik',
                'deskripsi' => "Jalur hijau di tepi waduk ditanami pepohonan untuk menahan erosi, menjaga kualitas air, dan menjadi peneduh. Warga merawatnya sebagai bagian dari pelestarian kawasan.",
                'kata_kunci' => 'sempadan, penghijauan, konservasi air',
                'narasumber' => 'Kelompok Tani Hutan', 'lokasi' => 'Tepi Waduk Cengklik',
                'bahasa' => 'Indonesia', 'jenis_media' => 'Teks',
                'tanggal_dokumentasi' => '2026-05-23', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Observasi', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],
            [
                'judul' => 'Gotong Royong Pembersihan Eceng Gondok',
                'dimensi' => 'Ekologi Waduk Cengklik',
                'deskripsi' => "Secara berkala warga bergotong royong mengangkat eceng gondok yang menutup permukaan air. Selain menjaga ekosistem, eceng gondok diolah menjadi kerajinan dan pupuk.",
                'kata_kunci' => 'eceng gondok, gotong royong, ekosistem',
                'narasumber' => 'Karang Taruna', 'lokasi' => 'Waduk Cengklik',
                'bahasa' => 'Indonesia', 'jenis_media' => 'Foto',
                'tanggal_dokumentasi' => '2026-05-24', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Observasi', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],

            /* ===================== Tambahan: Pertanian & Pangan ===================== */
            [
                'judul' => 'Keramba Jaring Apung Ikan Nila',
                'dimensi' => 'Pertanian & Pangan',
                'deskripsi' => "Pembudidaya memanfaatkan perairan waduk untuk keramba jaring apung. Ikan nila menjadi komoditas utama yang menopang ekonomi sekaligus memasok warung kuliner setempat.",
                'kata_kunci' => 'keramba, jaring apung, ikan nila, budidaya',
                'narasumber' => 'Kelompok Pembudidaya Ikan', 'lokasi' => 'Perairan Waduk Cengklik',
                'bahasa' => 'Indonesia', 'jenis_media' => 'Foto',
                'tanggal_dokumentasi' => '2026-05-25', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],
            [
                'judul' => 'Sego Wiwit: Tradisi Syukur Menjelang Panen',
                'dimensi' => 'Pertanian & Pangan',
                'deskripsi' => "Sego wiwit adalah tradisi membagikan nasi beserta lauk khas sebagai ungkapan syukur sebelum panen padi dimulai. Sarat nilai kebersamaan dan rasa terima kasih atas hasil bumi.",
                'kata_kunci' => 'sego wiwit, panen, syukur, tradisi pangan',
                'narasumber' => 'Kelompok Tani', 'lokasi' => 'Area persawahan Sobokerto',
                'bahasa' => 'Jawa', 'jenis_media' => 'Foto',
                'tanggal_dokumentasi' => '2026-05-26', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],
            [
                'judul' => 'Tanaman Obat Keluarga (TOGA) dan Jamu',
                'dimensi' => 'Pertanian & Pangan',
                'deskripsi' => "Banyak rumah memiliki apotek hidup berupa kunyit, jahe, temulawak, dan sereh. Pengetahuan meracik jamu tradisional diwariskan untuk menjaga kesehatan keluarga.",
                'kata_kunci' => 'toga, jamu, tanaman obat, kesehatan',
                'narasumber' => 'Kelompok PKK', 'lokasi' => 'Pekarangan warga',
                'bahasa' => 'Indonesia', 'jenis_media' => 'Teks',
                'tanggal_dokumentasi' => '2026-05-27', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],
            [
                'judul' => 'Peternakan Sapi Perah dan Susu Segar Boyolali',
                'dimensi' => 'Pertanian & Pangan',
                'deskripsi' => "Boyolali dikenal sebagai kota susu. Sebagian warga memelihara sapi perah dan memasok susu segar yang diolah menjadi yogurt, stik susu, dan dodol susu.",
                'kata_kunci' => 'sapi perah, susu segar, boyolali, peternakan',
                'narasumber' => 'Kelompok Peternak', 'lokasi' => 'Dukuh Ngandong',
                'bahasa' => 'Indonesia', 'jenis_media' => 'Foto',
                'tanggal_dokumentasi' => '2026-05-28', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],

            /* ===================== Tambahan: Tradisi Lisan & Sejarah ===================== */
            [
                'judul' => 'Kesenian Jathilan (Kuda Lumping) Desa',
                'dimensi' => 'Tradisi Lisan & Sejarah',
                'deskripsi' => "Jathilan atau kuda lumping adalah kesenian rakyat dengan tarian, gamelan, dan atraksi yang masih hidup di desa. Dipentaskan pada hajatan dan perayaan tertentu.",
                'kata_kunci' => 'jathilan, kuda lumping, kesenian rakyat',
                'narasumber' => 'Sanggar Seni Desa', 'lokasi' => 'Desa Sobokerto',
                'bahasa' => 'Jawa', 'jenis_media' => 'Video',
                'tanggal_dokumentasi' => '2026-05-29', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Dokumentasi pentas', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],
            [
                'judul' => 'Sambatan: Gotong Royong Membangun Rumah',
                'dimensi' => 'Tradisi Lisan & Sejarah',
                'deskripsi' => "Sambatan adalah tradisi saling membantu tanpa upah saat warga membangun atau memperbaiki rumah. Wujud nyata semangat gotong royong yang masih lestari.",
                'kata_kunci' => 'sambatan, gotong royong, kebersamaan',
                'narasumber' => 'Tokoh Masyarakat', 'lokasi' => 'Desa Sobokerto',
                'bahasa' => 'Jawa', 'jenis_media' => 'Teks',
                'tanggal_dokumentasi' => '2026-05-30', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],
            [
                'judul' => 'Permainan Tradisional Anak Desa',
                'dimensi' => 'Tradisi Lisan & Sejarah',
                'deskripsi' => "Dakon, gobak sodor, egrang, dan benthik masih dimainkan anak-anak. Permainan ini melatih kerja sama, kejujuran, dan kebugaran tanpa gawai.",
                'kata_kunci' => 'permainan tradisional, dakon, gobak sodor',
                'narasumber' => 'Karang Taruna', 'lokasi' => 'Desa Sobokerto',
                'bahasa' => 'Jawa', 'jenis_media' => 'Foto',
                'tanggal_dokumentasi' => '2026-05-31', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Observasi', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],

            /* ===================== Tambahan: Wisata Komunitas ===================== */
            [
                'judul' => 'Pasar Kuliner Tepi Waduk Akhir Pekan',
                'dimensi' => 'Wisata Komunitas',
                'deskripsi' => "Setiap akhir pekan, warga membuka lapak kuliner tradisional di tepi waduk: pecel, jenang, gethuk, hingga olahan ikan. Mengangkat ekonomi sekaligus daya tarik wisata.",
                'kata_kunci' => 'pasar kuliner, akhir pekan, ekonomi warga',
                'narasumber' => 'Pokdarwis Sobokerto', 'lokasi' => 'Tepi Waduk Cengklik',
                'bahasa' => 'Indonesia', 'jenis_media' => 'Foto',
                'tanggal_dokumentasi' => '2026-06-01', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],
            [
                'judul' => 'Wisata Sepeda Keliling Desa dan Persawahan',
                'dimensi' => 'Wisata Komunitas',
                'deskripsi' => "Rute bersepeda santai menyusuri jalan desa, pematang sawah, dan tepi waduk. Cocok untuk wisata sehat keluarga sambil mengenal kehidupan agraris.",
                'kata_kunci' => 'sepeda, wisata sehat, persawahan',
                'narasumber' => 'Komunitas Sepeda', 'lokasi' => 'Desa Sobokerto',
                'bahasa' => 'Indonesia', 'jenis_media' => 'Teks',
                'tanggal_dokumentasi' => '2026-06-02', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],

            /* ===================== Tambahan Lanjutan: Ekologi ===================== */
            [
                'judul' => 'Larangan Menangkap Ikan Saat Musim Pemijahan',
                'dimensi' => 'Ekologi Waduk Cengklik',
                'deskripsi' => "Kesepakatan warga untuk tidak menangkap ikan pada masa pemijahan agar populasi ikan tetap lestari. Sebuah kearifan menjaga keberlanjutan sumber daya perairan.",
                'kata_kunci' => 'pemijahan, konservasi ikan, kesepakatan warga',
                'narasumber' => 'Kelompok Pembudidaya Ikan', 'lokasi' => 'Waduk Cengklik',
                'bahasa' => 'Indonesia', 'jenis_media' => 'Teks',
                'tanggal_dokumentasi' => '2026-06-03', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],
            [
                'judul' => 'Bank Sampah dan Pengelolaan Limbah Desa',
                'dimensi' => 'Ekologi Waduk Cengklik',
                'deskripsi' => "Warga mengelola bank sampah untuk memilah dan mendaur ulang limbah rumah tangga, menjaga kebersihan desa dan kualitas air waduk.",
                'kata_kunci' => 'bank sampah, daur ulang, kebersihan',
                'narasumber' => 'Karang Taruna', 'lokasi' => 'Desa Sobokerto',
                'bahasa' => 'Indonesia', 'jenis_media' => 'Foto',
                'tanggal_dokumentasi' => '2026-06-04', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Observasi', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],

            /* ===================== Tambahan Lanjutan: Pertanian & Pangan ===================== */
            [
                'judul' => 'Tegalan dan Tanaman Palawija',
                'dimensi' => 'Pertanian & Pangan',
                'deskripsi' => "Di lahan tegalan, warga menanam palawija seperti jagung, kacang tanah, dan kedelai sebagai penyelang musim padi untuk menjaga ketahanan pangan.",
                'kata_kunci' => 'tegalan, palawija, jagung, ketahanan pangan',
                'narasumber' => 'Kelompok Tani', 'lokasi' => 'Lahan tegalan Sobokerto',
                'bahasa' => 'Indonesia', 'jenis_media' => 'Teks',
                'tanggal_dokumentasi' => '2026-06-05', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],
            [
                'judul' => 'Pembuatan Pupuk Organik dan Kompos',
                'dimensi' => 'Pertanian & Pangan',
                'deskripsi' => "Petani mengolah kotoran ternak dan sisa tanaman menjadi pupuk organik. Praktik ini menekan biaya, menyuburkan tanah, dan ramah lingkungan.",
                'kata_kunci' => 'pupuk organik, kompos, pertanian ramah lingkungan',
                'narasumber' => 'Kelompok Tani', 'lokasi' => 'Desa Sobokerto',
                'bahasa' => 'Indonesia', 'jenis_media' => 'Teks',
                'tanggal_dokumentasi' => '2026-06-06', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],
            [
                'judul' => 'Kuliner Tradisional: Nasi Jagung dan Tiwul',
                'dimensi' => 'Pertanian & Pangan',
                'deskripsi' => "Nasi jagung dan tiwul (olahan singkong) adalah pangan lokal warisan yang kini diangkat kembali sebagai sajian khas bernilai gizi dan budaya.",
                'kata_kunci' => 'nasi jagung, tiwul, pangan lokal, singkong',
                'narasumber' => 'Kelompok PKK', 'lokasi' => 'Desa Sobokerto',
                'bahasa' => 'Jawa', 'jenis_media' => 'Foto',
                'tanggal_dokumentasi' => '2026-06-07', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],
            [
                'judul' => 'Tradisi Lumbung Padi Desa',
                'dimensi' => 'Pertanian & Pangan',
                'deskripsi' => "Lumbung padi menjadi cadangan pangan bersama untuk menghadapi paceklik. Sistem ini mencerminkan kearifan mengelola hasil panen secara gotong royong.",
                'kata_kunci' => 'lumbung padi, cadangan pangan, gotong royong',
                'narasumber' => 'Tokoh Masyarakat', 'lokasi' => 'Desa Sobokerto',
                'bahasa' => 'Jawa', 'jenis_media' => 'Teks',
                'tanggal_dokumentasi' => '2026-06-08', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],

            /* ===================== Tambahan Lanjutan: Tradisi Lisan & Sejarah ===================== */
            [
                'judul' => 'Karawitan dan Gamelan Desa',
                'dimensi' => 'Tradisi Lisan & Sejarah',
                'deskripsi' => "Kelompok karawitan desa melestarikan musik gamelan Jawa yang mengiringi berbagai upacara dan pertunjukan. Latihan rutin menjadi wadah regenerasi pemain muda.",
                'kata_kunci' => 'karawitan, gamelan, musik jawa',
                'narasumber' => 'Sanggar Seni Desa', 'lokasi' => 'Desa Sobokerto',
                'bahasa' => 'Jawa', 'jenis_media' => 'Video',
                'tanggal_dokumentasi' => '2026-06-09', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Dokumentasi', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],
            [
                'judul' => 'Wayang Kulit dan Dalang Lokal',
                'dimensi' => 'Tradisi Lisan & Sejarah',
                'deskripsi' => "Pergelaran wayang kulit pada acara bersih desa dan hajatan, sarat pesan moral. Desa memiliki dalang yang menjaga tradisi pakeliran tetap hidup.",
                'kata_kunci' => 'wayang kulit, dalang, pakeliran',
                'narasumber' => 'Dalang Desa', 'lokasi' => 'Desa Sobokerto',
                'bahasa' => 'Jawa', 'jenis_media' => 'Foto',
                'tanggal_dokumentasi' => '2026-06-10', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],
            [
                'judul' => 'Upacara Daur Hidup: Mitoni dan Tedhak Siten',
                'dimensi' => 'Tradisi Lisan & Sejarah',
                'deskripsi' => "Rangkaian upacara daur hidup seperti mitoni (tujuh bulanan) dan tedhak siten (turun tanah) masih dijalankan sebagai ungkapan syukur dan doa.",
                'kata_kunci' => 'mitoni, tedhak siten, upacara adat, daur hidup',
                'narasumber' => 'Sesepuh Desa', 'lokasi' => 'Desa Sobokerto',
                'bahasa' => 'Jawa', 'jenis_media' => 'Teks',
                'tanggal_dokumentasi' => '2026-06-11', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],

            /* ===================== Tambahan Lanjutan: Wisata Komunitas ===================== */
            [
                'judul' => 'Outbound dan Wisata Edukasi Anak',
                'dimensi' => 'Wisata Komunitas',
                'deskripsi' => "Paket outbound di tepi waduk untuk anak dan pelajar: permainan kerja sama, mengenal alam, dan belajar bertani. Dikelola Pokdarwis bersama karang taruna.",
                'kata_kunci' => 'outbound, edukasi anak, pokdarwis',
                'narasumber' => 'Pokdarwis Sobokerto', 'lokasi' => 'Tepi Waduk Cengklik',
                'bahasa' => 'Indonesia', 'jenis_media' => 'Foto',
                'tanggal_dokumentasi' => '2026-06-12', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],
            [
                'judul' => 'Galeri Produk UMKM Desa (BUMDes)',
                'dimensi' => 'Wisata Komunitas',
                'deskripsi' => "BUMDes mengelola galeri yang memajang produk UMKM warga: olahan ikan, kerajinan, dan oleh-oleh khas, sebagai etalase ekonomi desa.",
                'kata_kunci' => 'bumdes, umkm, galeri produk, oleh-oleh',
                'narasumber' => 'Pengurus BUMDes', 'lokasi' => 'Balai Desa Sobokerto',
                'bahasa' => 'Indonesia', 'jenis_media' => 'Foto',
                'tanggal_dokumentasi' => '2026-06-13', 'pendokumentasi' => 'Tim KKN Tematik',
                'sumber' => 'Wawancara', 'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
            ],
        ];

        foreach ($data as $row) {
            $entri = KearifanLokal::firstOrNew(['judul' => $row['judul']]);
            $entri->fill($row);
            if (! $entri->exists) {
                $entri->kode_entri = KearifanLokal::kodeBerikutnya();
                $entri->dibuat_oleh = $pengelola?->id;
            }
            $entri->save();
        }

        $this->command->info('Seeder Kearifan Lokal: ' . count($data) . ' entri (merata di 4 dimensi, beragam status).');
    }
}
