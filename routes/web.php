<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PencarianController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\Pengelola\KearifanLokalController as KelolaKearifan;
use App\Http\Controllers\Pengelola\WisataController as KelolaWisata;
use App\Http\Controllers\Publik\KearifanLokalController as PublikKearifan;
use App\Http\Controllers\Publik\WisataController as PublikWisata;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rute Web KALOKA
|--------------------------------------------------------------------------
| Portal publik penyatu untuk Perpustakaan Desa Sobokerto.
| Katalog ditangani oleh SLiMS (aplikasi terpisah) — ditautkan, bukan dibangun di sini.
*/

// Beranda / Portal publik (React SPA)
Route::get('/', function () {
    return view('app');
})->name('beranda');

// Pencarian terpadu (Katalog SLiMS + Kearifan Lokal + Wisata)
Route::get('/cari', [PencarianController::class, 'index'])->name('cari');

/*
|--------------------------------------------------------------------------
| Halaman Publik (hanya-baca, tanpa login)
|--------------------------------------------------------------------------
*/
Route::get('/kearifan-lokal', function () {
    return view('app');
});
Route::get('/kearifan-lokal/{kearifan}', function () {
    return view('app');
});
Route::get('/wisata', function () {
    return view('app');
});
Route::get('/wisata/{wisata}', function () {
    return view('app');
});

// Autentikasi (login/logout). Registrasi publik DINONAKTIFKAN — akun dibuat admin.
Auth::routes(['register' => false]);

/*
|--------------------------------------------------------------------------
| Area Terproteksi (wajib login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profil sendiri (semua pengguna login)
    Route::get('/dashboard/profil', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/dashboard/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::put('/dashboard/profil/sandi', [ProfilController::class, 'ubahSandi'])->name('profil.sandi');

    // Modul Kearifan Lokal (pengelola & admin)
    Route::prefix('dashboard')->name('pengelola.')->group(function () {
        Route::patch('kearifan/{kearifan}/kurasi', [KelolaKearifan::class, 'ubahKurasi'])
            ->name('kearifan.kurasi');
        Route::resource('kearifan', KelolaKearifan::class);

        // Modul Info Wisata
        Route::delete('wisata/{wisata}/foto', [KelolaWisata::class, 'hapusFoto'])->name('wisata.foto.hapus');
        Route::resource('wisata', KelolaWisata::class)->parameters(['wisata' => 'wisata']);
    });

    // ===== HANYA ADMIN =====
    Route::middleware('peran:admin')->prefix('dashboard')->name('pengelola.')->group(function () {
        // Manajemen pengguna
        Route::resource('pengguna', PenggunaController::class)
            ->parameters(['pengguna' => 'pengguna'])
            ->except('show');

        // Pengaturan situs
        Route::get('pengaturan', [PengaturanController::class, 'edit'])->name('pengaturan.edit');
        Route::put('pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');
    });
});
