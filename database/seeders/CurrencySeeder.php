<?php

namespace Database\Seeders;

use App\Models\Catalog\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::insert([
            [
                'code' => 'ARS',
                'name' => 'Peso argentino',
                'symbol' => '$',
                'country' => 'Argentina',
                'active' => false
            ],
            [
                'code' => 'BOB',
                'name' => 'Boliviano',
                'symbol' => 'Bs.',
                'country' => 'Bolivia',
                'active' => false
            ],
            [
                'code' => 'BRL',
                'name' => 'Real brasileño',
                'symbol' => 'R$',
                'country' => 'Brasil',
                'active' => false
            ],
            [
                'code' => 'CLP',
                'name' => 'Peso chileno',
                'symbol' => '$',
                'country' => 'Chile',
                'active' => false
            ],
            [
                'code' => 'COP',
                'name' => 'Peso colombiano',
                'symbol' => '$',
                'country' => 'Colombia',
                'active' => false
            ],
            [
                'code' => 'CRC',
                'name' => 'Colón costarricense',
                'symbol' => '₡',
                'country' => 'Costa Rica',
                'active' => false
            ],
            [
                'code' => 'CUP',
                'name' => 'Peso cubano',
                'symbol' => '₱',
                'country' => 'Cuba',
                'active' => false
            ],
            [
                'code' => 'DOP',
                'name' => 'Peso dominicano',
                'symbol' => 'RD$',
                'country' => 'República Dominicana',
                'active' => false
            ],
            [
                'code' => 'EUR',
                'name' => 'Euro',
                'symbol' => '€',
                'country' => 'Unión Europea',
                'active' => false
            ],
            [
                'code' => 'GYD',
                'name' => 'Dólar guyanés',
                'symbol' => '$',
                'country' => 'Guyana',
                'active' => false
            ],
            [
                'code' => 'MXN',
                'name' => 'Peso mexicano',
                'symbol' => '$',
                'country' => 'México',
                'active' => false
            ],
            [
                'code' => 'PAB',
                'name' => 'Balboa panameño',
                'symbol' => 'B/.',
                'country' => 'Panamá',
                'active' => false
            ],
            [
                'code' => 'PEN',
                'name' => 'Sol peruano',
                'symbol' => 'S/.',
                'country' => 'Perú',
                'active' => false
            ],
            [
                'code' => 'PYG',
                'name' => 'Guaraní paraguayo',
                'symbol' => '₲',
                'country' => 'Paraguay',
                'active' => false
            ],
            [
                'code' => 'UYU',
                'name' => 'Peso uruguayo',
                'symbol' => '$',
                'country' => 'Uruguay',
                'active' => false
            ],
            [
                'code' => 'USD',
                'name' => 'Dólar estadounidense',
                'symbol' => '$',
                'country' => 'Estados Unidos',
                'active' => true
            ],
            [
                'code' => 'VEF',
                'name' => 'Bolívar venezolano',
                'symbol' => 'Bs.',
                'country' => 'Venezuela',
                'active' => true
            ],
        ]);
    }
}
