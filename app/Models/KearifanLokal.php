<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KearifanLokal extends Model
{
    use HasFactory;

    /** Nama tabel bahasa Indonesia. */
    protected $table = 'kearifan_lokal';

    protected $fillable = [
        'kode_entri', 'judul', 'dimensi', 'deskripsi', 'kata_kunci', 'narasumber',
        'lokasi', 'bahasa', 'jenis_media', 'berkas_media', 'tanggal_dokumentasi',
        'pendokumentasi', 'sumber', 'status_etis', 'status_kurasi', 'catatan', 'dibuat_oleh',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_dokumentasi' => 'date',
        ];
    }

    /* ===================== Pilihan (enum) ===================== */

    public const DIMENSI = [
        'Ekologi Waduk Cengklik',
        'Pertanian & Pangan',
        'Tradisi Lisan & Sejarah',
        'Wisata Komunitas',
    ];

    public const JENIS_MEDIA = ['Teks', 'Foto', 'Audio', 'Video'];

    public const STATUS_ETIS = ['Umum', 'Terbatas', 'Sakral'];

    public const STATUS_KURASI = ['Draf', 'Terverifikasi', 'Terbit'];

    /* ===================== Relasi ===================== */

    public function pembuat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    /* ===================== Scope ===================== */

    /**
     * Hanya entri yang LAYAK TAMPIL PUBLIK:
     * sudah Terbit DAN berstatus etis Umum.
     * Entri Draf/Terverifikasi atau berstatus Terbatas/Sakral TIDAK akan bocor ke publik.
     */
    public function scopePublik(Builder $query): Builder
    {
        return $query->where('status_kurasi', 'Terbit')
                     ->where('status_etis', 'Umum');
    }

    /* ===================== Bantuan ===================== */

    /**
     * Hasilkan kode entri unik berikutnya, mis. KL-0001.
     */
    public static function kodeBerikutnya(): string
    {
        $terakhir = static::max('id') ?? 0;
        return 'KL-' . str_pad((string) ($terakhir + 1), 4, '0', STR_PAD_LEFT);
    }

    /**
     * Apakah entri ini boleh tampil di publik?
     */
    public function bolehPublik(): bool
    {
        return $this->status_kurasi === 'Terbit' && $this->status_etis === 'Umum';
    }

    /**
     * URL berkas media (jika ada).
     */
    public function urlMedia(): ?string
    {
        return $this->berkas_media ? asset('storage/' . $this->berkas_media) : null;
    }

    /**
     * Kata kunci sebagai array (untuk tampilan badge).
     */
    public function daftarKataKunci(): array
    {
        if (! $this->kata_kunci) {
            return [];
        }
        return array_values(array_filter(array_map('trim', explode(',', $this->kata_kunci))));
    }

    /**
     * Warna lencana Bootstrap untuk status kurasi.
     */
    public function warnaStatusKurasi(): string
    {
        return match ($this->status_kurasi) {
            'Terbit' => 'success',
            'Terverifikasi' => 'info',
            default => 'secondary',
        };
    }

    /**
     * Warna lencana Bootstrap untuk status etis.
     */
    public function warnaStatusEtis(): string
    {
        return match ($this->status_etis) {
            'Sakral' => 'danger',
            'Terbatas' => 'warning',
            default => 'light',
        };
    }
}
