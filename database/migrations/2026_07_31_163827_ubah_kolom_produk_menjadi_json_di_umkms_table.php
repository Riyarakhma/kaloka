<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ubah kolom `produk` UMKM dari teks bebas (dipisah koma) menjadi
     * daftar produk terstruktur: [{nama, deskripsi, harga}, ...].
     */
    public function up(): void
    {
        // 1) Migrasikan dulu data lama (string "a, b, c") ke bentuk JSON
        //    supaya tidak hilang saat kolom diubah tipenya.
        DB::table('umkms')->whereNotNull('produk')->where('produk', '!=', '')->get(['id', 'produk'])
            ->each(function ($row) {
                // Lewati baris yang kebetulan sudah berbentuk JSON array (data uji coba).
                $decoded = json_decode($row->produk, true);
                if (is_array($decoded)) {
                    return;
                }

                $daftar = array_values(array_filter(array_map('trim', explode(',', $row->produk))));

                $baru = array_map(fn ($nama) => [
                    'nama' => $nama,
                    'deskripsi' => '',
                    'harga' => null,
                ], $daftar);

                DB::table('umkms')->where('id', $row->id)->update([
                    'produk' => json_encode($baru),
                ]);
            });

        // 2) Ubah tipe kolom jadi JSON.
        Schema::table('umkms', function (Blueprint $table) {
            $table->json('produk')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->text('produk')->nullable()->change();
        });
    }
};