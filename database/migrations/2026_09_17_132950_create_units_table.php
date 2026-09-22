<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('kelompok');    // Contoh: 'MT REGULER (BOYOLALI)', 'MT REGULER (CEPU)', 'MT PTO'
            $table->integer('kategori');   // Contoh: 1, 2, 3
            $table->integer('kapasitas');  // Contoh: 16, 24, 32
            $table->enum('status', ['Reguler', 'Afkir']); // Status unit
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
