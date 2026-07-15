<?php

namespace App\Providers;

use App\Models\Pengaturan;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gunakan gaya paginasi Bootstrap 5 agar selaras dengan tampilan.
        Paginator::useBootstrapFive();

        // Bagikan pengaturan situs ke semua view (nama situs, sambutan, URL OPAC SLiMS).
        // Diamankan agar tidak error saat migrasi awal (tabel belum ada).
        try {
            if (Schema::hasTable('pengaturan')) {
                $logo = Pengaturan::ambil('logo');
                View::share('situs', [
                    'nama'      => Pengaturan::ambil('nama_situs', 'KALOKA'),
                    'kontak'    => Pengaturan::ambil('kontak'),
                    'sambutan'  => Pengaturan::ambil('teks_sambutan'),
                    'url_opac'  => Pengaturan::ambil('url_opac_slims'),
                    'logo'      => $logo ? asset('storage/' . $logo) : null,
                ]);
            }
        } catch (\Throwable $e) {
            // Abaikan saat instalasi awal / DB belum siap.
        }
    }
}
