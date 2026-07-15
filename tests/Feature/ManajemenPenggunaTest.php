<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ManajemenPenggunaTest extends TestCase
{
    use RefreshDatabase;

    private function buat(string $role): User
    {
        return User::create([
            'name' => ucfirst($role), 'email' => "$role@uji.test",
            'password' => Hash::make('rahasia123'), 'role' => $role,
        ]);
    }

    public function test_admin_dapat_mengakses_manajemen_pengguna(): void
    {
        $this->actingAs($this->buat('admin'))->get('/dashboard/pengguna')->assertOk();
    }

    public function test_pengelola_tidak_dapat_mengakses_manajemen_pengguna(): void
    {
        $this->actingAs($this->buat('pengelola'))->get('/dashboard/pengguna')->assertForbidden();
    }

    public function test_pengelola_tidak_dapat_mengakses_pengaturan(): void
    {
        $this->actingAs($this->buat('pengelola'))->get('/dashboard/pengaturan')->assertForbidden();
    }

    public function test_admin_dapat_menambah_pengguna_baru(): void
    {
        $this->actingAs($this->buat('admin'))->post('/dashboard/pengguna', [
            'name' => 'Pengelola Baru', 'email' => 'baru@uji.test', 'role' => 'pengelola',
            'password' => 'rahasia123', 'password_confirmation' => 'rahasia123',
        ])->assertRedirect('/dashboard/pengguna');

        $this->assertDatabaseHas('users', ['email' => 'baru@uji.test', 'role' => 'pengelola']);
    }

    public function test_admin_tidak_dapat_menghapus_akun_sendiri(): void
    {
        $admin = $this->buat('admin');
        $this->actingAs($admin)->delete("/dashboard/pengguna/{$admin->id}")->assertSessionHasErrors('hapus');
        $this->assertDatabaseHas('users', ['id' => $admin->id]);
    }
}
