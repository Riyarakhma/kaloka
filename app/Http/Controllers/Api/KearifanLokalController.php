<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KearifanLokalResource;
use App\Models\KearifanLokal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KearifanLokalController extends Controller
{
    /**
     * Tampilkan daftar Kearifan Lokal.
     * Publik hanya lihat yang Terbit & Umum. Admin/pengelola lihat semua.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $query = KearifanLokal::query();

        if (! $user) {
            $query->publik();
        }

        // Filter opsional lewat query string, mis. ?dimensi=Pertanian & Pangan
        if ($request->filled('dimensi')) {
            $query->where('dimensi', $request->dimensi);
        }

        $data = $query->latest()->paginate(10);

        return KearifanLokalResource::collection($data);
    }

    /**
     * Tampilkan satu entri Kearifan Lokal.
     */
    public function show(Request $request, KearifanLokal $kearifanLokal)
    {
        $user = $request->user();

        if (! $user && ! $kearifanLokal->bolehPublik()) {
            return response()->json([
                'message' => 'Entri tidak ditemukan.',
            ], 404);
        }

        return new KearifanLokalResource($kearifanLokal);
    }

    /**
     * Tambah entri Kearifan Lokal baru. Login wajib (admin/pengelola).
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'dimensi' => 'required|in:' . implode(',', KearifanLokal::DIMENSI),
            'deskripsi' => 'required|string',
            'kata_kunci' => 'nullable|string',
            'narasumber' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'bahasa' => 'nullable|string|max:100',
            'jenis_media' => 'nullable|in:' . implode(',', KearifanLokal::JENIS_MEDIA),
            'tanggal_dokumentasi' => 'nullable|date',
            'pendokumentasi' => 'nullable|string|max:255',
            'sumber' => 'nullable|string|max:255',
            'status_etis' => 'nullable|in:' . implode(',', KearifanLokal::STATUS_ETIS),
            'status_kurasi' => 'nullable|in:' . implode(',', KearifanLokal::STATUS_KURASI),
            'catatan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data tidak valid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $data['kode_entri'] = KearifanLokal::kodeBerikutnya();
        $data['dibuat_oleh'] = $request->user()->id;

        $entri = KearifanLokal::create($data);

        return response()->json([
            'message' => 'Entri Kearifan Lokal berhasil ditambahkan.',
            'data' => new KearifanLokalResource($entri),
        ], 201);
    }

    /**
     * Perbarui entri Kearifan Lokal. Login wajib (admin/pengelola).
     */
    public function update(Request $request, KearifanLokal $kearifanLokal)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'sometimes|required|string|max:255',
            'dimensi' => 'sometimes|required|in:' . implode(',', KearifanLokal::DIMENSI),
            'deskripsi' => 'sometimes|required|string',
            'kata_kunci' => 'nullable|string',
            'narasumber' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'bahasa' => 'nullable|string|max:100',
            'jenis_media' => 'nullable|in:' . implode(',', KearifanLokal::JENIS_MEDIA),
            'tanggal_dokumentasi' => 'nullable|date',
            'pendokumentasi' => 'nullable|string|max:255',
            'sumber' => 'nullable|string|max:255',
            'status_etis' => 'nullable|in:' . implode(',', KearifanLokal::STATUS_ETIS),
            'status_kurasi' => 'nullable|in:' . implode(',', KearifanLokal::STATUS_KURASI),
            'catatan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data tidak valid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $kearifanLokal->update($validator->validated());

        return response()->json([
            'message' => 'Entri Kearifan Lokal berhasil diperbarui.',
            'data' => new KearifanLokalResource($kearifanLokal),
        ]);
    }

    /**
     * Hapus entri Kearifan Lokal. Admin only (dicek lewat middleware/route).
     */
    public function destroy(KearifanLokal $kearifanLokal)
    {
        $kearifanLokal->delete();

        return response()->json([
            'message' => 'Entri Kearifan Lokal berhasil dihapus.',
        ]);
    }
}