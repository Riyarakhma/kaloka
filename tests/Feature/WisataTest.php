<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Wisata;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class WisataTest extends TestCase
{
    use RefreshDatabase;

    private function pengelola(): User
    {
        return User::create([
            'name' => 'Pengelola', 'email' => 'p@uji.test',
            'password' => Hash::make('rahasia123'), 'role' => 'pengelola',
        ]);
    }

    public function test_pengelola_dapat_membuat_spot_wisata(): void
    {
        $this->actingAs($this->pengelola())->post('/dashboard/wisata', [
            'nama_spot' => 'Waduk Cengklik', 'kategori' => 'Destinasi',
            'deskripsi' => 'Pemandangan indah.', 'status_tampil' => '1',
        ])->assertRedirect();

        $this->assertDatabaseHas('wisata', ['nama_spot' => 'Waduk Cengklik', 'status_tampil' => 1]);
    }

    public function test_pengelola_dapat_memperbarui_dan_menghapus(): void
    {
        $w = Wisata::create(['nama_spot' => 'Lama', 'kategori' => 'Kuliner', 'deskripsi' => 'x', 'status_tampil' => true]);
        $p = $this->pengelola();

        $this->actingAs($p)->put("/dashboard/wisata/{$w->id}", [
            'nama_spot' => 'Baru', 'kategori' => 'Kuliner', 'deskripsi' => 'y', 'status_tampil' => '1',
        ])->assertRedirect();
        $this->assertDatabaseHas('wisata', ['id' => $w->id, 'nama_spot' => 'Baru']);

        $this->actingAs($p)->delete("/dashboard/wisata/{$w->id}")->assertRedirect();
        $this->assertDatabaseMissing('wisata', ['id' => $w->id]);
    }

    public function test_validasi_nama_spot_wajib(): void
    {
        $this->actingAs($this->pengelola())->from('/dashboard/wisata/create')
            ->post('/dashboard/wisata', ['nama_spot' => '', 'kategori' => 'Destinasi', 'deskripsi' => 'x'])
            ->assertSessionHasErrors('nama_spot');
    }

    public function test_publik_tidak_melihat_spot_disembunyikan(): void
    {
        $tampil = Wisata::create(['nama_spot' => 'Spot Tampil', 'kategori' => 'Destinasi', 'deskripsi' => 'x', 'status_tampil' => true]);
        $sembunyi = Wisata::create(['nama_spot' => 'Spot Sembunyi', 'kategori' => 'Event', 'deskripsi' => 'x', 'status_tampil' => false]);

        $resp = $this->get('/wisata');
        $resp->assertSee('Spot Tampil');
        $resp->assertDontSee('Spot Sembunyi');

        $this->get("/wisata/{$sembunyi->id}")->assertNotFound();
        $this->get("/wisata/{$tampil->id}")->assertOk();
    }
}
