<?php

namespace Database\Seeders;

use App\Models\Catalog\MeasurementUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeasurementUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MeasurementUnit::insert([
            [
                'name' => 'Kilos',
                'symbol' => 'KGM',
                'active' => true
            ],
            [
                'name' => 'Caja',
                'symbol' => 'BX',
                'active' => true
            ],
            [
                'name' => 'Galones',
                'symbol' => 'GLL',
                'active' => true
            ],
            [
                'name' => 'Gramos',
                'symbol' => 'GRM',
                'active' => true
            ],
            [
                'name' => 'Litros',
                'symbol' => 'LTR',
                'active' => true
            ],
            [
                'name' => 'Metros',
                'symbol' => 'MTR',
                'active' => true
            ],
            [
                'name' => 'Unidades',
                'symbol' => 'NIU',
                'active' => true
            ],
        ]);
    }
}
