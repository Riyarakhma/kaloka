<?php

namespace Tests\Feature;

use App\Models\KearifanLokal;
use App\Models\Wisata;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PencarianTest extends TestCase
{
    use RefreshDatabase;

    private function buatKearifan(array $ubah = []): KearifanLokal
    {
        return KearifanLokal::create(array_merge([
            'kode_entri' => KearifanLokal::kodeBerikutnya(),
            'judul' => 'Tradisi Mina Padi', 'dimensi' => 'Pertanian & Pangan',
            'deskripsi' => 'Budidaya padi dan ikan.', 'jenis_media' => 'Teks',
            'status_etis' => 'Umum', 'status_kurasi' => 'Terbit',
        ], $ubah));
    }

    public function test_pencarian_kosong_menampilkan_ajakan(): void
    {
        $this->get('/cari')->assertOk()->assertSee('Masukkan kata kunci');
    }

    public function test_pencarian_menemukan_kearifan_dan_wisata(): void
    {
        $this->buatKearifan(['judul' => 'Mina Padi Cengklik']);
        Wisata::create(['nama_spot' => 'Waduk Cengklik', 'kategori' => 'Destinasi',
            'deskripsi' => 'Wisata air.', 'status_tampil' => true]);

        $resp = $this->get('/cari?q=Cengklik');
        $resp->assertOk();
        $resp->assertSee('Mina Padi Cengklik');
        $resp->assertSee('Waduk Cengklik');
    }

    public function test_pencarian_tidak_membocorkan_entri_tak_layak(): void
    {
        $this->buatKearifan(['judul' => 'Rahasia Sakral Cengklik', 'status_etis' => 'Sakral']);
        $this->buatKearifan(['judul' => 'Draf Cengklik', 'status_kurasi' => 'Draf']);
        Wisata::create(['nama_spot' => 'Spot Tersembunyi Cengklik', 'kategori' => 'Event',
            'deskripsi' => 'x', 'status_tampil' => false]);

        $resp = $this->get('/cari?q=Cengklik');
        $resp->assertDontSee('Rahasia Sakral Cengklik');
        $resp->assertDontSee('Draf Cengklik');
        $resp->assertDontSee('Spot Tersembunyi Cengklik');
    }
}
