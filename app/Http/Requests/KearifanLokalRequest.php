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
            'jenis_media'         => ['required', Rule::in(KearifanLokal::JENIS_MEDIA)],
            'berkas_media'        => ['nullable', 'file', 'max:20480', // maks 20 MB
                                      'mimes:jpg,jpeg,png,webp,gif,mp3,wav,ogg,mp4,webm,pdf,doc,docx'],
            'tanggal_dokumentasi' => ['nullable', 'date'],
            'pendokumentasi'      => ['nullable', 'string', 'max:255'],
            'sumber'              => ['nullable', 'string', 'max:255'],
            'status_etis'         => ['required', Rule::in(KearifanLokal::STATUS_ETIS)],
            'status_kurasi'       => ['required', Rule::in(KearifanLokal::STATUS_KURASI)],
            'catatan'             => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'judul' => 'judul',
            'dimensi' => 'dimensi',
            'deskripsi' => 'deskripsi',
            'jenis_media' => 'jenis media',
            'berkas_media' => 'berkas media',
            'tanggal_dokumentasi' => 'tanggal dokumentasi',
            'status_etis' => 'status etis',
            'status_kurasi' => 'status kurasi',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Kolom :attribute wajib diisi.',
            'berkas_media.max' => 'Ukuran berkas media maksimal 20 MB.',
            'berkas_media.mimes' => 'Format berkas tidak didukung (gambar/audio/video/dokumen).',
            'in' => 'Pilihan :attribute tidak valid.',
            'date' => 'Format :attribute harus tanggal yang benar.',
        ];
    }
}
