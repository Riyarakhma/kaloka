<?php

namespace Database\Seeders;

use App\Models\Wisata;
use Illuminate\Database\Seeder;

class WisataSeeder extends Seeder
{
    public function run(): void
    {
        // Koordinat di kawasan Waduk Cengklik, Kec. Ngemplak, Kab. Boyolali.
        // Nilai bersifat perkiraan area & dapat disempurnakan lewat menu edit.
        $data = [
            [
                'nama_spot' => 'Waduk Cengklik',
                'kategori' => 'Destinasi',
                'deskripsi' => "Daya tarik utama kawasan: bendungan peninggalan era kolonial dengan panorama luas berlatar Gunung Merapi dan Merbabu. Paling memikat saat matahari terbit dan terbenam. Cocok untuk bersantai, memancing, dan menikmati kuliner ikan air tawar.",
                'lokasi' => 'Ngemplak, Boyolali', 'koordinat' => '-7.5306,110.7460',
                'jam_operasional' => '06.00 - 18.00', 'kontak' => 'Pokdarwis Sobokerto',
                'foto' => null, 'status_tampil' => true,
            ],
            [
                'nama_spot' => 'Waduk Cengklik Park',
                'kategori' => 'Destinasi',
                'deskripsi' => "Taman wisata tepi waduk dengan beragam wahana, spot foto, dan area bermain keluarga. Dikenal dengan julukan wisata seribu view karena panoramanya yang luas ke arah waduk.",
                'lokasi' => 'Senting, Sobokerto, Ngemplak, Boyolali', 'koordinat' => '-7.5258,110.7503',
                'jam_operasional' => '08.00 - 18.00', 'kontak' => 'Pengelola Waduk Cengklik Park',
                'foto' => null, 'status_tampil' => true,
            ],
            [
                'nama_spot' => 'Spot Sunset dan Mancing Tepi Waduk',
                'kategori' => 'Destinasi',
                'deskripsi' => "Titik favorit warga untuk memancing dan menikmati matahari terbenam. Suasana tenang dengan pemandangan air yang memantulkan langit senja.",
                'lokasi' => 'Tepi barat Waduk Cengklik', 'koordinat' => '-7.5331,110.7418',
                'jam_operasional' => '05.00 - 18.30', 'kontak' => 'Komunitas Pemancing',
                'foto' => null, 'status_tampil' => true,
            ],
            [
                'nama_spot' => 'Warung Apung Ikan Bakar Cengklik',
                'kategori' => 'Kuliner',
                'deskripsi' => "Deretan warung tepi waduk yang menyajikan ikan nila dan gurami bakar segar hasil tangkapan lokal, dengan pemandangan langsung ke perairan Waduk Cengklik.",
                'lokasi' => 'Tepi Waduk Cengklik', 'koordinat' => '-7.5312,110.7479',
                'jam_operasional' => '10.00 - 21.00', 'kontak' => '0812-0000-0001',
                'foto' => null, 'status_tampil' => true,
            ],
            [
                'nama_spot' => 'Sentra Olahan Ikan (Abon & Keripik)',
                'kategori' => 'Kuliner',
                'deskripsi' => "Pusat produksi olahan ikan oleh kelompok PKK: abon lele, keripik belut, dan nugget ikan. Tersedia oleh-oleh khas desa dan demo proses pembuatan.",
                'lokasi' => 'Dukuh Sobokerto', 'koordinat' => '-7.5189,110.7561',
                'jam_operasional' => '08.00 - 16.00', 'kontak' => 'Kelompok PKK Desa',
                'foto' => null, 'status_tampil' => true,
            ],
            [
                'nama_spot' => 'Sentra Kerajinan Anyaman Bambu',
                'kategori' => 'Kerajinan',
                'deskripsi' => "Kelompok pengrajin desa yang memproduksi aneka anyaman bambu seperti besek, tampah, dan suvenir khas. Pengunjung dapat melihat proses pembuatan secara langsung.",
                'lokasi' => 'Dukuh Ngandong', 'koordinat' => '-7.5162,110.7588',
                'jam_operasional' => '08.00 - 16.00', 'kontak' => 'Kelompok Pengrajin',
                'foto' => null, 'status_tampil' => true,
            ],
            [
                'nama_spot' => 'Paket Wisata Edukasi Mina Padi',
                'kategori' => 'Destinasi',
                'deskripsi' => "Wisata edukasi bersama Pokdarwis: belajar bertani mina padi, memberi makan ikan, dan mengenal pengelolaan air waduk. Cocok untuk rombongan sekolah & keluarga.",
                'lokasi' => 'Area persawahan Sobokerto', 'koordinat' => '-7.5210,110.7530',
                'jam_operasional' => '08.00 - 15.00 (reservasi)', 'kontak' => 'Pokdarwis Sobokerto',
                'foto' => null, 'status_tampil' => true,
            ],
            [
                'nama_spot' => 'Festival Sedekah Waduk (Bersih Desa)',
                'kategori' => 'Event',
                'deskripsi' => "Agenda tahunan berupa kirab budaya dan ungkapan syukur atas berkah air waduk. Jadwal mengikuti penanggalan Jawa; informasi menyusul menjelang pelaksanaan.",
                'lokasi' => 'Desa Sobokerto', 'koordinat' => '-7.5200,110.7548',
                'jam_operasional' => 'Tahunan (sesuai jadwal adat)', 'kontak' => 'Pemerintah Desa',
                'foto' => null, 'status_tampil' => true,
            ],

            /* ===================== Tambahan ===================== */
            [
                'nama_spot' => 'Dermaga dan Perahu Wisata Cengklik',
                'kategori' => 'Destinasi',
                'deskripsi' => "Titik naik perahu untuk menyusuri perairan waduk. Nikmati panorama air yang luas dan udara segar bersama keluarga.",
                'lokasi' => 'Tepi Waduk Cengklik', 'koordinat' => '-7.5292,110.7468',
                'jam_operasional' => '07.00 - 17.00', 'kontak' => 'Pokdarwis Sobokerto',
                'foto' => null, 'status_tampil' => true,
            ],
            [
                'nama_spot' => 'Camping Ground Tepi Waduk',
                'kategori' => 'Destinasi',
                'deskripsi' => "Area berkemah di tepi waduk dengan suasana tenang. Cocok untuk kegiatan komunitas, keluarga, dan menikmati langit malam.",
                'lokasi' => 'Tepi selatan Waduk Cengklik', 'koordinat' => '-7.5340,110.7406',
                'jam_operasional' => '24 jam (reservasi)', 'kontak' => 'Pokdarwis Sobokerto',
                'foto' => null, 'status_tampil' => true,
            ],
            [
                'nama_spot' => 'Gardu Pandang Sunrise Cengklik',
                'kategori' => 'Destinasi',
                'deskripsi' => "Spot terbaik menyaksikan matahari terbit dengan siluet Gunung Merapi-Merbabu dan kabut tipis di atas permukaan waduk.",
                'lokasi' => 'Bukit tepi Waduk Cengklik', 'koordinat' => '-7.5347,110.7432',
                'jam_operasional' => '05.00 - 09.00', 'kontak' => 'Pokdarwis Sobokerto',
                'foto' => null, 'status_tampil' => true,
            ],
            [
                'nama_spot' => 'Pasar Kuliner Akhir Pekan Cengklik',
                'kategori' => 'Kuliner',
                'deskripsi' => "Lapak kuliner tradisional yang buka tiap akhir pekan: pecel, gethuk, jenang, dan jajanan pasar, ditemani pemandangan waduk.",
                'lokasi' => 'Tepi Waduk Cengklik', 'koordinat' => '-7.5276,110.7491',
                'jam_operasional' => 'Sabtu-Minggu 06.00 - 12.00', 'kontak' => 'Paguyuban Pedagang',
                'foto' => null, 'status_tampil' => true,
            ],
            [
                'nama_spot' => 'Kedai Kopi View Waduk',
                'kategori' => 'Kuliner',
                'deskripsi' => "Kedai kopi sederhana menghadap waduk, tempat bersantai menikmati kopi lokal sambil memandang air dan langit senja.",
                'lokasi' => 'Senting, Sobokerto', 'koordinat' => '-7.5261,110.7499',
                'jam_operasional' => '09.00 - 21.00', 'kontak' => '0812-0000-0002',
                'foto' => null, 'status_tampil' => true,
            ],
            [
                'nama_spot' => 'Sentra Susu Segar dan Yogurt Boyolali',
                'kategori' => 'Kuliner',
                'deskripsi' => "Mencicipi susu segar khas Boyolali beserta olahannya: yogurt, stik susu, dan dodol susu langsung dari peternak.",
                'lokasi' => 'Dukuh Ngandong', 'koordinat' => '-7.5152,110.7602',
                'jam_operasional' => '07.00 - 17.00', 'kontak' => 'Kelompok Peternak',
                'foto' => null, 'status_tampil' => true,
            ],
            [
                'nama_spot' => 'Kerajinan Eceng Gondok',
                'kategori' => 'Kerajinan',
                'deskripsi' => "Eceng gondok dari waduk disulap menjadi tas, tikar, dan suvenir bernilai jual. Pengunjung bisa melihat dan mencoba proses pembuatannya.",
                'lokasi' => 'Dukuh Sobokerto', 'koordinat' => '-7.5233,110.7521',
                'jam_operasional' => '08.00 - 16.00', 'kontak' => 'Kelompok Pengrajin',
                'foto' => null, 'status_tampil' => true,
            ],
            [
                'nama_spot' => 'Pentas Jathilan Desa',
                'kategori' => 'Event',
                'deskripsi' => "Pertunjukan kesenian jathilan (kuda lumping) lengkap dengan gamelan dan atraksi, digelar pada hajatan dan perayaan desa.",
                'lokasi' => 'Lapangan Desa Sobokerto', 'koordinat' => '-7.5205,110.7545',
                'jam_operasional' => 'Sesuai jadwal pentas', 'kontak' => 'Sanggar Seni Desa',
                'foto' => null, 'status_tampil' => true,
            ],

            /* ===================== Tambahan Lanjutan ===================== */
            [
                'nama_spot' => 'Taman Bermain Anak Tepi Waduk',
                'kategori' => 'Destinasi',
                'deskripsi' => "Area bermain anak dengan ayunan, perosotan, dan ruang terbuka hijau. Tempat keluarga bersantai sambil mengawasi anak bermain.",
                'lokasi' => 'Tepi Waduk Cengklik', 'koordinat' => '-7.5269,110.7485',
                'jam_operasional' => '07.00 - 18.00', 'kontak' => 'Pokdarwis Sobokerto',
                'foto' => null, 'status_tampil' => true,
            ],
            [
                'nama_spot' => 'Spot Foto Jembatan Cengklik',
                'kategori' => 'Destinasi',
                'deskripsi' => "Jembatan kayu dan dek foto menjorok ke arah air, menjadi latar swafoto favorit dengan panorama waduk dan gunung.",
                'lokasi' => 'Tepi Waduk Cengklik', 'koordinat' => '-7.5301,110.7472',
                'jam_operasional' => '06.00 - 18.00', 'kontak' => 'Pokdarwis Sobokerto',
                'foto' => null, 'status_tampil' => true,
            ],
            [
                'nama_spot' => 'Agrowisata Petik Sayur',
                'kategori' => 'Destinasi',
                'deskripsi' => "Kebun sayur warga yang dibuka untuk wisata petik langsung. Pengunjung belajar berkebun sekaligus membawa pulang sayuran segar.",
                'lokasi' => 'Lahan pertanian Sobokerto', 'koordinat' => '-7.5175,110.7575',
                'jam_operasional' => '07.00 - 15.00', 'kontak' => 'Kelompok Tani',
                'foto' => null, 'status_tampil' => true,
            ],
            [
                'nama_spot' => 'Angkringan Malam Cengklik',
                'kategori' => 'Kuliner',
                'deskripsi' => "Suasana malam dengan deretan angkringan: nasi kucing, sate usus, dan wedang jahe, ditemani gemerlap lampu tepi waduk.",
                'lokasi' => 'Tepi Waduk Cengklik', 'koordinat' => '-7.5283,110.7488',
                'jam_operasional' => '17.00 - 23.00', 'kontak' => 'Paguyuban Pedagang',
                'foto' => null, 'status_tampil' => true,
            ],
            [
                'nama_spot' => 'Rumah Makan Lesehan Tepi Waduk',
                'kategori' => 'Kuliner',
                'deskripsi' => "Lesehan keluarga dengan menu khas pedesaan: ayam kampung, pecel lele, dan sambal terasi, berlatar pemandangan waduk.",
                'lokasi' => 'Tepi Waduk Cengklik', 'koordinat' => '-7.5314,110.7475',
                'jam_operasional' => '10.00 - 21.00', 'kontak' => '0812-0000-0003',
                'foto' => null, 'status_tampil' => true,
            ],
            [
                'nama_spot' => 'Galeri Oleh-oleh BUMDes',
                'kategori' => 'Kerajinan',
                'deskripsi' => "Etalase produk UMKM desa: olahan ikan, anyaman bambu, kerajinan eceng gondok, dan camilan khas sebagai buah tangan.",
                'lokasi' => 'Balai Desa Sobokerto', 'koordinat' => '-7.5198,110.7558',
                'jam_operasional' => '08.00 - 17.00', 'kontak' => 'Pengurus BUMDes',
                'foto' => null, 'status_tampil' => true,
            ],
            [
                'nama_spot' => 'Sentra Batik Tulis Desa',
                'kategori' => 'Kerajinan',
                'deskripsi' => "Perajin batik tulis dengan motif terinspirasi alam waduk dan pertanian. Pengunjung dapat melihat dan mencoba membatik.",
                'lokasi' => 'Dukuh Sobokerto', 'koordinat' => '-7.5221,110.7533',
                'jam_operasional' => '08.00 - 16.00', 'kontak' => 'Kelompok Perajin Batik',
                'foto' => null, 'status_tampil' => true,
            ],
            [
                'nama_spot' => 'Lomba Mancing Tahunan Cengklik',
                'kategori' => 'Event',
                'deskripsi' => "Ajang lomba memancing tahunan yang menarik peserta dari berbagai daerah, sekaligus mempromosikan wisata dan ekonomi tepi waduk.",
                'lokasi' => 'Tepi Waduk Cengklik', 'koordinat' => '-7.5320,110.7448',
                'jam_operasional' => 'Tahunan (sesuai jadwal panitia)', 'kontak' => 'Panitia/Pokdarwis',
                'foto' => null, 'status_tampil' => true,
            ],
        ];

        foreach ($data as $row) {
            $spot = Wisata::firstOrNew(['nama_spot' => $row['nama_spot']]);
            $spot->fill($row)->save();
        }

        $this->command->info('Seeder Wisata: ' . count($data) . ' spot (4 kategori, koordinat area Waduk Cengklik).');
    }
}
