<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AutentikasiTest extends TestCase
{
    use RefreshDatabase;

    public function test_pengguna_dapat_login_dan_diarahkan_ke_dashboard(): void
    {
        $user = User::create([
            'name' => 'Admin Uji', 'email' => 'admin@uji.test',
            'password' => Hash::make('rahasia123'), 'role' => 'admin',
        ]);

        $resp = $this->post('/login', [
            'email' => 'admin@uji.test', 'password' => 'rahasia123',
        ]);

        $resp->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_gagal_dengan_kata_sandi_salah(): void
    {
        User::create([
            'name' => 'Admin', 'email' => 'admin@uji.test',
            'password' => Hash::make('rahasia123'), 'role' => 'admin',
        ]);

        $resp = $this->from('/login')->post('/login', [
            'email' => 'admin@uji.test', 'password' => 'salah',
        ]);

        $resp->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_registrasi_publik_dinonaktifkan(): void
    {
        $this->get('/register')->assertNotFound();
        $this->post('/register', [])->assertNotFound();
    }

    public function test_dashboard_butuh_login(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }
}
