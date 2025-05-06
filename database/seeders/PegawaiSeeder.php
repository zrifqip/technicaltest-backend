<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;


class PegawaiSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('pegawai')->insert([
                'NIP' => $faker->unique()->numerify('##################'),
                'Foto' => $faker->imageUrl(200, 200, 'people'),
                'Nama' => $faker->name,
                'Alamat' => $faker->address,
                'Tanggal_Lahir' => $faker->dateTimeBetween('-60 years', '-20 years')->format('Y-m-d'),
                'Jenis_Kelamin' => $faker->randomElement(['L', 'P']),
                'No_Handphone' => $faker->phoneNumber,
                'NPWP' => $faker->numerify('###############'),
                'Agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
                'Golongan' => $faker->randomElement(['I/a', 'I/b', 'I/c', 'I/d', 'II/a', 'II/b', 'II/c', 'II/d', 'III/a', 'III/b', 'III/c', 'III/d', 'IV/a', 'IV/b', 'IV/c', 'IV/d', 'IV/e']),
                'kota_lahir_id' => $faker->numberBetween(1, 10),
                'jabatan_id' => $faker->numberBetween(1, 5),
            ]);
        }
    }
}
