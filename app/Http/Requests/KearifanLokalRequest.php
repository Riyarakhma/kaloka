<?php

namespace App\Http\Requests;

use App\Models\KearifanLokal;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KearifanLokalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'dimensi' => [
                'required',
                Rule::in(KearifanLokal::DIMENSI),
            ],

            'deskripsi' => [
                'required',
                'string',
            ],

            'kata_kunci' => [
                'nullable',
                'string',
            ],

            'narasumber' => [
                'nullable',
                'string',
                'max:255',
            ],

            'lokasi' => [
                'nullable',
                'string',
                'max:255',
            ],

            'bahasa' => [
                'nullable',
                'string',
                'max:100',
            ],

            'berkas_media' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:20480',
            ],

            'dokumen' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:20480',
            ],

            'tanggal_dokumentasi' => [
                'nullable',
                'date',
            ],

            'sumber' => [
                'nullable',
                'string',
                'max:255',
            ],

            'status_etis' => [
                'required',
                Rule::in(KearifanLokal::STATUS_ETIS),
            ],

            'status_kurasi' => [
                'nullable',
                Rule::in(KearifanLokal::STATUS_KURASI),
            ],

            'catatan' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'judul' => 'judul',
            'dimensi' => 'dimensi',
            'deskripsi' => 'deskripsi',
            'kata_kunci' => 'kata kunci',
            'narasumber' => 'narasumber',
            'lokasi' => 'lokasi',
            'bahasa' => 'bahasa',
            'berkas_media' => 'foto',
            'dokumen' => 'dokumen PDF',
            'tanggal_dokumentasi' => 'tanggal dokumentasi',
            'sumber' => 'sumber',
            'status_etis' => 'status entri',
            'status_kurasi' => 'status kurasi',
            'catatan' => 'catatan',
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul wajib diisi.',
            'dimensi.required' => 'Dimensi wajib dipilih.',
            'dimensi.in' => 'Dimensi yang dipilih tidak valid.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'status_etis.required' => 'Status entri wajib dipilih.',
            'status_etis.in' => 'Status entri yang dipilih tidak valid.',

            'berkas_media.image' => 'File foto harus berupa gambar.',
            'berkas_media.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'berkas_media.max' => 'Ukuran foto maksimal 20 MB.',

            'dokumen.file' => 'Dokumen harus berupa file.',
            'dokumen.mimes' => 'Dokumen harus berformat PDF.',
            'dokumen.max' => 'Ukuran dokumen maksimal 20 MB.',
        ];
    }
}