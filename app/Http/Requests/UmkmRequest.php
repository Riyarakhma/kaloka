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

    protected function prepareForValidation(): void
    {
        if (! $this->has('produk') || ! is_array($this->produk)) {
            return;
        }

        $bersih = collect($this->produk)
            ->filter(fn ($p) => filled($p['nama'] ?? null))
            ->values()
            ->all();

        $this->merge(['produk' => $bersih]);
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
            'produk'              => ['nullable', 'array'],
            'produk.*.nama'       => ['required_with:produk', 'string', 'max:255'],
            'produk.*.deskripsi'  => ['nullable', 'string', 'max:1000'],
            'produk.*.harga'      => ['nullable', 'numeric', 'min:0'],
            'link_maps'      => ['nullable', 'url', 'max:500'],
            'jam_operasional'      => ['nullable', 'array'],
            'jam_operasional.*.hari' => ['nullable', 'string', 'max:100'],
            'jam_operasional.*.jam'  => ['nullable', 'string', 'max:100'],
            'foto'           => ['nullable', 'array', 'max:10'],
            'foto.*'         => ['file', 'max:20480', 'mimes:jpg,jpeg,png,webp,gif'],
            'hapus_foto'     => ['nullable', 'array'],
            'hapus_foto.*'   => ['string'],
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
            'foto.max' => 'Maksimal 10 foto per UMKM.',
            'foto.*.max' => 'Ukuran tiap foto maksimal 20 MB.',
            'foto.*.mimes' => 'Format foto harus jpg, jpeg, png, webp, atau gif.',
            'link_maps.url' => 'Link Google Maps harus berupa URL yang valid.',
        ];
    }
}