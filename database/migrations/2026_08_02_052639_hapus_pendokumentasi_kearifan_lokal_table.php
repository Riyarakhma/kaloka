<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kearifan_lokal', function (Blueprint $table) {
            $table->dropColumn('pendokumentasi');
        });
    }

    public function down(): void
    {
        Schema::table('kearifan_lokal', function (Blueprint $table) {
            $table->string('pendokumentasi')->nullable();
        });
    }
};