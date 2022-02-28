<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        app(CuisineSeeder::class)->run();
        app(UnitSeeder::class)->run();
        app(StorageLocationSeeder::class)->run();
        app(IngredientSeeder::class)->run();
    }
}
