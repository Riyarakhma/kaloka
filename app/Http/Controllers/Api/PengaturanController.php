<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    /**
     * Tampilkan semua pengaturan situs (key-value).
     * Publik: dipakai React untuk membangun navbar, sambutan, link OPAC, dll.
     */
    public function index()
    {
        $data = [];

        foreach (Pengaturan::BAWAAN as $kunci => $info) {
            $data[$kunci] = Pengaturan::ambil($kunci);
        }

        return response()->json([
            'data' => $data,
        ]);
    }

    /**
     * Perbarui satu atau lebih pengaturan sekaligus. Admin only.
     * Body contoh: { "url_opac_slims": "https://...", "nama_situs": "..." }
     */
    public function update(Request $request)
    {
        $kunciValid = array_keys(Pengaturan::BAWAAN);

        foreach ($request->all() as $kunci => $nilai) {
            if (! in_array($kunci, $kunciValid, true)) {
                continue;
            }
            Pengaturan::simpan($kunci, $nilai);
        }

        return response()->json([
            'message' => 'Pengaturan berhasil diperbarui.',
            'data' => collect($kunciValid)->mapWithKeys(
                fn ($kunci) => [$kunci => Pengaturan::ambil($kunci)]
            ),
        ]);
    }
}