<?php

namespace Database\Seeders;

use App\Models\Cuisine;
use Illuminate\Database\Seeder;

class CuisineSeeder extends Seeder
{
    public function run(): void
    {
        collect(config('defaults.cuisines'))
            ->sort()
            ->each(function (string $cuisine): void {
                Cuisine::factory()->create(['name' => $cuisine]);
            });
    }
}
