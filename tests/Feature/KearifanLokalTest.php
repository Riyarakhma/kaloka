<?php

namespace Tests\Feature;

use App\Models\KearifanLokal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class KearifanLokalTest extends TestCase
{
    use RefreshDatabase;

    private function pengelola(): User
    {
        return User::create([
            'name' => 'Pengelola', 'email' => 'p@uji.test',
            'password' => Hash::make('rahasia123'), 'role' => 'pengelola',
        ]);
    }

    private function buatEntri(array $ubah = []): KearifanLokal
    {
        return KearifanLokal::create(array_merge([
            'kode_entri' => KearifanLokal::kodeBerikutnya(),
            'judul' => 'Contoh Entri',
            'dimensi' => 'Pertanian & Pangan',
            'deskripsi' => 'Deskripsi contoh.',
            'jenis_media' => 'Teks',
            'status_etis' => 'Umum',
            'status_kurasi' => 'Draf',
        ], $ubah));
    }

    public function test_pengelola_dapat_menambah_entri_dengan_kode_otomatis(): void
    {
        $resp = $this->actingAs($this->pengelola())->post('/dashboard/kearifan', [
            'judul' => 'Tradisi Baru', 'dimensi' => 'Tradisi Lisan & Sejarah',
            'deskripsi' => 'Narasi.', 'jenis_media' => 'Teks',
            'status_etis' => 'Umum', 'status_kurasi' => 'Draf', 'bahasa' => 'Jawa',
        ]);

        $this->assertDatabaseHas('kearifan_lokal', ['judul' => 'Tradisi Baru', 'kode_entri' => 'KL-0001']);
        $resp->assertRedirect();
    }

    public function test_validasi_judul_wajib_diisi(): void
    {
        $resp = $this->actingAs($this->pengelola())->from('/dashboard/kearifan/create')
            ->post('/dashboard/kearifan', [
                'judul' => '', 'dimensi' => 'Pertanian & Pangan', 'deskripsi' => 'x',
                'jenis_media' => 'Teks', 'status_etis' => 'Umum', 'status_kurasi' => 'Draf',
            ]);

        $resp->assertSessionHasErrors('judul');
    }

    public function test_alur_kurasi_draf_ke_terbit(): void
    {
        $entri = $this->buatEntri(['status_kurasi' => 'Draf']);

        $this->actingAs($this->pengelola())
            ->patch("/dashboard/kearifan/{$entri->id}/kurasi", ['status_kurasi' => 'Terbit']);

        $this->assertDatabaseHas('kearifan_lokal', ['id' => $entri->id, 'status_kurasi' => 'Terbit']);
    }

    public function test_publik_hanya_melihat_entri_terbit_dan_umum(): void
    {
        $terbit = $this->buatEntri(['judul' => 'Tampil Publik', 'status_kurasi' => 'Terbit', 'status_etis' => 'Umum']);
        $draf   = $this->buatEntri(['judul' => 'Masih Draf', 'status_kurasi' => 'Draf']);
        $sakral = $this->buatEntri(['judul' => 'Rahasia Sakral', 'status_kurasi' => 'Terbit', 'status_etis' => 'Sakral']);

        $resp = $this->get('/kearifan-lokal');
        $resp->assertSee('Tampil Publik');
        $resp->assertDontSee('Masih Draf');
        $resp->assertDontSee('Rahasia Sakral');
    }

    public function test_detail_publik_diblokir_untuk_entri_tidak_layak(): void
    {
        $terbit = $this->buatEntri(['status_kurasi' => 'Terbit', 'status_etis' => 'Umum']);
        $sakral = $this->buatEntri(['status_kurasi' => 'Terbit', 'status_etis' => 'Sakral']);
        $draf   = $this->buatEntri(['status_kurasi' => 'Draf']);

        $this->get("/kearifan-lokal/{$terbit->id}")->assertOk();
        $this->get("/kearifan-lokal/{$sakral->id}")->assertNotFound();
        $this->get("/kearifan-lokal/{$draf->id}")->assertNotFound();
    }

    public function test_tamu_tidak_dapat_mengelola_entri(): void
    {
        $this->get('/dashboard/kearifan')->assertRedirect('/login');
        $this->post('/dashboard/kearifan', [])->assertRedirect('/login');
    }
}
