<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/**
 * Layanan pembacaan statistik dari database SLiMS secara HANYA-BACA.
 *
 * KALOKA tidak pernah menulis ke database SLiMS. Koneksi 'slims' bersifat
 * opsional: bila SLIMS_DB_DATABASE belum diisi atau database belum siap,
 * metode mengembalikan ['aktif' => false] dan dashboard memakai tampilan
 * tautan biasa.
 */
class SlimsService
{
    /**
     * Ambil ringkasan statistik katalog SLiMS.
     *
     * @return array{aktif: bool, koleksi?: int, eksemplar?: int, anggota?: int, pesan?: string}
     */
    public static function statistik(): array
    {
        $database = config('database.connections.slims.database');

        if (empty($database)) {
            return ['aktif' => false, 'pesan' => 'Koneksi SLiMS belum dikonfigurasi.'];
        }

        // Cache singkat agar dashboard tidak mengquery SLiMS pada tiap muat.
        return Cache::remember('slims_statistik', 60, function () {
            try {
                $db = DB::connection('slims');

                return [
                    'aktif'     => true,
                    'koleksi'   => (int) $db->table('biblio')->count(),
                    'eksemplar' => (int) $db->table('item')->count(),
                    'anggota'   => (int) $db->table('member')->count(),
                ];
            } catch (\Throwable $e) {
                // DB SLiMS belum terpasang / tabel belum ada / kredensial salah.
                return ['aktif' => false, 'pesan' => 'Database SLiMS belum siap diakses.'];
            }
        });
    }

    /** Bersihkan cache statistik (mis. setelah konfigurasi berubah). */
    public static function bersihkanCache(): void
    {
        Cache::forget('slims_statistik');
    }

    /**
     * Cari koleksi pustaka di database SLiMS (hanya-baca).
     *
     * @return array<int, array{id:int, judul:string, pengarang:?string, tahun:?string, sampul:?string}>
     */
    public static function cariKoleksi(string $kata, int $limit = 6): array
    {
        $database = config('database.connections.slims.database');
        if (empty($database) || trim($kata) === '') {
            return [];
        }

        try {
            $db = DB::connection('slims');
            $limit = max(1, min($limit, 50));

            $rows = $db->select(
                "SELECT b.biblio_id AS id, b.title AS judul, b.publish_year AS tahun, b.image AS sampul,
                        (SELECT GROUP_CONCAT(a.author_name SEPARATOR ', ')
                         FROM biblio_author ba
                         JOIN mst_author a ON a.author_id = ba.author_id
                         WHERE ba.biblio_id = b.biblio_id) AS pengarang
                 FROM biblio b
                 WHERE b.title LIKE ?
                 ORDER BY b.last_update DESC
                 LIMIT {$limit}",
                ['%' . $kata . '%']
            );

            return array_map(fn ($r) => [
                'id'        => (int) $r->id,
                'judul'     => (string) $r->judul,
                'pengarang' => $r->pengarang,
                'tahun'     => $r->tahun,
                'sampul'    => $r->sampul,
            ], $rows);
        } catch (\Throwable $e) {
            return [];
        }
    }
}
