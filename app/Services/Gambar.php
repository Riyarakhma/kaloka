<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * Bantuan penyimpanan berkas dengan kompres/resize otomatis untuk gambar.
 *
 * - Gambar umum menggunakan method simpan().
 * - Logo situs menggunakan method simpanLogo() agar otomatis menjadi persegi.
 * - Berkas non-gambar disimpan apa adanya.
 *
 * Path yang dikembalikan relatif terhadap disk public,
 * misalnya: situs/abc123.png
 */
class Gambar
{
    /**
     * Menyimpan gambar umum tanpa memotong rasio gambar.
     *
     * Cocok untuk:
     * - Foto Kearifan Lokal
     * - Foto Wisata
     * - Foto UMKM
     * - Dokumen atau file umum
     */
    public static function simpan(
        UploadedFile $file,
        string $folder,
        int $lebarMaks = 1280
    ): string {
        $ext = strtolower($file->getClientOriginalExtension());

        $jenisGambar = [
            'jpg',
            'jpeg',
            'png',
            'webp',
        ];

        /*
         * File selain JPG, JPEG, PNG, dan WEBP
         * disimpan langsung tanpa diproses GD.
         */
        if (
            ! in_array($ext, $jenisGambar, true)
            || ! function_exists('imagecreatefromstring')
        ) {
            return $file->store($folder, 'public');
        }

        $info = @getimagesize($file->getRealPath());

        if ($info === false) {
            return $file->store($folder, 'public');
        }

        [$lebar, $tinggi] = $info;

        $isiFile = @file_get_contents($file->getRealPath());

        if ($isiFile === false) {
            return $file->store($folder, 'public');
        }

        $src = @imagecreatefromstring($isiFile);

        if (! $src) {
            return $file->store($folder, 'public');
        }

        /*
         * Resize hanya jika lebar gambar melebihi batas.
         * Rasio asli gambar tetap dipertahankan.
         */
        if ($lebar > $lebarMaks) {
            $tinggiBaru = (int) round(
                $tinggi * $lebarMaks / $lebar
            );

            $dst = imagecreatetruecolor(
                $lebarMaks,
                $tinggiBaru
            );

            /*
             * Pertahankan transparansi PNG dan WebP.
             */
            imagealphablending($dst, false);
            imagesavealpha($dst, true);

            $transparan = imagecolorallocatealpha(
                $dst,
                0,
                0,
                0,
                127
            );

            imagefill(
                $dst,
                0,
                0,
                $transparan
            );

            imagecopyresampled(
                $dst,
                $src,
                0,
                0,
                0,
                0,
                $lebarMaks,
                $tinggiBaru,
                $lebar,
                $tinggi
            );

            imagedestroy($src);

            $src = $dst;
        }

        $extSimpan = $ext === 'jpeg'
            ? 'jpg'
            : $ext;

        $namaRelatif = $folder
            . '/'
            . Str::random(40)
            . '.'
            . $extSimpan;

        $tujuan = storage_path(
            'app/public/' . $namaRelatif
        );

        if (! is_dir(dirname($tujuan))) {
            mkdir(
                dirname($tujuan),
                0775,
                true
            );
        }

        self::simpanResourceGambar(
            $src,
            $tujuan,
            $extSimpan
        );

        imagedestroy($src);

        return $namaRelatif;
    }

    /**
     * Menyimpan logo situs dalam bentuk persegi.
     *
     * Semua gambar akan:
     * - di-crop dari bagian tengah,
     * - dibuat menjadi rasio 1:1,
     * - di-resize ke ukuran yang sama,
     * - tetap mendukung transparansi PNG dan WebP.
     *
     * Cocok untuk logo situs supaya tidak ada yang
     * terlihat pendek, lonjong, atau terlalu kecil.
     */
    public static function simpanLogo(
        UploadedFile $file,
        string $folder = 'situs',
        int $ukuran = 500
    ): string {
        $ext = strtolower($file->getClientOriginalExtension());

        $jenisGambar = [
            'jpg',
            'jpeg',
            'png',
            'webp',
        ];

        /*
         * SVG dan format lain tidak dapat diproses oleh GD.
         * Simpan langsung tanpa crop.
         */
        if (
            ! in_array($ext, $jenisGambar, true)
            || ! function_exists('imagecreatefromstring')
        ) {
            return $file->store($folder, 'public');
        }

        $info = @getimagesize($file->getRealPath());

        if ($info === false) {
            return $file->store($folder, 'public');
        }

        [$lebarAsli, $tinggiAsli] = $info;

        $isiFile = @file_get_contents(
            $file->getRealPath()
        );

        if ($isiFile === false) {
            return $file->store($folder, 'public');
        }

        $src = @imagecreatefromstring($isiFile);

        if (! $src) {
            return $file->store($folder, 'public');
        }

        /*
         * Tentukan sisi terpendek agar crop menjadi persegi.
         */
        $sisiCrop = min(
            $lebarAsli,
            $tinggiAsli
        );

        /*
         * Crop dari tengah gambar.
         */
        $posisiX = (int) floor(
            ($lebarAsli - $sisiCrop) / 2
        );

        $posisiY = (int) floor(
            ($tinggiAsli - $sisiCrop) / 2
        );

        /*
         * Buat gambar tujuan dengan ukuran persegi.
         */
        $dst = imagecreatetruecolor(
            $ukuran,
            $ukuran
        );

        /*
         * Pertahankan transparansi PNG dan WebP.
         */
        imagealphablending($dst, false);
        imagesavealpha($dst, true);

        $transparan = imagecolorallocatealpha(
            $dst,
            0,
            0,
            0,
            127
        );

        imagefill(
            $dst,
            0,
            0,
            $transparan
        );

        /*
         * Crop tengah lalu resize ke ukuran persegi.
         */
        imagecopyresampled(
            $dst,
            $src,
            0,
            0,
            $posisiX,
            $posisiY,
            $ukuran,
            $ukuran,
            $sisiCrop,
            $sisiCrop
        );

        imagedestroy($src);

        $extSimpan = $ext === 'jpeg'
            ? 'jpg'
            : $ext;

        $namaRelatif = $folder
            . '/'
            . Str::random(40)
            . '.'
            . $extSimpan;

        $tujuan = storage_path(
            'app/public/' . $namaRelatif
        );

        if (! is_dir(dirname($tujuan))) {
            mkdir(
                dirname($tujuan),
                0775,
                true
            );
        }

        self::simpanResourceGambar(
            $dst,
            $tujuan,
            $extSimpan
        );

        imagedestroy($dst);

        return $namaRelatif;
    }

    /**
     * Menulis resource gambar ke file berdasarkan format.
     */
    private static function simpanResourceGambar(
        \GdImage $gambar,
        string $tujuan,
        string $ext
    ): void {
        switch ($ext) {
            case 'png':
                imagepng(
                    $gambar,
                    $tujuan,
                    6
                );
                break;

            case 'webp':
                imagewebp(
                    $gambar,
                    $tujuan,
                    82
                );
                break;

            default:
                /*
                 * JPEG tidak mendukung transparansi.
                 */
                imagejpeg(
                    $gambar,
                    $tujuan,
                    82
                );
                break;
        }
    }
}