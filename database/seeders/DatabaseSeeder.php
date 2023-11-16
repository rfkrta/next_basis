<?php

use AzisHapidin\IndoRegion\IndoRegion;
use Database\Seeders\DummyUsersSeeder;
use Database\Seeders\IndoRegionDistrictSeeder;
use Database\Seeders\IndoRegionProvinceSeeder;
use Database\Seeders\IndoRegionRegencySeeder;
use Database\Seeders\IndoRegionSeeder;
use Database\Seeders\IndoRegionVillageSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(DummyUsersSeeder::class);
        $this->call(IndoRegionSeeder::class);
        $this->call(IndoRegionRegencySeeder::class);
        $this->call(IndoRegionDistrictSeeder::class);
        $this->call(IndoRegionProvinceSeeder::class);
        $this->call(IndoRegionVillageSeeder::class);
    }
}
