<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel repositori kearifan lokal dengan skema metadata 16 field.
     */
    public function up(): void
    {
        Schema::create('kearifan_lokal', function (Blueprint $table) {
            $table->id();
            $table->string('kode_entri')->unique()->comment('Kode entri unik otomatis, mis. KL-0001');   // 1
            $table->string('judul');                                                                       // 2
            $table->enum('dimensi', [
                'Ekologi Waduk Cengklik',
                'Pertanian & Pangan',
                'Tradisi Lisan & Sejarah',
                'Wisata Komunitas',
            ]);                                                                                            // 3
            $table->text('deskripsi');                                                                     // 4
            $table->string('kata_kunci')->nullable()->comment('Tag dipisah koma');                         // 5
            $table->string('narasumber')->nullable();                                                      // 6
            $table->string('lokasi')->nullable()->comment('Dukuh/koordinat');                              // 7
            $table->string('bahasa')->nullable()->default('Indonesia');                                    // 8
            $table->enum('jenis_media', ['Teks', 'Foto', 'Audio', 'Video'])->default('Teks');              // 9
            $table->string('berkas_media')->nullable()->comment('Path file unggahan');                     // 10
            $table->date('tanggal_dokumentasi')->nullable();                                               // 11
            $table->string('pendokumentasi')->nullable()->comment('Nama mahasiswa');                       // 12
            $table->string('sumber')->nullable()->comment('Asal informasi');                               // 13
            $table->enum('status_etis', ['Umum', 'Terbatas', 'Sakral'])->default('Umum');                  // 14
            $table->enum('status_kurasi', ['Draf', 'Terverifikasi', 'Terbit'])->default('Draf');           // 15
            $table->text('catatan')->nullable()->comment('Catatan/relasi antar entri');                    // 16

            $table->foreignId('dibuat_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index('dimensi');
            $table->index('status_kurasi');
            $table->index('status_etis');
            $table->index('jenis_media');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kearifan_lokal');
    }
};
