<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Brand::factory(100)->create();
        Brand::insert([
            [
                'name' => 'Coca-Cola',
            ],
            [
                'name' => 'Pepsi',
            ],
            [
                'name' => 'Nike',
            ],
            [
                'name' => 'Adidas',
            ],
            [
                'name' => 'Puma',
            ],
            [
                'name' => 'LG',
            ],
            [
                'name' => 'Sony',
            ],
            [
                'name' => 'Samsung',
            ],
            [
                'name' => 'Philips',
            ],
            [
                'name' => 'Unilever',
            ]
        ]);
    }
}
