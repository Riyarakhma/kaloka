<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wisata', function (Blueprint $table) {
            $table->string('nama_spot_en')->nullable()->after('nama_spot');
            $table->text('deskripsi_en')->nullable()->after('deskripsi');
            $table->string('lokasi_en')->nullable()->after('lokasi');
            $table->string('jam_operasional_en')->nullable()->after('jam_operasional');
            $table->string('kontak_en')->nullable()->after('kontak');
        });
    }

    public function down(): void
    {
        Schema::table('wisata', function (Blueprint $table) {
            $table->dropColumn(['nama_spot_en', 'deskripsi_en', 'lokasi_en', 'jam_operasional_en', 'kontak_en']);
        });
    }
};