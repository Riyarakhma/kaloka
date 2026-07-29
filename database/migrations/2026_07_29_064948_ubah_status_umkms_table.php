<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->enum('status_etis', ['Umum', 'Sakral'])->default('Umum')->after('kontak');
            $table->enum('status_kurasi', ['Draf', 'Terbit'])->default('Draf')->after('status_etis');
            $table->dropColumn('status_tampil');
        });
    }

    public function down(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->boolean('status_tampil')->default(true);
            $table->dropColumn(['status_etis', 'status_kurasi']);
        });
    }
};