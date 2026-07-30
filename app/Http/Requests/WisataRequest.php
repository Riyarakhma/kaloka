<?php

namespace App\Http\Requests;

use App\Models\Wisata;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WisataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
           'nama_spot'          => ['required', 'string', 'max:255'],
            'nama_spot_en'       => ['nullable', 'string', 'max:255'],
            'kategori'           => ['required', Rule::in(Wisata::KATEGORI)],
            'deskripsi'          => ['required', 'string'],
            'deskripsi_en'       => ['nullable', 'string'],
            'lokasi'             => ['nullable', 'string', 'max:255'],
            'lokasi_en'          => ['nullable', 'string', 'max:255'],
            'koordinat'          => ['nullable', 'string', 'max:100'],
            'jam_operasional'    => ['nullable', 'string', 'max:255'],
            'jam_operasional_en' => ['nullable', 'string', 'max:255'],
            'kontak'             => ['nullable', 'string', 'max:255'],
            'kontak_en'          => ['nullable', 'string', 'max:255'],
            'foto'               => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'status_etis'        => ['required', Rule::in(Wisata::STATUS_ETIS)],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_spot' => 'nama spot',
            'foto' => 'foto',
            'status_etis' => 'status entri',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Kolom :attribute wajib diisi.',
            'in' => 'Pilihan :attribute tidak valid.',
            'foto.image' => 'Berkas foto harus berupa gambar.',
            'foto.max' => 'Ukuran foto maksimal 5 MB.',
        ];
    }
}