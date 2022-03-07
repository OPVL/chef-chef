<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CuisineSeeder::class,
            UnitSeeder::class,
            TypeSeeder::class,
            IngredientSeeder::class,
        ]);
    }
}
