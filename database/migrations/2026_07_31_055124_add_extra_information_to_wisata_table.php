<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wisata', function (Blueprint $table) {
            if (! Schema::hasColumn('wisata', 'google_maps')) {
                $table->text('google_maps')->nullable()->after('koordinat');
            }
            if (! Schema::hasColumn('wisata', 'sosial_media')) {
                $table->text('sosial_media')->nullable()->after('kontak_en');
            }
            if (! Schema::hasColumn('wisata', 'menu')) {
                $table->text('menu')->nullable()->after('sosial_media');
            }
            if (! Schema::hasColumn('wisata', 'fasilitas')) {
                $table->text('fasilitas')->nullable()->after('menu');
            }
            if (! Schema::hasColumn('wisata', 'narasumber')) {
                $table->string('narasumber')->nullable()->after('fasilitas');
            }
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