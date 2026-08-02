<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WisataController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Wisata::query();

        if (! $user) {
            $query->publik();
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $data = $query->latest()->paginate(500);

        $data->getCollection()->transform(function ($wisata) {
            $wisata->foto_utama = $wisata->fotoUtama();
            $wisata->url_foto = $wisata->urlFoto();
            $wisata->menu_url = $wisata->urlMenu();
            $wisata->boleh_publik = $wisata->bolehPublik();
            return $wisata;
        });

        return response()->json($data);
    }

    public function show(Request $request, Wisata $wisatum)
    {
        $user = $request->user();

        if (! $user && ! $wisatum->bolehPublik()) {
            return response()->json([
                'message' => 'Spot wisata tidak ditemukan.',
            ], 404);
        }

        $wisatum->foto_utama = $wisatum->fotoUtama();
        $wisatum->url_foto = $wisatum->urlFoto();
        $wisatum->menu_url = $wisatum->urlMenu();
        $wisatum->boleh_publik = $wisatum->bolehPublik();

        return response()->json(['data' => $wisatum]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_spot' => 'required|string|max:255',
            'nama_spot_en' => 'nullable|string|max:255',
            'kategori' => 'required|in:' . implode(',', Wisata::KATEGORI),
            'deskripsi' => 'required|string',
            'deskripsi_en' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'lokasi_en' => 'nullable|string|max:255',
            'google_maps' => 'nullable|string|max:2000',
            'jam_operasional' => 'nullable|array',
            'jam_operasional.*.hari' => 'nullable|string|max:100',
            'jam_operasional.*.jam' => 'nullable|string|max:100',
            'jam_operasional_en' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:255',
            'kontak_en' => 'nullable|string|max:255',
            'sosial_media' => 'nullable|string|max:2000',
            'fasilitas' => 'nullable|string',
            'narasumber' => 'nullable|string|max:255',
            'status_etis' => 'nullable|in:' . implode(',', Wisata::STATUS_ETIS),
            'foto' => 'nullable|array|max:10',
            'foto.*' => 'file|mimes:jpg,jpeg,png,webp|max:20480',
            'menu_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:20480',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data tidak valid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        unset($data['foto'], $data['menu_file']);

        if ($request->hasFile('foto')) {
            $data['foto'] = collect($request->file('foto'))
                ->map(fn ($file) => $file->store('wisata', 'public'))
                ->all();
        }

        if ($request->hasFile('menu_file')) {
            $data['menu_file'] = $request->file('menu_file')->store('wisata/menu', 'public');
        }

        $wisata = Wisata::create($data);

        return response()->json([
            'message' => 'Spot Wisata berhasil ditambahkan.',
            'data' => $wisata,
        ], 201);
    }

    public function update(Request $request, Wisata $wisatum)
    {
        $validator = Validator::make($request->all(), [
            'nama_spot' => 'sometimes|required|string|max:255',
            'nama_spot_en' => 'nullable|string|max:255',
            'kategori' => 'sometimes|required|in:' . implode(',', Wisata::KATEGORI),
            'deskripsi' => 'sometimes|required|string',
            'deskripsi_en' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'lokasi_en' => 'nullable|string|max:255',
            'google_maps' => 'nullable|string|max:2000',
            'jam_operasional' => 'nullable|array',
            'jam_operasional.*.hari' => 'nullable|string|max:100',
            'jam_operasional.*.jam' => 'nullable|string|max:100',
            'jam_operasional_en' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:255',
            'kontak_en' => 'nullable|string|max:255',
            'sosial_media' => 'nullable|string|max:2000',
            'fasilitas' => 'nullable|string',
            'narasumber' => 'nullable|string|max:255',
            'status_etis' => 'nullable|in:' . implode(',', Wisata::STATUS_ETIS),
            'foto' => 'nullable|array|max:10',
            'foto.*' => 'file|mimes:jpg,jpeg,png,webp|max:20480',
            'hapus_foto' => 'nullable|array',
            'hapus_foto.*' => 'string',
            'menu_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:20480',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data tidak valid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        unset($data['foto'], $data['hapus_foto'], $data['menu_file']);

        $fotoTersisa = $wisatum->foto ?? [];
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
                $fotoTersisa[] = $file->store('wisata', 'public');
            }
        }
        $data['foto'] = $fotoTersisa;

        if ($request->hasFile('menu_file')) {
            if ($wisatum->menu_file) {
                Storage::disk('public')->delete($wisatum->menu_file);
            }
            $data['menu_file'] = $request->file('menu_file')->store('wisata/menu', 'public');
        }

        $wisatum->update($data);

        return response()->json([
            'message' => 'Spot Wisata berhasil diperbarui.',
            'data' => $wisatum,
        ]);
    }

    public function destroy(Wisata $wisatum)
    {
        foreach ($wisatum->foto ?? [] as $path) {
            Storage::disk('public')->delete($path);
        }

        if ($wisatum->menu_file) {
            Storage::disk('public')->delete($wisatum->menu_file);
        }

        $wisatum->delete();

        return response()->json([
            'message' => 'Spot Wisata berhasil dihapus.',
        ]);
    }
}