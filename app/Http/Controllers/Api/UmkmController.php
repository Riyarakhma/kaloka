<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\UmkmRequest;
use App\Models\Umkm;
use App\Services\Gambar;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    public function index()
    {
        $umkm = Umkm::publik()
                    ->paginate(500);
        return response()->json($umkm);
    }

    public function show(Umkm $umkm)
    {
        return response()->json(['data' => $umkm]);
    }

    public function store(UmkmRequest $request)
    {
        $data = $request->validated();
        unset($data['foto']);
        $data['status_kurasi'] = Umkm::STATUS_KURASI[0];

        if ($request->hasFile('foto')) {
            $data['foto'] = [Gambar::simpan($request->file('foto'), 'umkm')];
        }

        $umkm = Umkm::create($data);

        return response()->json([
            'message' => 'UMKM berhasil ditambahkan.',
            'data' => $umkm,
        ], 201);
    }

    public function update(UmkmRequest $request, Umkm $umkm)
    {
        $data = $request->validated();
        unset($data['foto']);

        if ($request->hasFile('foto')) {
            foreach ($umkm->foto ?? [] as $path) {
                Storage::disk('public')->delete($path);
            }
            $data['foto'] = [Gambar::simpan($request->file('foto'), 'umkm')];
        }

        $umkm->update($data);

        return response()->json([
            'message' => 'UMKM berhasil diperbarui.',
            'data' => $umkm,
        ]);
    }

    public function destroy(Umkm $umkm)
    {
        foreach ($umkm->foto ?? [] as $path) {
            Storage::disk('public')->delete($path);
        }

        $umkm->delete();

        return response()->json([
            'message' => 'UMKM berhasil dihapus.',
        ]);
    }
}