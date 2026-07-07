<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Pengaturan::BAWAAN as $kunci => $info) {
            Pengaturan::updateOrCreate(['kunci' => $kunci], ['nilai' => $info['nilai']]);
        }
        $this->command->info('Seeder Pengaturan: nilai awal disiapkan (termasuk URL OPAC SLiMS).');
    }
}
