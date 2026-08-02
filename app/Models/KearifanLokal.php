<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KearifanLokal extends Model
{
    use HasFactory;

    protected $table = 'kearifan_lokal';

    protected $fillable = [
        'kode_entri',
        'judul',
        'dimensi',
        'deskripsi',
        'kata_kunci',
        'narasumber',
        'lokasi',
        'berkas_media',
        'dokumen',
        'tanggal_dokumentasi',
        'pendokumentasi',
        'status_etis',
        'status_kurasi',
        'dibuat_oleh',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_dokumentasi' => 'date',
        ];
    }

    public const DIMENSI = [
        'Ekologi Waduk Cengklik',
        'Pertanian & Pangan',
        'Tradisi Lisan & Sejarah',
        'Wisata Komunitas',
    ];

    public const STATUS_ETIS = [
        'Umum',
        'Sakral',
    ];

    public const STATUS_KURASI = [
        'Draf',
        'Terbit',
    ];

    public function pembuat(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'dibuat_oleh'
        );
    }

    public function scopePublik(Builder $query): Builder
    {
        return $query
            ->where('status_kurasi', 'Terbit')
            ->where('status_etis', 'Umum');
    }

    public static function kodeBerikutnya(): string
    {
        $terakhir = static::max('id') ?? 0;

        return 'KL-' . str_pad(
            (string) ($terakhir + 1),
            4,
            '0',
            STR_PAD_LEFT
        );
    }

    public function bolehPublik(): bool
    {
        return $this->status_kurasi === 'Terbit'
            && $this->status_etis === 'Umum';
    }

    public function urlMedia(): ?string
    {
        if (!$this->berkas_media) {
            return null;
        }

        return asset(
            'storage/' . ltrim($this->berkas_media, '/')
        );
    }

    public function urlDokumen(): ?string
    {
        if (!$this->dokumen) {
            return null;
        }

        return asset(
            'storage/' . ltrim($this->dokumen, '/')
        );
    }

    public function daftarKataKunci(): array
    {
        if (!$this->kata_kunci) {
            return [];
        }

        return array_values(
            array_filter(
                array_map(
                    'trim',
                    explode(',', $this->kata_kunci)
                )
            )
        );
    }

    public function warnaStatusKurasi(): string
    {
        return match ($this->status_kurasi) {
            'Terbit' => 'success',
            default => 'secondary',
        };
    }

    public function warnaStatusEtis(): string
    {
        return match ($this->status_etis) {
            'Sakral' => 'danger',
            default => 'light',
        };
    }
}
