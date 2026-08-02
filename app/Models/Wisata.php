<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    use HasFactory;

    protected $table = 'wisata';

    protected $fillable = [
        'kode_entri',
        'nama_spot',
        'nama_spot_en',
        'kategori',
        'deskripsi',
        'deskripsi_en',
        'lokasi',
        'lokasi_en',
        'google_maps',
        'jam_operasional',
        'jam_operasional_en',
        'kontak',
        'kontak_en',
        'sosial_media',
        'menu_file',
        'fasilitas',
        'narasumber',
        'foto',
        'status_etis',
        'status_kurasi',
    ];

    protected function casts(): array
    {
        return [
            'foto' => 'array',
            'jam_operasional' => 'array',
        ];
    }

    public const KATEGORI = [
        'Destinasi',
        'Kuliner',
        'Kerajinan',
        'Event',
    ];

    public const KATEGORI_EN = [
        'Destinasi' => 'Destination',
        'Kuliner' => 'Culinary',
        'Kerajinan' => 'Craft',
        'Event' => 'Event',
    ];

    public const STATUS_ETIS = [
        'Umum',
        'Sakral',
    ];

    public const STATUS_KURASI = [
        'Draf',
        'Terbit',
    ];

    public function scopePublik(Builder $query): Builder
    {
        return $query
            ->where('status_kurasi', 'Terbit')
            ->where('status_etis', 'Umum');
    }

    public function bolehPublik(): bool
    {
        return $this->status_kurasi === 'Terbit'
            && $this->status_etis === 'Umum';
    }

    public function kategoriEn(): string
    {
        return static::KATEGORI_EN[$this->kategori]
            ?? $this->kategori;
    }

    public static function kodeBerikutnya(): string
    {
        $terakhir = static::max('id') ?? 0;

        return 'WS-' . str_pad(
            (string) ($terakhir + 1),
            4,
            '0',
            STR_PAD_LEFT
        );
    }

    public function fotoUtama(): ?string
    {
        $foto = $this->foto ?? [];

        return !empty($foto)
            ? asset('storage/' . $foto[0])
            : null;
    }

    public function urlFoto(): array
    {
        return array_map(
            fn ($path) => asset('storage/' . $path),
            $this->foto ?? []
        );
    }

    /** Daftar jam operasional yang sudah bersih (buang baris kosong). */
    public function daftarOperasional(): array
    {
        return collect($this->jam_operasional ?? [])
            ->filter(fn ($baris) => ! empty($baris['hari']) || ! empty($baris['jam']))
            ->values()
            ->all();
    }

    /** URL file menu (jika ada). */
    public function urlMenu(): ?string
    {
        return $this->menu_file ? asset('storage/' . $this->menu_file) : null;
    }

    public function warnaKategori(): string
    {
        return match ($this->kategori) {
            'Kuliner' => 'danger',
            'Kerajinan' => 'warning',
            'Event' => 'info',
            default => 'success',
        };
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