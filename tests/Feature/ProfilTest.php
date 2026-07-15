<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProfilTest extends TestCase
{
    use RefreshDatabase;

    private function user(): User
    {
        return User::create([
            'name' => 'Pengguna', 'email' => 'u@uji.test',
            'password' => Hash::make('rahasia123'), 'role' => 'pengelola',
        ]);
    }

    public function test_pengguna_dapat_memperbarui_profil(): void
    {
        $u = $this->user();

        $this->actingAs($u)->put('/dashboard/profil', [
            'name' => 'Nama Baru', 'email' => 'baru@uji.test',
        ])->assertRedirect();

        $this->assertDatabaseHas('users', ['id' => $u->id, 'name' => 'Nama Baru', 'email' => 'baru@uji.test']);
    }

    public function test_pengguna_dapat_mengganti_kata_sandi_dengan_sandi_lama_benar(): void
    {
        $u = $this->user();

        $this->actingAs($u)->put('/dashboard/profil/sandi', [
            'sandi_lama' => 'rahasia123',
            'password' => 'sandibaru123', 'password_confirmation' => 'sandibaru123',
        ])->assertSessionHasNoErrors();

        $this->assertTrue(Hash::check('sandibaru123', $u->fresh()->password));
    }

    public function test_ganti_sandi_gagal_jika_sandi_lama_salah(): void
    {
        $u = $this->user();

        $this->actingAs($u)->from('/dashboard/profil')->put('/dashboard/profil/sandi', [
            'sandi_lama' => 'salah',
            'password' => 'sandibaru123', 'password_confirmation' => 'sandibaru123',
        ])->assertSessionHasErrors('sandi_lama');

        $this->assertTrue(Hash::check('rahasia123', $u->fresh()->password));
    }

    public function test_dashboard_termuat_dengan_fallback_slims(): void
    {
        $admin = User::create([
            'name' => 'Admin', 'email' => 'a@uji.test',
            'password' => Hash::make('rahasia123'), 'role' => 'admin',
        ]);

        $this->actingAs($admin)->get('/dashboard')
            ->assertOk()
            ->assertSee('Katalog (SLiMS)');
    }
}
