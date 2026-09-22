<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeKendaran;

class TypeKendaranSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'SG8JE1BXGJ',
            'GKE 280 4X2T',
            'FM8JK2B-XGJ',
            'SG8JF2B-XGJ (4X2) M/T TRACTOR HEAD',
            'FIGHTER FN61FS (6X2) M/T',
            'FL8JN2A-PGJ (6X2) M/T',
            'FVM34U-NDYIN4 (TRONTON) 6X2 MT',
            'GKE 280 4X2T WB3500MM ABS MT',
            'GKE 280 4X2T WB3500MM E5 ABS MT',
            'GVR34U JDYIN4 TH42 MT',
            'GWE 280 6X4T WB 3400MM MT',
            'CA4256P1K2T1E5A80',
            'CA4256P1K2T1E5A81',
            'CA4256P1K2T1E5A82',
            'CA4256P1K2T1E5A83',
            'CA4256P1K2T1E5A84',
            'CA4256P1K2T1E5A85',
            'SG8JF2B-XGJ 4X2 MT TH',
            'FL8JNIA-BGJ TRONTON (6X2)',
            'FL8JNIA-BGJ',
            'GVR34U-JDYIN2 TH42 MT',
            'SG8JE1B EGJ (SG260TH)',
            'GKE2802W2WB3500MM2WM',
            'GVZ 34 KHP ABS (6X4) N',
            'FM8JK2B-XGJ 6X4 MT TH',
            'FL8JN1ABGJFL235JNT6W',
            'CDE 250 6X2R WB5100MM',
            'FL8JN1A-BGJ TRONT 6X2',
            'CDE250 6X2R WB4300MM',
            'MERCEDES BENZ 4028 T (4X2) M/T',
            'GWE 280 6X4T WB3400MM E5 ABS M/T',
            'MERCEDES BENZ 4928 T (6X4) M/T',
            'SG8JF2B XGJ',
            'SGSJF2B XGJ',
            'FM8JK28-XGJ (6X4) M/T TRACTOR HEAD',
            'GVR34U-JDYIN4 TH42 MT',
            'FUSO FZY1W 280T 4X2 MT',
            'GWE 280 6X4T WB3400MM M/T',
            'FL8JN1A-JGJ 6X2',
            'FM8JK1B-XGJ 6X4',
            'GVR34U-JDYIN4 (TRACTOR HEAD) (4X2) M',
            'GKE 280 4X2T WB3500MM ABS M/T',
            'GWE 280 6X4T WB3400MM M/T',
            'GWE 280 6X4T WB3400MM E5 ABS M/T',
            'CDE 250 6X2R WB4300M ABS M/T',
            '2526 R/4500 M-CAB (6X2) M/T',
            'FL8JN2A PGJ (6X2) M/T',
            'FL8JN2A PGJ',
            'GVR34U-JDYIN4 (T-HEAD) (4X2) M/T',
            'GKE28042TWB35ME5ABSM',
            'COLT DIESEL FE SHD-X K HI GEAR (4X2) M/T',
            'FE84G 4X2 MT',
            'CKE 250 4X2R',
            'WU342R-HKMTJD3 M/T',
            'COLT DIESEL FE 74 HD K (4X2) M/T',
            'XZU349R-HKMTBD3',
        ];

        foreach ($data as $item) {
            TypeKendaran::create([
                'kode' => $item,
                'nama_kendaraan' => $item,
                'keterangan' => null,
            ]);
        }
    }
}