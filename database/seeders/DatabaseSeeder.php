<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            InventarisSeeder::class,
            // Add more seeders if needed
        ]);
    }
}
