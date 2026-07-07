<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use App\Services\Gambar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    public function edit()
    {
        $nilai = [];
        foreach (Pengaturan::BAWAAN as $kunci => $info) {
            $nilai[$kunci] = Pengaturan::ambil($kunci);
        }

        return view('pengelola.pengaturan.edit', [
            'daftar' => Pengaturan::BAWAAN,
            'nilai'  => $nilai,
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'nama_situs'     => ['required', 'string', 'max:255'],
            'kontak'         => ['nullable', 'string', 'max:500'],
            'teks_sambutan'  => ['nullable', 'string', 'max:1000'],
            'url_opac_slims' => ['nullable', 'url', 'max:255'],
            'logo'           => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'url' => 'URL OPAC SLiMS harus berupa alamat yang valid (mis. http://...).',
            'logo.image' => 'Logo harus berupa gambar.',
            'logo.max' => 'Ukuran logo maksimal 2 MB.',
        ], [
            'nama_situs' => 'nama situs',
            'url_opac_slims' => 'URL OPAC SLiMS',
        ]);

        // Logo ditangani terpisah (berkas).
        unset($data['logo']);
        foreach ($data as $kunci => $nilai) {
            Pengaturan::simpan($kunci, $nilai);
        }

        if ($request->hasFile('logo')) {
            $lama = Pengaturan::ambil('logo');
            if ($lama) {
                Storage::disk('public')->delete($lama);
            }
            $path = Gambar::simpan($request->file('logo'), 'situs', 480);
            Pengaturan::simpan('logo', $path);
        }

        return back()->with('sukses', 'Pengaturan situs berhasil disimpan.');
    }
}
