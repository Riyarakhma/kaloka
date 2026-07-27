<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class UmkmRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'nama_umkm'      => ['required', 'string', 'max:255'],
            'kategori'       => ['required', 'string', 'max:100'],
            'deskripsi'      => ['required', 'string'],
            'pemilik'        => ['required', 'string', 'max:255'],
            'alamat'         => ['required', 'string', 'max:255'],
            'kontak'         => ['nullable', 'string', 'max:100'],
            'foto'           => ['nullable', 'array'],
            'foto.*'         => ['file', 'max:20480', 'mimes:jpg,jpeg,png,webp,gif'],
            'hapus_foto'     => ['nullable', 'array'],
            'hapus_foto.*'   => ['integer'],
            'status_tampil'  => ['nullable', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_umkm' => 'nama UMKM',
            'kategori' => 'kategori',
            'deskripsi' => 'deskripsi',
            'pemilik' => 'nama pemilik',
            'alamat' => 'alamat',
            'kontak' => 'kontak',
            'foto' => 'foto',
            'status_tampil' => 'status tampil',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Kolom :attribute wajib diisi.',
            'foto.*.max' => 'Ukuran tiap foto maksimal 20 MB.',
            'foto.*.mimes' => 'Format foto harus jpg, jpeg, png, webp, atau gif.',
        ];
    }
}