<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('mt_afkir_dan_dispen', function (Blueprint $table) {
            $table->id();
            $table->string('nopol')->unique(); 
            $table->integer('kapasitas'); 
            $table->string('kepemilikan'); 
            $table->string('status');
            $table->date('tahun_pembuatan');
            $table->string('merk');
            $table->date('tmt_afkir');
            $table->string('status_peremajaan');
            $table->string('operasi');
            $table->string('lama_afkir');
            $table->text('keterangan')->nullable();
            $table->string('timeline_peremajaan');
            $table->string('kelompok')->nullable(); 
            $table->timestamps();
        });
    }
};