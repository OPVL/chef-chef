<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect(config('defaults.units'))
            ->sort()
            ->each(function (string $unit, string $label): void {
                Unit::create(['name' => $unit, 'label' => $label]);
            });
    }
}
