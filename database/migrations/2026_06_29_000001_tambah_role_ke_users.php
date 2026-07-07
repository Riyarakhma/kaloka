<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah kolom peran (role) pada tabel users.
     * Dua peran: 'admin' (akses penuh) dan 'pengelola' (kelola konten).
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'pengelola'])
                  ->default('pengelola')
                  ->after('email')
                  ->comment('Peran pengguna: admin atau pengelola');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
