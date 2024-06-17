<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Seccional;

class SeccionalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = public_path('assets/data/estados_final.csv');
        $file = fopen($path, 'r');

        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
            if ($data[0] != 'id') { // Evitar la cabecera si tiene una
                Seccional::create([
                    'nombre' => $data[1],
                ]);
            }
        }

        fclose($file);
    }
}
