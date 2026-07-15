<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WisataController extends Controller
{
    /**
     * Tampilkan daftar Wisata.
     * Publik hanya lihat yang status_tampil = true. Admin/pengelola lihat semua.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Wisata::query();

        if (! $user) {
            $query->tampil();
        }

        // Filter opsional lewat query string, mis. ?kategori=Kuliner
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $data = $query->latest()->paginate(10);

        // Tambahkan url foto biar frontend gampang makainya
        $data->getCollection()->transform(function ($wisata) {
            $wisata->foto_utama = $wisata->fotoUtama();
            $wisata->url_foto = $wisata->urlFoto();
            return $wisata;
        });

        return response()->json($data);
    }

    /**
     * Tampilkan satu spot Wisata.
     */
    public function show(Request $request, Wisata $wisatum)
    {
        $user = $request->user();

        if (! $user && ! $wisatum->status_tampil) {
            return response()->json([
                'message' => 'Spot wisata tidak ditemukan.',
            ], 404);
        }

        $wisatum->foto_utama = $wisatum->fotoUtama();
        $wisatum->url_foto = $wisatum->urlFoto();

        return response()->json(['data' => $wisatum]);
    }

    /**
     * Tambah spot Wisata baru. Login wajib (admin/pengelola).
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_spot' => 'required|string|max:255',
            'kategori' => 'required|in:' . implode(',', Wisata::KATEGORI),
            'deskripsi' => 'required|string',
            'lokasi' => 'nullable|string|max:255',
            'koordinat' => 'nullable|string|max:255',
            'jam_operasional' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:255',
            'status_tampil' => 'nullable|boolean',
            'foto' => 'nullable|array',
            'foto.*' => 'image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data tidak valid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = array_map(
                fn ($file) => $file->store('wisata', 'public'),
                $request->file('foto')
            );
        }

        $wisata = Wisata::create($data);

        return response()->json([
            'message' => 'Spot Wisata berhasil ditambahkan.',
            'data' => $wisata,
        ], 201);
    }

    /**
     * Perbarui spot Wisata. Login wajib (admin/pengelola).
     */
    public function update(Request $request, Wisata $wisatum)
    {
        $validator = Validator::make($request->all(), [
            'nama_spot' => 'sometimes|required|string|max:255',
            'kategori' => 'sometimes|required|in:' . implode(',', Wisata::KATEGORI),
            'deskripsi' => 'sometimes|required|string',
            'lokasi' => 'nullable|string|max:255',
            'koordinat' => 'nullable|string|max:255',
            'jam_operasional' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:255',
            'status_tampil' => 'nullable|boolean',
            'foto' => 'nullable|array',
            'foto.*' => 'image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data tidak valid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        if ($request->hasFile('foto')) {
            // Hapus foto lama sebelum ganti yang baru
            foreach ($wisatum->foto ?? [] as $path) {
                Storage::disk('public')->delete($path);
            }

            $data['foto'] = array_map(
                fn ($file) => $file->store('wisata', 'public'),
                $request->file('foto')
            );
        }

        $wisatum->update($data);

        return response()->json([
            'message' => 'Spot Wisata berhasil diperbarui.',
            'data' => $wisatum,
        ]);
    }

    /**
     * Hapus spot Wisata. Admin only (dicek lewat middleware/route).
     */
    public function destroy(Wisata $wisatum)
    {
        foreach ($wisatum->foto ?? [] as $path) {
            Storage::disk('public')->delete($path);
        }

        $wisatum->delete();

        return response()->json([
            'message' => 'Spot Wisata berhasil dihapus.',
        ]);
    }
}