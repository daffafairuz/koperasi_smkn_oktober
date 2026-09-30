<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BussinessNeed;

class BussinessNeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        // 1. Seed Business Need (Pengaturan Koperasi Periode Aktif)
        BussinessNeed::create([
            'id_bn' => 'BN-2026-01',
            'periode' => '2026-01',
            'simpanan_pokok' => 500000,
            'simpanan_wajib' => 50000,
            'persen_bunga_barang' => 10,
            'status_aktif' => true,
            'created_at' => $now,
        ]);
    }
}
