<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NoticeCategories;

class NoticeCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Política',
            'Economía',
            'Deportes',
            'Entretenimiento',
            'Tecnología',
            'Salud',
            'Cultura',
            'Ciencia',
            'Educación',
            'Medio Ambiente'
        ];

        foreach ($categories as $categoryName) {
            NoticeCategories::create(['name' => $categoryName]);
        }
    }
}

