<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeKendaran extends Model
{
    protected $table = 'typekendaran';

    protected $fillable = [
        'kode',
        'nama_kendaraan',
        'keterangan',
    ];
}