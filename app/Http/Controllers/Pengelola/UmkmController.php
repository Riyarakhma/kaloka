<?php
namespace App\Http\Controllers\Pengelola;
use App\Http\Controllers\Controller;
use App\Http\Requests\UmkmRequest;
use App\Models\Umkm;
use App\Services\Gambar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    public function index(Request $request)
    {
        $query = Umkm::query()->latest();

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->where('nama_umkm', 'like', "%{$cari}%")
                  ->orWhere('pemilik', 'like', "%{$cari}%")
                  ->orWhere('alamat', 'like', "%{$cari}%");
            });
        }

        $entri = $query->paginate(10)->withQueryString();

        return view('pengelola.umkm.index', compact('entri'));
    }

    public function create()
    {
        return view('pengelola.umkm.create');
    }

    public function store(UmkmRequest $request)
    {
        $data = $request->validated();
        unset($data['foto'], $data['hapus_foto']);

        $data['status_tampil'] = $request->boolean('status_tampil');

        if ($request->hasFile('foto')) {
            $data['foto'] = collect($request->file('foto'))
                ->map(fn ($file) => Gambar::simpan($file, 'umkm'))
                ->all();
        }

        $umkm = Umkm::create($data);

        return redirect()->route('pengelola.umkm.show', $umkm)
            ->with('sukses', "UMKM \"{$umkm->nama_umkm}\" berhasil ditambahkan.");
    }

    public function show(Umkm $umkm)
    {
        return view('pengelola.umkm.show', ['entri' => $umkm]);
    }

    public function edit(Umkm $umkm)
    {
        return view('pengelola.umkm.edit', ['entri' => $umkm]);
    }

    public function update(UmkmRequest $request, Umkm $umkm)
    {
        $data = $request->validated();
        unset($data['foto'], $data['hapus_foto']);

        $data['status_tampil'] = $request->boolean('status_tampil');

        $fotoTersisa = $umkm->foto ?? [];
        foreach ($request->input('hapus_foto', []) as $index) {
            if (isset($fotoTersisa[$index])) {
                Storage::disk('public')->delete($fotoTersisa[$index]);
                unset($fotoTersisa[$index]);
            }
        }
        $fotoTersisa = array_values($fotoTersisa);

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $fotoTersisa[] = Gambar::simpan($file, 'umkm');
            }
        }
        $data['foto'] = $fotoTersisa;

        $umkm->update($data);

        return redirect()->route('pengelola.umkm.show', $umkm)
            ->with('sukses', "UMKM \"{$umkm->nama_umkm}\" berhasil diperbarui.");
    }

    public function destroy(Umkm $umkm)
    {
        foreach ($umkm->foto ?? [] as $path) {
            Storage::disk('public')->delete($path);
        }

        $nama = $umkm->nama_umkm;
        $umkm->delete();

        return redirect()->route('pengelola.umkm.index')
            ->with('sukses', "UMKM \"{$nama}\" berhasil dihapus.");
    }
}