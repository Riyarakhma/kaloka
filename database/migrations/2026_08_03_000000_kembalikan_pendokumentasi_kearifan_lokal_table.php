<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration ini mengembalikan kolom `pendokumentasi` pada tabel
 * `kearifan_lokal` yang sebelumnya sempat dihapus oleh migration
 * 2026_08_02_052639_hapus_pendokumentasi_kearifan_lokal_table.
 *
 * Kolom ini masih dipakai di form tambah/ubah entri dan wajib ada
 * agar data "Pendokumentasi" (nama mahasiswa) bisa tersimpan.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('kearifan_lokal', 'pendokumentasi')) {
            Schema::table('kearifan_lokal', function (Blueprint $table) {
                $table->string('pendokumentasi')
                    ->nullable()
                    ->comment('Nama mahasiswa')
                    ->after('tanggal_dokumentasi');
            });
        }
    }

    public function down(): void
    {
        Schema::table('kearifan_lokal', function (Blueprint $table) {
            $table->dropColumn('pendokumentasi');
        });
    }
};
