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
        'kode_entri', 'nama_spot', 'kategori', 'deskripsi', 'lokasi', 'koordinat',
        'jam_operasional', 'kontak', 'foto', 'status_etis', 'status_kurasi',
    ];
    protected function casts(): array
    {
        return [
            'foto' => 'array',
        ];
    }
    public const KATEGORI = ['Destinasi', 'Kuliner', 'Kerajinan', 'Event'];
    public const STATUS_ETIS = ['Umum', 'Sakral'];
    public const STATUS_KURASI = ['Draf', 'Terbit'];

    /** Hanya spot yang LAYAK TAMPIL PUBLIK: sudah Terbit DAN berstatus entri Umum. */
    public function scopePublik(Builder $query): Builder
    {
        return $query->where('status_kurasi', 'Terbit')
                     ->where('status_etis', 'Umum');
    }

    /** Apakah spot ini boleh tampil di publik? */
    public function bolehPublik(): bool
    {
        return $this->status_kurasi === 'Terbit' && $this->status_etis === 'Umum';
    }

    /** Hasilkan kode entri unik berikutnya, mis. WS-0001. */
    public static function kodeBerikutnya(): string
    {
        $terakhir = static::max('id') ?? 0;
        return 'WS-' . str_pad((string) ($terakhir + 1), 4, '0', STR_PAD_LEFT);
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

    /** Warna lencana status kurasi. */
    public function warnaStatusKurasi(): string
    {
        return match ($this->status_kurasi) {
            'Terbit' => 'success',
            default => 'secondary',
        };
    }

    /** Warna lencana status entri. */
    public function warnaStatusEtis(): string
    {
        return match ($this->status_etis) {
            'Sakral' => 'danger',
            default => 'light',
        };
    }
}