<?php

namespace App\Http\Requests;

use App\Models\Wisata;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WisataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_spot' => [
                'required',
                'string',
                'max:255',
            ],

            'nama_spot_en' => [
                'nullable',
                'string',
                'max:255',
            ],

            'kategori' => [
                'required',
                Rule::in(Wisata::KATEGORI),
            ],

            'deskripsi' => [
                'required',
                'string',
            ],

            'deskripsi_en' => [
                'nullable',
                'string',
            ],

            'lokasi' => [
                'nullable',
                'string',
                'max:255',
            ],

            'lokasi_en' => [
                'nullable',
                'string',
                'max:255',
            ],

            'koordinat' => [
                'nullable',
                'string',
                'max:255',
            ],

            'google_maps' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'jam_operasional' => [
                'nullable',
                'string',
                'max:255',
            ],

            'jam_operasional_en' => [
                'nullable',
                'string',
                'max:255',
            ],

            'kontak' => [
                'nullable',
                'string',
                'max:255',
            ],

            'kontak_en' => [
                'nullable',
                'string',
                'max:255',
            ],

            'sosial_media' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'menu' => [
                'nullable',
                'string',
            ],

            'fasilitas' => [
                'nullable',
                'string',
            ],

            'narasumber' => [
                'nullable',
                'string',
                'max:255',
            ],

            'status_etis' => [
                'required',
                Rule::in(Wisata::STATUS_ETIS),
            ],

            'status_kurasi' => [
                'nullable',
                Rule::in(Wisata::STATUS_KURASI),
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:20480',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_spot' => 'nama spot',
            'nama_spot_en' => 'nama spot bahasa Inggris',
            'kategori' => 'kategori',
            'deskripsi' => 'deskripsi',
            'deskripsi_en' => 'deskripsi bahasa Inggris',
            'lokasi' => 'lokasi',
            'lokasi_en' => 'lokasi bahasa Inggris',
            'koordinat' => 'koordinat',
            'google_maps' => 'Google Maps',
            'jam_operasional' => 'jam operasional',
            'jam_operasional_en' => 'jam operasional bahasa Inggris',
            'kontak' => 'kontak',
            'kontak_en' => 'kontak bahasa Inggris',
            'sosial_media' => 'sosial media',
            'menu' => 'menu',
            'fasilitas' => 'fasilitas',
            'narasumber' => 'narasumber',
            'status_etis' => 'status entri',
            'status_kurasi' => 'status kurasi',
            'foto' => 'foto',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_spot.required' => 'Nama spot wajib diisi.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'kategori.in' => 'Kategori yang dipilih tidak valid.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'status_etis.required' => 'Status entri wajib dipilih.',
            'status_etis.in' => 'Status entri tidak valid.',
            'foto.image' => 'File foto harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 20 MB.',
        ];
    }
}