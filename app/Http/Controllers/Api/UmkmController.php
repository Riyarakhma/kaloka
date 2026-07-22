<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Umkm;

class UmkmController extends Controller
{
    public function index()
    {
        $umkm = Umkm::where('status_tampil', 1)
                    ->paginate(10);

        return response()->json($umkm);
    }
}