<?php

namespace App\Http\Controllers;

use App\Models\KearifanLokal;
use App\Models\Pengaturan;
use App\Models\Wisata;
use App\Services\SlimsService;

class DashboardController extends Controller
{
    /**
     * Dashboard area pengelola dengan statistik nyata KALOKA.
     */
    public function index()
    {
        $statistik = [
            'kearifan_total'   => KearifanLokal::count(),
            'kearifan_terbit'  => KearifanLokal::where('status_kurasi', 'Terbit')->count(),
            'kearifan_status'  => $this->hitungPer(KearifanLokal::class, 'status_kurasi', KearifanLokal::STATUS_KURASI),
            'kearifan_dimensi' => $this->hitungPer(KearifanLokal::class, 'dimensi', KearifanLokal::DIMENSI),
            'wisata_total'     => Wisata::count(),
            'wisata_tampil'    => Wisata::where('status_tampil', true)->count(),
        ];

        $urlOpac = Pengaturan::ambil('url_opac_slims');
        $slims = SlimsService::statistik();

        return view('dashboard', compact('statistik', 'urlOpac', 'slims'));
    }

    /**
     * Hitung jumlah baris per nilai kolom, dipastikan semua pilihan muncul (0 bila kosong).
     */
    private function hitungPer(string $model, string $kolom, array $pilihan): array
    {
        $hasil = $model::query()
            ->selectRaw("{$kolom} as k, COUNT(*) as jml")
            ->groupBy($kolom)
            ->pluck('jml', 'k')
            ->toArray();

        $lengkap = [];
        foreach ($pilihan as $p) {
            $lengkap[$p] = $hasil[$p] ?? 0;
        }
        return $lengkap;
    }
}
