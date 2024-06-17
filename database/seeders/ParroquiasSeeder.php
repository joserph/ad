<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Parroquia;

class ParroquiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = public_path('assets/data/parroquias_final.csv');
        $file = fopen($path, 'r');

        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
            if ($data[0] != 'id') {
                Parroquia::create([
                    'nombre' => $data[1],
                    'municipio_id' => $data[2], // Asegúrate de que esto coincida con tu estructura de CSV
                ]);
            }
        }

        fclose($file);
    }
}
