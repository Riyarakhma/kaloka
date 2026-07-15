<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    /** Daftar spot wisata untuk publik (hanya yang status_tampil = true). */
    public function index(Request $request)
    {
        $query = Wisata::query()->tampil()->latest();

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }
        if ($request->filled('cari')) {
            $query->where('nama_spot', 'like', "%{$request->cari}%");
        }

        $wisata = $query->paginate(9)->withQueryString();

        return view('publik.wisata.index', compact('wisata'));
    }

    /** Detail spot wisata — diblokir bila disembunyikan. */
    public function show(Wisata $wisata)
    {
        abort_unless($wisata->status_tampil, 404);

        return view('publik.wisata.show', compact('wisata'));
    }
}
