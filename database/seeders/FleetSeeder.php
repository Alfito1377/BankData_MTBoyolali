<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FleetSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Data Kategori (MT Reguler Boyolali, Cepu, dan MT PTO)
        DB::table('kategori_data')->insert([
            // MT Reguler (Boyolali)
            ['lokasi' => 'Boyolali', 'tipe' => 'MT Reguler', 'kategori' => 1, 'jumlah' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['lokasi' => 'Boyolali', 'tipe' => 'MT Reguler', 'kategori' => 2, 'jumlah' => 17, 'created_at' => now(), 'updated_at' => now()],
            ['lokasi' => 'Boyolali', 'tipe' => 'MT Reguler', 'kategori' => 3, 'jumlah' => 39, 'created_at' => now(), 'updated_at' => now()],

            // MT Reguler (Cepu)
            ['lokasi' => 'Cepu', 'tipe' => 'MT Reguler', 'kategori' => 1, 'jumlah' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['lokasi' => 'Cepu', 'tipe' => 'MT Reguler', 'kategori' => 2, 'jumlah' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['lokasi' => 'Cepu', 'tipe' => 'MT Reguler', 'kategori' => 3, 'jumlah' => 3, 'created_at' => now(), 'updated_at' => now()],

            // MT PTO
            ['lokasi' => 'PTO', 'tipe' => 'MT PTO', 'kategori' => 1, 'jumlah' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['lokasi' => 'PTO', 'tipe' => 'MT PTO', 'kategori' => 2, 'jumlah' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['lokasi' => 'PTO', 'tipe' => 'MT PTO', 'kategori' => 3, 'jumlah' => 0, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 2. Data Kapasitas (MT Reguler Boyolali & Cepu)
        DB::table('kapasitas_data')->insert([
            // MT Reguler Boyolali (Kap)
            ['lokasi' => 'Boyolali', 'kap' => 16, 'jumlah_reg' => 27, 'jumlah_afkir' => 3, 'total' => 30, 'created_at' => now(), 'updated_at' => now()],
            ['lokasi' => 'Boyolali', 'kap' => 24, 'jumlah_reg' => 55, 'jumlah_afkir' => 1, 'total' => 56, 'created_at' => now(), 'updated_at' => now()],
            ['lokasi' => 'Boyolali', 'kap' => 32, 'jumlah_reg' => 26, 'jumlah_afkir' => 4, 'total' => 30, 'created_at' => now(), 'updated_at' => now()],

            // MT Reguler Cepu (Kap)
            ['lokasi' => 'Cepu', 'kap' => 16, 'jumlah_reg' => 3, 'jumlah_afkir' => 0, 'total' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['lokasi' => 'Cepu', 'kap' => 24, 'jumlah_reg' => 11, 'jumlah_afkir' => 0, 'total' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['lokasi' => 'Cepu', 'kap' => 32, 'jumlah_reg' => 0, 'jumlah_afkir' => 0, 'total' => 0, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}