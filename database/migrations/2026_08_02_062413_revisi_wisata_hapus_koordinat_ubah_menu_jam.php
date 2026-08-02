<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wisata', function (Blueprint $table) {
            $table->dropColumn('koordinat');
            $table->renameColumn('menu', 'menu_file');
        });

        DB::statement('ALTER TABLE wisata MODIFY menu_file TEXT NULL');
        DB::statement('ALTER TABLE wisata MODIFY jam_operasional TEXT NULL');
    }

    public function down(): void
    {
        Schema::table('wisata', function (Blueprint $table) {
            $table->string('koordinat')->nullable();
            $table->renameColumn('menu_file', 'menu');
        });
    }
};