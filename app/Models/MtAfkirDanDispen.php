<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MtAfkirDanDispen extends Model
{
    protected $table = 'mt_afkir_dan_dispen';
    protected $guarded = ['id'];

    /**
     * Accessor untuk Peringatan Afkir (Batas 10/15 Tahun)
     */
    public function getPeringatanAfkirTrailerAttribute()
    {
        // Menggunakan kolom tahun_pembuatan yang ada di database Anda
        if (empty($this->tahun_pembuatan)) {
            return ['label' => '-', 'class' => 'success'];
        }

        $umur = Carbon::parse($this->tahun_pembuatan)->diffInYears(now());
        $maxTahun = 15;
        $ambangPeringatan = 13; // 2 tahun sebelum batas akhir

        if ($umur >= $maxTahun) {
            return ['label' => 'Afkir (Trailer)', 'class' => 'danger'];
        } elseif ($umur >= $ambangPeringatan) {
            return ['label' => 'Mendekati Afkir', 'class' => 'warning'];
        }

        return ['label' => 'Aman', 'class' => 'success'];
    }

    public function getPeringatanAfkirHeadAttribute()
    {
        // Menggunakan kolom tahun_pembuatan yang ada di database Anda
        if (empty($this->tahun_pembuatan)) {
            return ['label' => '-', 'class' => 'success'];
        }

        $umur = Carbon::parse($this->tahun_pembuatan)->diffInYears(now());
        $maxTahun = 10;
        $ambangPeringatan = 8; // 2 tahun sebelum batas akhir

        if ($umur >= $maxTahun) {
            return ['label' => 'Afkir (Head)', 'class' => 'danger'];
        } elseif ($umur >= $ambangPeringatan) {
            return ['label' => 'Mendekati Afkir', 'class' => 'warning'];
        }

        return ['label' => 'Aman', 'class' => 'success'];
    }
}