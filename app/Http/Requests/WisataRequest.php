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
            'nama_spot'       => ['required', 'string', 'max:255'],
            'kategori'        => ['required', Rule::in(Wisata::KATEGORI)],
            'deskripsi'       => ['required', 'string'],
            'lokasi'          => ['nullable', 'string', 'max:255'],
            'koordinat'       => ['nullable', 'string', 'max:100'],
            'jam_operasional' => ['nullable', 'string', 'max:255'],
            'kontak'          => ['nullable', 'string', 'max:255'],
            'foto'            => ['nullable', 'array'],
            'foto.*'          => ['image', 'mimes:jpg,jpeg,png,webp', 'max:5120'], // maks 5 MB/foto
            'status_tampil'   => ['nullable', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_spot' => 'nama spot',
            'foto.*' => 'foto',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Kolom :attribute wajib diisi.',
            'in' => 'Pilihan :attribute tidak valid.',
            'foto.*.image' => 'Berkas foto harus berupa gambar.',
            'foto.*.max' => 'Ukuran tiap foto maksimal 5 MB.',
        ];
    }
}
