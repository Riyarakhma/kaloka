<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Umkm;

class UmkmSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            [
                'nama_umkm' => 'Batik Sobokerto',
                'kategori' => 'Kerajinan',
                'deskripsi' => 'UMKM yang memproduksi batik khas Desa Sobokerto dengan motif yang terinspirasi dari budaya lokal.',
                'pemilik' => 'Ibu Siti',
                'alamat' => 'Desa Sobokerto, Ngemplak, Boyolali',
                'kontak' => '081234567890',
                'foto' => [
                    'batik.jpg'
                ],
                'status_tampil' => 1,
            ],

            [
                'nama_umkm' => 'Ecoprint Sobokerto',
                'kategori' => 'Kerajinan',
                'deskripsi' => 'Produk kain ecoprint menggunakan bahan alami seperti daun dan bunga yang ramah lingkungan.',
                'pemilik' => 'Ibu Rini',
                'alamat' => 'Dukuh Sobokerto',
                'kontak' => '082345678901',
                'foto' => [
                    'ecoprint.jpg'
                ],
                'status_tampil' => 1,
            ],

            [
                'nama_umkm' => 'Olahan Lele Sobokerto',
                'kategori' => 'Kuliner',
                'deskripsi' => 'Produk olahan ikan lele seperti abon lele dan makanan ringan berbahan dasar hasil perikanan warga.',
                'pemilik' => 'Kelompok PKK Desa',
                'alamat' => 'Desa Sobokerto',
                'kontak' => '083456789012',
                'foto' => [
                    'abon-lele.jpg'
                ],
                'status_tampil' => 1,
            ],

            [
                'nama_umkm' => 'Keripik Belut Sobokerto',
                'kategori' => 'Kuliner',
                'deskripsi' => 'Keripik belut khas desa dengan cita rasa gurih yang menjadi salah satu produk unggulan warga.',
                'pemilik' => 'Pak Sumarno',
                'alamat' => 'Dukuh Ngandong',
                'kontak' => '084567890123',
                'foto' => [
                    'keripik-belut.jpg'
                ],
                'status_tampil' => 1,
            ],

            [
                'nama_umkm' => 'Budidaya Ikan Nila Cengklik',
                'kategori' => 'Budidaya',
                'deskripsi' => 'Budidaya ikan nila menggunakan potensi perairan Waduk Cengklik sebagai sumber ekonomi masyarakat.',
                'pemilik' => 'Kelompok Pembudidaya Ikan',
                'alamat' => 'Area Waduk Cengklik',
                'kontak' => '085678901234',
                'foto' => [
                    'ikan-nila.jpg'
                ],
                'status_tampil' => 1,
            ],

            [
                'nama_umkm' => 'Pupuk Organik Eceng Gondok',
                'kategori' => 'Pertanian',
                'deskripsi' => 'Pemanfaatan eceng gondok Waduk Cengklik menjadi pupuk organik bernilai ekonomi.',
                'pemilik' => 'Kelompok Tani Sobokerto',
                'alamat' => 'Desa Sobokerto',
                'kontak' => '086789012345',
                'foto' => [
                    'pupuk.jpg'
                ],
                'status_tampil' => 1,
            ],

        ];


        foreach ($data as $item) {
            Umkm::updateOrCreate(
                [
                    'nama_umkm' => $item['nama_umkm']
                ],
                $item
            );
        }


        $this->command->info(
            'Seeder UMKM berhasil: '.count($data).' data'
        );
    }
}