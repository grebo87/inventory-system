<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'Tecnología',
                'description' => 'Tecnología',
                'code' => 'C01'
            ],
            [

                'name' => 'Bebidas',
                'description' => 'Bebidas',
                'code' => 'C02'
            ],
            [

                'name' => 'Alimentos',
                'description' => 'Alimentos',
                'code' => 'C03'
            ],
            [

                'name' => 'Automóviles',
                'description' => 'Automóviles',
                'code' => 'C04'
            ],
            [

                'name' => 'Calzado y ropa',
                'description' => 'Calzado y ropa',
                'code' => 'C05'
            ],
            [

                'name' => 'Electrodomésticos',
                'description' => 'Electrodomésticos',
                'code' => 'C06'
            ],
            [
                'name' => 'Productos de consumo masivo',
                'description' => 'Productos de consumo masivo',
                'code' => 'C07'
            ],
        ]);
    }
}
