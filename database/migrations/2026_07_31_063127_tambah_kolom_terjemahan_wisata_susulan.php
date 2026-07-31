<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wisata', function (Blueprint $table) {
            if (! Schema::hasColumn('wisata', 'nama_spot_en')) {
                $table->string('nama_spot_en')->nullable()->after('nama_spot');
            }
            if (! Schema::hasColumn('wisata', 'deskripsi_en')) {
                $table->text('deskripsi_en')->nullable()->after('deskripsi');
            }
            if (! Schema::hasColumn('wisata', 'lokasi_en')) {
                $table->string('lokasi_en')->nullable()->after('lokasi');
            }
            if (! Schema::hasColumn('wisata', 'jam_operasional_en')) {
                $table->string('jam_operasional_en')->nullable()->after('jam_operasional');
            }
            if (! Schema::hasColumn('wisata', 'kontak_en')) {
                $table->string('kontak_en')->nullable()->after('kontak');
            }
        });
    }

    public function down(): void
    {
        Schema::table('wisata', function (Blueprint $table) {
            $table->dropColumn(['nama_spot_en', 'deskripsi_en', 'lokasi_en', 'jam_operasional_en', 'kontak_en']);
        });
    }
};