<?php

namespace App\Http\Requests;

use App\Models\KearifanLokal;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KearifanLokalRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Hanya pengguna login (admin/pengelola) yang boleh; sudah dijaga middleware rute.
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'judul'               => ['required', 'string', 'max:255'],
            'dimensi'             => ['required', Rule::in(KearifanLokal::DIMENSI)],
            'deskripsi'           => ['required', 'string'],
            'kata_kunci'          => ['nullable', 'string', 'max:255'],
            'narasumber'          => ['nullable', 'string', 'max:255'],
            'lokasi'              => ['nullable', 'string', 'max:255'],
            'bahasa'              => ['nullable', 'string', 'max:100'],
            'berkas_media'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:20480'],
            'dokumen'             => ['nullable', 'file', 'mimes:pdf', 'max:20480'],
            'tanggal_dokumentasi' => ['nullable', 'date'],
            'pendokumentasi'      => ['nullable', 'string', 'max:255'],
            'sumber'              => ['nullable', 'string', 'max:255'],
            'status_etis'         => ['required', Rule::in(KearifanLokal::STATUS_ETIS)],
            'catatan'             => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'judul' => 'judul',
            'dimensi' => 'dimensi',
            'deskripsi' => 'deskripsi',
            'berkas_media' => 'foto',
            'dokumen' => 'dokumen',
            'tanggal_dokumentasi' => 'tanggal dokumentasi',
            'status_etis' => 'status entri',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Kolom :attribute wajib diisi.',
            'berkas_media.max' => 'Ukuran foto maksimal 20 MB.',
            'berkas_media.mimes' => 'Format foto harus jpg, jpeg, png, webp, atau gif.',
            'dokumen.max' => 'Ukuran dokumen maksimal 20 MB.',
            'dokumen.mimes' => 'Dokumen harus berformat PDF.',
            'in' => 'Pilihan :attribute tidak valid.',
            'date' => 'Format :attribute harus tanggal yang benar.',
        ];
    }
}