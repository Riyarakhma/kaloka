<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Umkm;
use Illuminate\Validation\Rule;

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
            'sosial_media'   => ['nullable', 'string', 'max:255'],
            'produk'         => ['nullable', 'string'],
            'link_maps'      => ['nullable', 'url', 'max:500'],
            'jam_operasional' => ['nullable', 'string', 'max:255'],
            'foto'           => ['nullable', 'file', 'max:20480', 'mimes:jpg,jpeg,png,webp,gif'],
            'status_etis'    => ['required', Rule::in(Umkm::STATUS_ETIS)],
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
            'sosial_media' => 'sosial media',
            'produk' => 'produk',
            'link_maps' => 'link Google Maps',
            'jam_operasional' => 'jam operasional',
            'foto' => 'foto',
            'status_etis' => 'status entri',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Kolom :attribute wajib diisi.',
            'foto.max' => 'Ukuran foto maksimal 20 MB.',
            'foto.mimes' => 'Format foto harus jpg, jpeg, png, webp, atau gif.',
            'link_maps.url' => 'Link Google Maps harus berupa URL yang valid.',
        ];
    }
}