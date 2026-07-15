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
        'nama_spot', 'kategori', 'deskripsi', 'lokasi', 'koordinat',
        'jam_operasional', 'kontak', 'foto', 'status_tampil',
    ];

    protected function casts(): array
    {
        return [
            'foto' => 'array',
            'status_tampil' => 'boolean',
        ];
    }

    public const KATEGORI = ['Destinasi', 'Kuliner', 'Kerajinan', 'Event'];

    /** Hanya spot yang ditampilkan ke publik. */
    public function scopeTampil(Builder $query): Builder
    {
        return $query->where('status_tampil', true);
    }

    /** URL foto pertama (untuk thumbnail), atau null. */
    public function fotoUtama(): ?string
    {
        $foto = $this->foto ?? [];
        return ! empty($foto) ? asset('storage/' . $foto[0]) : null;
    }

    /** Semua URL foto. */
    public function urlFoto(): array
    {
        return array_map(fn ($p) => asset('storage/' . $p), $this->foto ?? []);
    }

    /** Warna lencana kategori. */
    public function warnaKategori(): string
    {
        return match ($this->kategori) {
            'Kuliner' => 'danger',
            'Kerajinan' => 'warning',
            'Event' => 'info',
            default => 'success',
        };
    }
}
