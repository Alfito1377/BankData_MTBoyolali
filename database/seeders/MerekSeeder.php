<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MerekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('merek_kendaraan')->insert([
            ['nama' => 'Hino'],
            ['nama' => 'Mitsubishi'],
            ['nama' => 'UD Truck'],
            ['nama' => 'Faw'],
            ['nama' => 'ISUZU'],
            ['nama' => 'Mercedes Benz'],
            ['nama' => 'NISSAN UD TRUCKS'],
        ]);
    }
}
