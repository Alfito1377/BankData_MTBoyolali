<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FieldOption;

class PabrikanTrailerSeeder extends Seeder
{
    public function run()
    {
        $pabrikanList = [
            'GELURAN ADI KARYA',
            'AWECO',
            'MECO',
            'ANTIKA RAYA',
            'SSB HEIL'

        ];

        foreach ($pabrikanList as $nama) {
            FieldOption::updateOrCreate(
                [
                    'field_name' => 'pabrikan_trailer',
                    'value' => $nama
                ]
            );
        }
    }
}