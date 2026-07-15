<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Models\KearifanLokal;
use Illuminate\Http\Request;

class KearifanLokalController extends Controller
{
    /**
     * Daftar entri kearifan lokal untuk PUBLIK.
     * Hanya entri layak tampil (scopePublik): Terbit + status etis Umum.
     */
    public function index(Request $request)
    {
        // PENTING: selalu mulai dari scope publik agar Draf/Terbatas/Sakral tidak bocor.
        $query = KearifanLokal::query()->publik()->latest();

        if ($request->filled('dimensi')) {
            $query->where('dimensi', $request->dimensi);
        }
        if ($request->filled('jenis_media')) {
            $query->where('jenis_media', $request->jenis_media);
        }
        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->where('judul', 'like', "%{$cari}%")
                  ->orWhere('kata_kunci', 'like', "%{$cari}%")
                  ->orWhere('deskripsi', 'like', "%{$cari}%");
            });
        }

        $entri = $query->paginate(9)->withQueryString();

        return view('publik.kearifan.index', compact('entri'));
    }

    /**
     * Detail entri untuk PUBLIK — diblokir bila tidak layak tampil.
     */
    public function show(KearifanLokal $kearifan)
    {
        // Proteksi: entri belum Terbit atau berstatus etis terbatas/sakral -> 404 (tidak bocor).
        abort_unless($kearifan->bolehPublik(), 404);

        return view('publik.kearifan.show', ['entri' => $kearifan]);
    }
}
