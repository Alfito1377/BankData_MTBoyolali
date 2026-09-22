<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil semua seeder secara berurutan
        $this->call([
            UserSeeder::class,
            BankDataSeeder::class,
            MerekSeeder::class,
            PabrikanTrailerSeeder::class,
            TransportirSeeder::class,
            MtAfkirDanDispenSeeder::class,
            TypeKendaranSeeder::class,
            // FleetSeeder::class,
        ]);
    }
}
