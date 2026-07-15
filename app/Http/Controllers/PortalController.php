<?php

namespace App\Http\Controllers;

use App\Models\KearifanLokal;
use App\Models\Wisata;

class PortalController extends Controller
{
    /**
     * Portal/beranda publik penyatu KALOKA.
     */
    public function index()
    {
        // Cuplikan: entri kearifan terbit terbaru (hanya yang layak publik) & spot wisata tampil.
        $kearifanTerbaru = KearifanLokal::publik()->latest()->take(3)->get();
        $wisataTerbaru   = Wisata::tampil()->latest()->take(3)->get();

        return view('beranda', compact('kearifanTerbaru', 'wisataTerbaru'));
    }
}
