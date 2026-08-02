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
        unset($data['foto']);

        $data['kode_entri'] = Umkm::kodeBerikutnya();
        $data['status_kurasi'] = Umkm::STATUS_KURASI[0];
        $data['jam_operasional'] = $this->bersihkanOperasional($request);

        if ($request->hasFile('foto')) {
            $data['foto'] = collect($request->file('foto'))
                ->map(fn ($f) => Gambar::simpan($f, 'umkm'))
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
        unset($data['foto']);
        $data['jam_operasional'] = $this->bersihkanOperasional($request);

        // Foto lama yang dicentang untuk dihapus.
        $fotoDihapus = $request->input('hapus_foto', []);
        $fotoTersisa = collect($umkm->foto ?? [])
            ->reject(fn ($path) => in_array($path, $fotoDihapus, true))
            ->values();

        foreach ($fotoDihapus as $path) {
            Storage::disk('public')->delete($path);
        }

        // Foto baru diunggah -> ditambahkan ke sisa foto lama (bukan mengganti semua).
        $fotoBaru = collect();
        if ($request->hasFile('foto')) {
            $fotoBaru = collect($request->file('foto'))
                ->map(fn ($f) => Gambar::simpan($f, 'umkm'));
        }

        $data['foto'] = $fotoTersisa->merge($fotoBaru)->values()->all();

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

    /** Ubah status kurasi. Admin only (dicek lewat middleware/route). */
    public function ubahKurasi(Request $request, Umkm $umkm)
    {
        $request->validate([
            'status_kurasi' => ['required', \Illuminate\Validation\Rule::in(Umkm::STATUS_KURASI)],
        ], [], ['status_kurasi' => 'status kurasi']);

        $umkm->update(['status_kurasi' => $request->status_kurasi]);

        return back()->with('sukses', "Status kurasi \"{$umkm->nama_umkm}\" menjadi \"{$request->status_kurasi}\".");
    }

    /** Buang baris hari/jam yang kosong sebelum disimpan. */
    private function bersihkanOperasional(Request $request): array
    {
        return collect($request->input('jam_operasional', []))
            ->filter(fn ($baris) => ! empty($baris['hari']) || ! empty($baris['jam']))
            ->values()
            ->all();
    }
}