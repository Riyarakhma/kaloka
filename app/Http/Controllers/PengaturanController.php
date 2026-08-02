<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use App\Services\Gambar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    /**
     * Menampilkan halaman pengaturan situs.
     */
    public function edit()
    {
        $nilai = [];

        foreach (Pengaturan::BAWAAN as $kunci => $info) {
            $nilai[$kunci] = Pengaturan::ambil($kunci);
        }

        return view('pengelola.pengaturan.edit', [
            'daftar' => Pengaturan::BAWAAN,
            'nilai'  => $nilai,
        ]);
    }

    /**
     * Menyimpan perubahan pengaturan situs.
     */
    public function update(Request $request)
    {
        $data = $request->validate(
            [
                'nama_situs'       => ['required', 'string', 'max:255'],
                'kontak'           => ['nullable', 'string', 'max:500'],
                'teks_sambutan'    => ['nullable', 'string', 'max:1000'],
                'url_opac_slims'   => ['nullable', 'url', 'max:255'],
                'url_youtube'      => ['nullable', 'url', 'max:255'],
                'footer_alamat'    => ['nullable', 'string', 'max:500'],
                'footer_telepon'   => ['nullable', 'string', 'max:100'],
                'footer_email'     => ['nullable', 'email', 'max:255'],
                'footer_instagram' => ['nullable', 'string', 'max:100'],

                /*
                 * Format logo yang diperbolehkan.
                 *
                 * JPG, JPEG, PNG, dan WebP akan otomatis:
                 * - dipotong menjadi persegi,
                 * - di-resize menjadi 500 × 500,
                 * - disimpan dengan ukuran seragam.
                 *
                 * SVG tetap dapat diupload, tetapi tidak diproses oleh GD.
                 */
                'logo' => [
                    'nullable',
                    'image',
                    'mimes:png,jpg,jpeg,webp,svg',
                    'max:2048',
                ],
            ],
            [
                'required' => 'Kolom :attribute wajib diisi.',
                'url'      => ':attribute harus berupa alamat yang valid, misalnya https://...',
                'email'    => ':attribute harus berupa alamat email yang valid.',

                'logo.image' => 'Logo harus berupa file gambar.',
                'logo.mimes' => 'Format logo harus PNG, JPG, JPEG, WebP, atau SVG.',
                'logo.max'   => 'Ukuran logo maksimal 2 MB.',
            ],
            [
                'nama_situs'       => 'nama situs',
                'kontak'           => 'kontak',
                'teks_sambutan'    => 'teks sambutan',
                'url_opac_slims'   => 'URL OPAC SLiMS',
                'url_youtube'      => 'URL video YouTube',
                'footer_alamat'    => 'alamat footer',
                'footer_telepon'   => 'nomor telepon footer',
                'footer_email'     => 'email footer',
                'footer_instagram' => 'Instagram footer',
                'logo'             => 'logo',
            ]
        );

        /*
         * Logo ditangani secara terpisah karena berupa file.
         */
        unset($data['logo']);

        /*
         * Simpan seluruh pengaturan berupa teks.
         */
        foreach ($data as $kunci => $nilai) {
            Pengaturan::simpan($kunci, $nilai);
        }

        /*
         * Jika ada logo baru yang diupload.
         */
        if ($request->hasFile('logo')) {
            $fileLogo = $request->file('logo');

            /*
             * Simpan logo baru terlebih dahulu.
             *
             * Method simpanLogo() akan membuat gambar menjadi:
             * - rasio persegi 1:1,
             * - ukuran 500 × 500 piksel,
             * - crop dari bagian tengah.
             */
            $pathBaru = Gambar::simpanLogo(
                $fileLogo,
                'situs',
                500
            );

            /*
             * Ambil path logo lama.
             */
            $pathLama = Pengaturan::ambil('logo');

            /*
             * Simpan path logo baru ke database.
             */
            Pengaturan::simpan('logo', $pathBaru);

            /*
             * Hapus logo lama setelah logo baru berhasil disimpan.
             *
             * Pengecekan ini mencegah file baru ikut terhapus
             * jika path lama dan baru kebetulan sama.
             */
            if (
                $pathLama
                && $pathLama !== $pathBaru
                && Storage::disk('public')->exists($pathLama)
            ) {
                Storage::disk('public')->delete($pathLama);
            }
        }

        return back()->with(
            'sukses',
            'Pengaturan situs berhasil disimpan.'
        );
    }
}