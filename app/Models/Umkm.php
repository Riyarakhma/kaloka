<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
class Umkm extends Model
{
    protected $table = 'umkms';
    protected $fillable = [
        'kode_entri',
        'nama_umkm',
        'kategori',
        'deskripsi',
        'pemilik',
        'alamat',
        'kontak',
        'foto',
        'status_etis',
        'status_kurasi',
    ];
    protected $casts = [
        'foto' => 'array',
    ];

    public const STATUS_ETIS = ['Umum', 'Sakral'];
    public const STATUS_KURASI = ['Draf', 'Terbit'];

    public function urlFoto(): array
    {
        return collect($this->foto ?? [])
            ->map(fn ($path) => \Illuminate\Support\Facades\Storage::url($path))
            ->all();
    }

    /** Hanya UMKM yang LAYAK TAMPIL PUBLIK: sudah Terbit DAN berstatus entri Umum. */
    public function scopePublik(Builder $query): Builder
    {
        return $query->where('status_kurasi', 'Terbit')
                     ->where('status_etis', 'Umum');
    }

    /** Apakah UMKM ini boleh tampil di publik? */
    public function bolehPublik(): bool
    {
        return $this->status_kurasi === 'Terbit' && $this->status_etis === 'Umum';
    }

    /** Hasilkan kode entri unik berikutnya, mis. UM-0001. */
    public static function kodeBerikutnya(): string
    {
        $terakhir = static::max('id') ?? 0;
        return 'UM-' . str_pad((string) ($terakhir + 1), 4, '0', STR_PAD_LEFT);
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