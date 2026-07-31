<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->string('sosial_media')->nullable()->after('kontak');
            $table->text('produk')->nullable()->after('sosial_media');
            $table->string('link_maps')->nullable()->after('produk');
            $table->string('jam_operasional')->nullable()->after('link_maps');
        });
    }

    public function down(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->dropColumn(['sosial_media', 'produk', 'link_maps', 'jam_operasional']);
        });
    }
};