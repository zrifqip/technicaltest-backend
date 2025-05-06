<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;
class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1, 10) as $index) {
            DB::table('jabatan')->insert([
                'Nama_Jabatan' => 'Jabatan ' . $index, // Randomize name or keep it sequential
                'Eselon' => 'Eselon ' . rand(1, 3), // Randomize Eselon between 1 to 3
                'id_unit_kerja' => rand(1, 10), // Randomize id_unit_kerja between 1 and 10
                'id_kota_kerja' => rand(1, 10), // Randomize id_kota_kerja between 1 and 10
            ]);
        }
    }
}
