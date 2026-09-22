<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BankData extends Model
{
    protected $table = 'bank_data';

    protected $guarded = ['id'];

    /**
     * Umur Trailer
     */
    public function getUmurTrailerAttribute()
    {
        if (empty($this->tahun_pembuatan_trailer)) {
            return null;
        }

        return now()->year - (int) $this->tahun_pembuatan_trailer;
    }

    /**
     * Umur Head Truck
     */
    public function getUmurHeadAttribute()
    {
        if (empty($this->tahun_stnk_head)) {
            return null;
        }

        return now()->year - (int) $this->tahun_stnk_head;
    }

    /**
     * Peringatan Afkir Trailer
     * Batas: 15 Tahun
     */
    public function getPeringatanAfkirTrailerAttribute()
    {
        if (empty($this->tahun_pembuatan_trailer)) {
            return [
                'label' => '-',
                'class' => 'secondary'
            ];
        }

        $umur = $this->umur_trailer;

        $maxTahun = 15;
        $ambangPeringatan = 13;

        if ($umur >= $maxTahun) {
            return [
                'label' => 'Afkir (Trailer)',
                'class' => 'danger'
            ];
        }

        if ($umur >= $ambangPeringatan) {
            return [
                'label' => 'Mendekati Afkir',
                'class' => 'warning'
            ];
        }

        return [
            'label' => 'Aman',
            'class' => 'success'
        ];
    }

    /**
     * Peringatan Afkir Head Truck
     * Batas: 10 Tahun
     */
    public function getPeringatanAfkirHeadAttribute()
    {
        if (empty($this->tahun_stnk_head)) {
            return [
                'label' => '-',
                'class' => 'secondary'
            ];
        }

        $umur = $this->umur_head;

        $maxTahun = 10;
        $ambangPeringatan = 8;

        if ($umur >= $maxTahun) {
            return [
                'label' => 'Afkir (Head)',
                'class' => 'danger'
            ];
        }

        if ($umur >= $ambangPeringatan) {
            return [
                'label' => 'Mendekati Afkir',
                'class' => 'warning'
            ];
        }

        return [
            'label' => 'Aman',
            'class' => 'success'
        ];
    }
    
}