<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Command: php -d memory_limit=350M artisan countries:seeder
        $this->call('Altwaireb\Countries\Database\Seeders\BaseCountriesSeeder');
    }
}
