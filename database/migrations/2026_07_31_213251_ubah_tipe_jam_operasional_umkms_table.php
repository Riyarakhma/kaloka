<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE umkms MODIFY jam_operasional TEXT NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE umkms MODIFY jam_operasional VARCHAR(255) NULL');
    }
};