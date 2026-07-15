<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * Bantuan penyimpanan berkas dengan kompres/resize otomatis untuk gambar.
 *
 * - Gambar (jpg/jpeg/png/webp) dikecilkan hingga lebar maksimum & dikompres,
 *   agar situs ringan dan hemat ruang hosting.
 * - Berkas lain (audio/video/pdf/gif) disimpan apa adanya.
 *
 * Mengembalikan path relatif terhadap disk 'public' (mis. "kearifan/abc.jpg").
 */
class Gambar
{
    public static function simpan(UploadedFile $file, string $folder, int $lebarMaks = 1280): string
    {
        $ext = strtolower($file->getClientOriginalExtension());
        $jenisGambar = ['jpg', 'jpeg', 'png', 'webp'];

        // Bukan gambar yang bisa diproses GD -> simpan apa adanya.
        if (! in_array($ext, $jenisGambar) || ! function_exists('imagecreatefromstring')) {
            return $file->store($folder, 'public');
        }

        $info = @getimagesize($file->getRealPath());
        if ($info === false) {
            return $file->store($folder, 'public');
        }

        [$lebar, $tinggi] = $info;
        $src = @imagecreatefromstring(file_get_contents($file->getRealPath()));
        if (! $src) {
            return $file->store($folder, 'public');
        }

        // Kecilkan bila lebih lebar dari batas.
        if ($lebar > $lebarMaks) {
            $tinggiBaru = (int) round($tinggi * $lebarMaks / $lebar);
            $dst = imagecreatetruecolor($lebarMaks, $tinggiBaru);
            // Pertahankan transparansi (png/webp).
            imagealphablending($dst, false);
            imagesavealpha($dst, true);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $lebarMaks, $tinggiBaru, $lebar, $tinggi);
            imagedestroy($src);
            $src = $dst;
        }

        $extSimpan = $ext === 'jpeg' ? 'jpg' : $ext;
        $namaRelatif = $folder . '/' . Str::random(40) . '.' . $extSimpan;
        $tujuan = storage_path('app/public/' . $namaRelatif);
        @mkdir(dirname($tujuan), 0775, true);

        switch ($ext) {
            case 'png':  imagepng($src, $tujuan, 6); break;
            case 'webp': imagewebp($src, $tujuan, 82); break;
            default:     imagejpeg($src, $tujuan, 82);
        }
        imagedestroy($src);

        return $namaRelatif;
    }
}
