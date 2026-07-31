<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use App\Http\Requests\KearifanLokalRequest;
use App\Models\KearifanLokal;
use App\Services\Gambar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class KearifanLokalController extends Controller
{
    /**
     * Tampilkan daftar seluruh entri Kearifan Lokal.
     */
    public function index(Request $request)
    {
        $query = KearifanLokal::query()
            ->latest();

        if ($request->filled('dimensi')) {
            $query->where('dimensi', $request->dimensi);
        }

        if ($request->filled('status_kurasi')) {
            $query->where('status_kurasi', $request->status_kurasi);
        }

        if ($request->filled('cari')) {
            $cari = $request->cari;

            $query->where(function ($q) use ($cari) {
                $q->where('judul', 'like', "%{$cari}%")
                    ->orWhere('kode_entri', 'like', "%{$cari}%")
                    ->orWhere('kata_kunci', 'like', "%{$cari}%")
                    ->orWhere('narasumber', 'like', "%{$cari}%");
            });
        }

        $entri = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'pengelola.kearifan.index',
            compact('entri')
        );
    }

    /**
     * Tampilkan form tambah entri.
     */
    public function create()
    {
        return view('pengelola.kearifan.create');
    }

    /**
     * Simpan entri baru.
     */
    public function store(KearifanLokalRequest $request)
    {
        $data = $request->validated();

        unset(
            $data['berkas_media'],
            $data['dokumen']
        );

        $data['kode_entri'] = KearifanLokal::kodeBerikutnya();
        $data['dibuat_oleh'] = $request->user()->id;
        $data['status_kurasi'] = KearifanLokal::STATUS_KURASI[0];

        if ($request->hasFile('berkas_media')) {
            $data['berkas_media'] = Gambar::simpan(
                $request->file('berkas_media'),
                'kearifan'
            );
        }

        if ($request->hasFile('dokumen')) {
            $data['dokumen'] = $request
                ->file('dokumen')
                ->store('kearifan/dokumen', 'public');
        }

        $entri = KearifanLokal::create($data);

        return redirect()
            ->route('pengelola.kearifan.show', $entri)
            ->with(
                'sukses',
                "Entri {$entri->kode_entri} berhasil ditambahkan."
            );
    }

    /**
     * Tampilkan detail entri.
     */
    public function show(KearifanLokal $kearifan)
    {
        return view(
            'pengelola.kearifan.show',
            [
                'entri' => $kearifan,
            ]
        );
    }

    /**
     * Tampilkan form edit entri.
     */
    public function edit(KearifanLokal $kearifan)
    {
        return view(
            'pengelola.kearifan.edit',
            [
                'entri' => $kearifan,
            ]
        );
    }

    /**
     * Perbarui data entri.
     */
    public function update(
        KearifanLokalRequest $request,
        KearifanLokal $kearifan
    ) {
        $data = $request->validated();

        unset(
            $data['berkas_media'],
            $data['dokumen']
        );

        if ($request->hasFile('berkas_media')) {
            if ($kearifan->berkas_media) {
                Storage::disk('public')->delete(
                    $kearifan->berkas_media
                );
            }

            $data['berkas_media'] = Gambar::simpan(
                $request->file('berkas_media'),
                'kearifan'
            );
        }

        if ($request->hasFile('dokumen')) {
            if ($kearifan->dokumen) {
                Storage::disk('public')->delete(
                    $kearifan->dokumen
                );
            }

            $data['dokumen'] = $request
                ->file('dokumen')
                ->store('kearifan/dokumen', 'public');
        }

        $kearifan->update($data);

        return redirect()
            ->route('pengelola.kearifan.show', $kearifan)
            ->with(
                'sukses',
                "Entri {$kearifan->kode_entri} berhasil diperbarui."
            );
    }

    /**
     * Hapus entri.
     */
    public function destroy(KearifanLokal $kearifan)
    {
        if ($kearifan->berkas_media) {
            Storage::disk('public')->delete(
                $kearifan->berkas_media
            );
        }

        if ($kearifan->dokumen) {
            Storage::disk('public')->delete(
                $kearifan->dokumen
            );
        }

        $kode = $kearifan->kode_entri;

        $kearifan->delete();

        return redirect()
            ->route('pengelola.kearifan.index')
            ->with(
                'sukses',
                "Entri {$kode} berhasil dihapus."
            );
    }

    /**
     * Ubah status kurasi.
     */
    public function ubahKurasi(
        Request $request,
        KearifanLokal $kearifan
    ) {
        $request->validate(
            [
                'status_kurasi' => [
                    'required',
                    Rule::in(KearifanLokal::STATUS_KURASI),
                ],
            ],
            [],
            [
                'status_kurasi' => 'status kurasi',
            ]
        );

        $kearifan->update([
            'status_kurasi' => $request->status_kurasi,
        ]);

        return back()->with(
            'sukses',
            "Status kurasi {$kearifan->kode_entri} menjadi \"{$request->status_kurasi}\"."
        );
    }
}