<?php

namespace App\Http\Controllers;

use App\Models\KearifanLokal;
use App\Models\Pengaturan;
use App\Models\Wisata;
use App\Services\SlimsService;
use Illuminate\Http\Request;

class PencarianController extends Controller
{
    /**
     * Pencarian terpadu: satu kata kunci dicari sekaligus di
     * Katalog SLiMS, Kearifan Lokal, dan Info Wisata.
     */
    public function index(Request $request)
    {
        $q = trim((string) $request->input('q', ''));

        $kearifan = collect();
        $wisata = collect();
        $katalog = [];

        if ($q !== '') {
            // Kearifan Lokal — hanya entri layak publik.
            $kearifan = KearifanLokal::publik()
                ->where(function ($w) use ($q) {
                    $w->where('judul', 'like', "%{$q}%")
                      ->orWhere('deskripsi', 'like', "%{$q}%")
                      ->orWhere('kata_kunci', 'like', "%{$q}%");
                })
                ->latest()->limit(12)->get();

            // Info Wisata — hanya yang tampil.
            $wisata = Wisata::tampil()
                ->where(function ($w) use ($q) {
                    $w->where('nama_spot', 'like', "%{$q}%")
                      ->orWhere('deskripsi', 'like', "%{$q}%");
                })
                ->latest()->limit(12)->get();

            // Katalog SLiMS (read-only).
            $katalog = SlimsService::cariKoleksi($q, 6);
        }

        $urlOpac = rtrim((string) Pengaturan::ambil('url_opac_slims'), '/');

        return view('publik.cari', compact('q', 'kearifan', 'wisata', 'katalog', 'urlOpac'));
    }
}
