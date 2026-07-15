<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Buat satu akun admin awal dan satu akun pengelola contoh.
     */
    public function run(): void
    {
        // Admin desa — akses penuh.
        User::updateOrCreate(
            ['email' => 'admin@kaloka.test'],
            [
                'name' => 'Admin Desa Sobokerto',
                'password' => Hash::make('admin12345'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Pengelola contoh — kelola konten saja.
        User::updateOrCreate(
            ['email' => 'pengelola@kaloka.test'],
            [
                'name' => 'Pengelola Perpustakaan',
                'password' => Hash::make('pengelola12345'),
                'role' => 'pengelola',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('========================================');
        $this->command->info('  AKUN AWAL KALOKA (ganti setelah login)');
        $this->command->info('========================================');
        $this->command->info('  ADMIN     : admin@kaloka.test / admin12345');
        $this->command->info('  PENGELOLA : pengelola@kaloka.test / pengelola12345');
        $this->command->info('========================================');
    }
}
