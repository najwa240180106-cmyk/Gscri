<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        Country::insert([
            [
                'name' => 'Indonesia',
                'risk' => 'LOW',
                'gdp' => 5.10,
                'inflation' => 2.40,
                'weather' => 'Normal',
                'port' => '17 Active',
                'latitude' => -2.5489,
                'longitude' => 118.0149,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}