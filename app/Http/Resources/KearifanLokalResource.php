<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KearifanLokalResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'kode_entri' => $this->kode_entri,
            'judul' => $this->judul,
            'dimensi' => $this->dimensi,
            'deskripsi' => $this->deskripsi,
            'kata_kunci' => $this->daftarKataKunci(),
            'narasumber' => $this->narasumber,
            'lokasi' => $this->lokasi,
            'bahasa' => $this->bahasa,
            'url_media' => $this->urlMedia(),
            'url_media' => $this->urlMedia(),
            'dokumen_url' => $this->urlDokumen(),
            'tanggal_dokumentasi' => $this->tanggal_dokumentasi?->format('Y-m-d'),
            'sumber' => $this->sumber,
            'status_etis' => $this->status_etis,
            'status_kurasi' => $this->status_kurasi,
            'catatan' => $this->catatan,
            'dibuat_oleh' => $this->dibuat_oleh,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}