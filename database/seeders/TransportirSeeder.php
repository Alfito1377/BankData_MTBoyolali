<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ListTransportir;

class TransportirSeeder extends Seeder
{
    public function run()
    {
        // Saya telah menyalin daftar dari gambar Anda
        $data = [
            'PT. ADAM TRANS', 'PT. ANUGERAH BUMI MUSI', 'PT. BINA SYAREKAH',
            'PT. DHARMA CITRA ENERGI', 'PT. ELNUSA PETROFIN', 'PT. KARYA MAS',
            'PT. KARYO DIKROMO', 'PT. KHARISMA DWI TUNGGAL', 'PT. KOPNAS PERTAMINA BERSATU',
            'PT. LUMAS PRIMA MAKMUR', 'PT. MADIUN RAYA TRANSPORT', 'PT. NIRTA MAJAPAHIT',
            'PT. PANJI PERKASA', 'PT. PATRA LOGISTIK', 'PT. PERTAMINA PATRA NIAGA',
            'PT. PRASETYA WAHYU. M', 'PT. PUSPITA CIPTA', 'PT. PUTRA RAJEKWESI DP',
            'PT. PUTRA WAHYU PERSADA', 'PT. SINAR', 'PT. SINAR WAHANA SURYA',
            'PT. SONTO PUTRO', 'PT. SUMBER SANTOSO', 'PT. SURA RAYA INTI',
            'PT. SURYA DIAN KENCANA ABADI', 'PT. TRESTON', 'PT. WAHYU ARMADITA',
            'PT. WAHYU BARU SEJAHTERA', 'PT. KARSA MITRA SELARAS', 'PT. SUMBER TRANS NIAGA'
        ];

        foreach ($data as $nama) {
            ListTransportir::create(['nama' => $nama]);
        }
    }
}