<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use App\Http\Requests\WisataRequest;
use App\Models\Wisata;
use App\Services\Gambar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WisataController extends Controller
{
    public function index(Request $request)
    {
        $query = Wisata::query()->latest();

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }
        if ($request->filled('cari')) {
            $query->where('nama_spot', 'like', "%{$request->cari}%");
        }

        $wisata = $query->paginate(10)->withQueryString();

        return view('pengelola.wisata.index', compact('wisata'));
    }

    public function create()
    {
        return view('pengelola.wisata.create');
    }

    public function store(WisataRequest $request)
    {
        $data = $request->validated();
        unset($data['foto']);
        $data['kode_entri'] = Wisata::kodeBerikutnya();
        $data['status_kurasi'] = Wisata::STATUS_KURASI[0]; // selalu mulai dari 'Draf'

        if ($request->hasFile('foto')) {
            $data['foto'] = collect($request->file('foto'))
                ->map(fn ($file) => Gambar::simpan($file, 'wisata'))
                ->all();
        }

        $data['jam_operasional'] = collect($request->input('jam_operasional', []))
            ->filter(fn ($baris) => ! empty($baris['hari']) || ! empty($baris['jam']))
            ->values()
            ->all();

        if ($request->hasFile('menu_file')) {
            $data['menu_file'] = $request->file('menu_file')->store('wisata/menu', 'public');
        }

        $wisata = Wisata::create($data);

        return redirect()->route('pengelola.wisata.show', $wisata)
            ->with('sukses', "Spot wisata \"{$wisata->nama_spot}\" berhasil ditambahkan.");
    }

    public function show(Wisata $wisata)
    {
        return view('pengelola.wisata.show', ['wisata' => $wisata]);
    }

    public function edit(Wisata $wisata)
    {
        return view('pengelola.wisata.edit', ['wisata' => $wisata]);
    }

    public function update(WisataRequest $request, Wisata $wisata)
    {
        $data = $request->validated();
        unset($data['foto']);

        $fotoTersisa = $wisata->foto ?? [];
        foreach ($request->input('hapus_foto', []) as $path) {
            $idx = array_search($path, $fotoTersisa, true);
            if ($idx !== false) {
                Storage::disk('public')->delete($path);
                unset($fotoTersisa[$idx]);
            }
        }
        $fotoTersisa = array_values($fotoTersisa);

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $fotoTersisa[] = Gambar::simpan($file, 'wisata');
            }
        }
        $data['foto'] = $fotoTersisa;

        $data['jam_operasional'] = collect($request->input('jam_operasional', []))
            ->filter(fn ($baris) => ! empty($baris['hari']) || ! empty($baris['jam']))
            ->values()
            ->all();

        if ($request->hasFile('menu_file')) {
            if ($wisata->menu_file) {
                Storage::disk('public')->delete($wisata->menu_file);
            }
            $data['menu_file'] = $request->file('menu_file')->store('wisata/menu', 'public');
        }

        $wisata->update($data);

        return redirect()->route('pengelola.wisata.show', $wisata)
            ->with('sukses', "Spot wisata \"{$wisata->nama_spot}\" berhasil diperbarui.");
    }

    public function destroy(Wisata $wisata)
    {
        foreach ($wisata->foto ?? [] as $path) {
            Storage::disk('public')->delete($path);
        }
        $nama = $wisata->nama_spot;
        $wisata->delete();

        return redirect()->route('pengelola.wisata.index')
            ->with('sukses', "Spot wisata \"{$nama}\" berhasil dihapus.");
    }

    /** Ubah status kurasi. Admin only (dicek lewat middleware/route). */
    public function ubahKurasi(Request $request, Wisata $wisata)
    {
        $request->validate([
            'status_kurasi' => ['required', \Illuminate\Validation\Rule::in(Wisata::STATUS_KURASI)],
        ], [], ['status_kurasi' => 'status kurasi']);

        $wisata->update(['status_kurasi' => $request->status_kurasi]);

        return back()->with('sukses', "Status kurasi \"{$wisata->nama_spot}\" menjadi \"{$request->status_kurasi}\".");
    }

    /** Hapus satu foto dari sebuah spot (dipertahankan untuk kompatibilitas route lama). */
    public function hapusFoto(Request $request, Wisata $wisata)
    {
        $index = (int) $request->input('index');
        $foto = $wisata->foto ?? [];
        if (isset($foto[$index])) {
            Storage::disk('public')->delete($foto[$index]);
            unset($foto[$index]);
            $wisata->update(['foto' => array_values($foto)]);
        }
        return back()->with('sukses', 'Foto dihapus.');
    }
}