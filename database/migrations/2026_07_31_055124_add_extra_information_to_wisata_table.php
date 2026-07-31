<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wisata', function (Blueprint $table) {
            $table->text('google_maps')
                ->nullable()
                ->after('koordinat');

            $table->text('sosial_media')
                ->nullable()
                ->after('kontak_en');

            $table->text('menu')
                ->nullable()
                ->after('sosial_media');

            $table->text('fasilitas')
                ->nullable()
                ->after('menu');

            $table->string('narasumber')
                ->nullable()
                ->after('fasilitas');
        });
    }

    public function down(): void
    {
        Schema::table('wisata', function (Blueprint $table) {
            $table->dropColumn([
                'google_maps',
                'sosial_media',
                'menu',
                'fasilitas',
                'narasumber',
            ]);
        });
    }
};