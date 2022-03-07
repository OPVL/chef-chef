<?php

namespace Database\Seeders;

use App\Models\Cuisine;
use Illuminate\Database\Seeder;

class CuisineSeeder extends Seeder
{
    public function run(): void
    {
        $rows = collect(config('defaults.cuisines'))
            ->sort();
        $this->command->getOutput()->progressStart($rows->count());

        $rows->each(
            function (string $cuisine): void {
                if (!Cuisine::factory()->create(['name' => $cuisine])) {
                    return;
                }
                $this->command->getOutput()->progressAdvance();
            }
        );
        $this->command->getOutput()->progressFinish();
    }
}
