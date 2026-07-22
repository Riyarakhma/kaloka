<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $fillable = [
        'nama_umkm',
        'kategori',
        'deskripsi',
        'pemilik',
        'alamat',
        'kontak',
        'foto',
        'status_tampil'
    ];

    protected $casts = [
        'foto' => 'array',
    ];
}