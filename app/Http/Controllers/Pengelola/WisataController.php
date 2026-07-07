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
        $data['status_tampil'] = $request->boolean('status_tampil');
        $data['foto'] = $this->simpanFoto($request);

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
        $data['status_tampil'] = $request->boolean('status_tampil');

        // Foto baru ditambahkan ke foto lama (tidak menimpa).
        $fotoBaru = $this->simpanFoto($request);
        if (! empty($fotoBaru)) {
            $data['foto'] = array_merge($wisata->foto ?? [], $fotoBaru);
        } else {
            unset($data['foto']); // jangan kosongkan bila tidak unggah foto baru
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

    /** Hapus satu foto dari sebuah spot. */
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

    /** Simpan berkas foto yang diunggah, kembalikan array path. */
    private function simpanFoto(WisataRequest|Request $request): array
    {
        $paths = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $paths[] = Gambar::simpan($file, 'wisata');
            }
        }
        return $paths;
    }
}
