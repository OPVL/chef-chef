<?php

namespace Database\Seeders;

use App\Models\Allergen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AllergenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = collect(
            collect(config('defaults.allergens'))
        );
        $this->command->getOutput()->progressStart($rows->count());

        $rows->sort()
            ->each(
                function (string|array $allergen, $name): void {

                    if (is_array($allergen)) {
                        $allergen['name'] = Str::ucfirst($name);
                        $allergen = Allergen::create($allergen);
                    } else {
                        $allergen = Allergen::create(['name' => Str::ucfirst($allergen)]);
                    }

                    if (!$allergen || $this->command === null) {
                        return;
                    }

                    $this->command->getOutput()->progressAdvance();
                }
            );
        $this->command->getOutput()->progressFinish();
    }
}
