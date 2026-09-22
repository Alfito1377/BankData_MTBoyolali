<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('bank_data', function (Blueprint $table) {
            $table->id();
            $table->string('nopol')->unique(); 
            $table->integer('kapasitas'); 
            $table->string('transportir');
            $table->string('status');
            $table->date('tahun_pembuatan_trailer'); 
            $table->date('tahun_stnk_head');
            $table->string('merek'); 
            $table->string('type');
            $table->string('nomor_mesin');
            $table->string('nomor_rangka');
            $table->string('kategori');
            $table->string('pabrikan_trailer');
            $table->string('material_tangki');
            $table->integer('jumlah_kompartemen');
            $table->string('status_asuransi');
            $table->enum('aktif_tidak_aktif', ['Aktif', 'Tidak Aktif']); 
            
            // 2. TAMBAHKAN nullable() pada field ini agar bisa dikosongkan
            $table->string('keterangan_dispen')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('keterangan_euro'); // (Bila Euro juga boleh kosong, tambahkan ->nullable() juga)
            $table->string('kompensator_fifth_wheel')->nullable();
            $table->date('tanggal_operasi_awal')->nullable();
            
            $table->string('kelompok')->nullable(); 
            $table->timestamps();
        });
    }
};