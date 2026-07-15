<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel info wisata desa (Waduk Cengklik dan sekitarnya).
     */
    public function up(): void
    {
        Schema::create('wisata', function (Blueprint $table) {
            $table->id();
            $table->string('nama_spot');
            $table->enum('kategori', ['Destinasi', 'Kuliner', 'Kerajinan', 'Event'])->default('Destinasi');
            $table->text('deskripsi');
            $table->string('lokasi')->nullable();
            $table->string('koordinat')->nullable()->comment('lat,long opsional');
            $table->string('jam_operasional')->nullable();
            $table->string('kontak')->nullable();
            $table->json('foto')->nullable()->comment('Array path foto (bisa beberapa)');
            $table->boolean('status_tampil')->default(true)->comment('Tampil ke publik atau disembunyikan');
            $table->timestamps();

            $table->index('kategori');
            $table->index('status_tampil');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wisata');
    }
};
