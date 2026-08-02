<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Pengaturan extends Model
{
    protected $table = 'pengaturan';

    protected $fillable = ['kunci', 'nilai'];

    /** Daftar kunci pengaturan yang dikenal beserta label & nilai bawaan. */
    public const BAWAAN = [
        'nama_situs'      => ['label' => 'Nama Situs', 'nilai' => 'KALOKA — Perpustakaan Desa Sobokerto'],
        'kontak'          => ['label' => 'Kontak Desa', 'nilai' => 'Pemerintah Desa Sobokerto, Ngemplak, Boyolali'],
        'teks_sambutan'   => ['label' => 'Teks Sambutan Beranda', 'nilai' => 'Selamat datang di portal Kearifan dan Literasi Lokal Desa Sobokerto.'],
        'url_opac_slims'  => ['label' => 'URL OPAC SLiMS (katalog)', 'nilai' => 'https://desa.perpus.id'],
        'url_youtube'     => ['label' => 'URL Video YouTube Profil Desa', 'nilai' => 'https://youtu.be/SAPOqu-06NI'],
        'footer_alamat'   => ['label' => 'Alamat (Footer)', 'nilai' => 'Desa Sobokerto, Kecamatan Ngemplak, Kabupaten Boyolali, Jawa Tengah'],
        'footer_telepon'  => ['label' => 'Telepon (Footer)', 'nilai' => '(0276) 000-0000'],
        'footer_email'    => ['label' => 'Email (Footer)', 'nilai' => 'perpus.sobokerto@desa.id'],
        'footer_instagram' => ['label' => 'Instagram (Footer)', 'nilai' => '@desa_sobokerto'],
        'logo'            => ['label' => 'Logo Situs', 'nilai' => null],
    ];

    /**
     * Ambil nilai pengaturan berdasarkan kunci (dengan cache).
     */
    public static function ambil(string $kunci, ?string $default = null): ?string
    {
        $semua = Cache::rememberForever('pengaturan_semua', function () {
            return static::pluck('nilai', 'kunci')->toArray();
        });

        return $semua[$kunci] ?? $default ?? (static::BAWAAN[$kunci]['nilai'] ?? null);
    }

    /**
     * Simpan / perbarui nilai pengaturan.
     */
    public static function simpan(string $kunci, ?string $nilai): void
    {
        static::updateOrCreate(['kunci' => $kunci], ['nilai' => $nilai]);
        Cache::forget('pengaturan_semua');
    }

    protected static function booted(): void
    {
        // Bersihkan cache setiap ada perubahan.
        static::saved(fn () => Cache::forget('pengaturan_semua'));
        static::deleted(fn () => Cache::forget('pengaturan_semua'));
    }
}
