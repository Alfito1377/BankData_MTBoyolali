<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('mt_afkir_dan_dispen', function (Blueprint $table) {
        $table->renameColumn('merk', 'merek');
    });
}

public function down()
{
    Schema::table('mt_afkir_dan_dispen', function (Blueprint $table) {
        $table->renameColumn('merek', 'merk');
    });
}
};
