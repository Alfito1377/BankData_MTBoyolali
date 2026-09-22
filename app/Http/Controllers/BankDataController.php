<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankDataController extends Controller
{
    public function index()
    {
        // 1. Ambil daftar kelompok yang unik dari tabel bank_data
        $kelompokUrutan = DB::table('bank_data')
            ->whereNotNull('kelompok')
            ->distinct()
            ->pluck('kelompok')
            ->toArray();

        // Jika data kelompok masih kosong di database, gunakan default
        if (empty($kelompokUrutan)) {
            $kelompokUrutan = ['Boyolali', 'Cepu', 'PTO']; 
        }

        // 2. REKAPITULASI KATEGORI
        // Mengelompokkan jumlah unit berdasarkan kelompok dan kategori
        $rawKategori = DB::table('bank_data')
            ->select('kelompok', 'kategori', DB::raw('count(*) as total'))
            ->groupBy('kelompok', 'kategori')
            ->get();

        $kategoriPivot = [];
        foreach ($rawKategori as $item) {
            $kategoriPivot[$item->kelompok][$item->kategori] = $item->total;
        }

        // 3. REKAPITULASI KAPASITAS (Reguler & Afkir)
        $kapPerKelompok = [];
        $kapReg = [];
        $kapAfkir = [];

        $rawKapasitas = DB::table('bank_data')
            ->select('kelompok', 'kapasitas', 'status', 'aktif_tidak_aktif', DB::raw('count(*) as total'))
            ->groupBy('kelompok', 'kapasitas', 'status', 'aktif_tidak_aktif')
            ->get();

        foreach ($rawKapasitas as $item) {
            $kelompok = $item->kelompok;
            $kap = $item->kapasitas;
            
            // Daftarkan kapasitas per kelompok
            $kapPerKelompok[$kelompok][$kap] = true;

            // Logika pemisahan Reguler dan Afkir 
            // (Sesuaikan kondisi di bawah dengan isi kolom status / aktif_tidak_aktif di database Anda)
            $statusLower = strtolower($item->status ?? '');
            $aktifStatus = strtolower($item->aktif_tidak_aktif ?? '');

            // Contoh kondisi: Jika status mengandung kata 'afkir' atau tidak aktif, masuk ke afkir
            if (str_contains($statusLower, 'afkir') || $aktifStatus === 'tidak aktif') {
                $kapAfkir[$kelompok][$kap] = ($kapAfkir[$kelompok][$kap] ?? 0) + $item->total;
            } else {
                $kapReg[$kelompok][$kap] = ($kapReg[$kelompok][$kap] ?? 0) + $item->total;
            }
        }

        // Kirim data ke view
        return view('fleet.kategori-mt', compact(
            'kelompokUrutan',
            'kategoriPivot',
            'kapPerKelompok',
            'kapReg',
            'kapAfkir'
        ));
    }
}