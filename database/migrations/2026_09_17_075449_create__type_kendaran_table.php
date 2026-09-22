<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('TypeKendaran', function (Blueprint $table) {
            $table->id();

            $table->string('kode', 150);

            $table->string('nama_kendaraan', 255)->nullable();

            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('TypeKendaran');
    }
};