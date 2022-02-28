<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(config('defaults.units'))
            ->sort()
            ->each(function (string $unit, string $label): void {
                Unit::create(['name' => $unit, 'label' => $label]);
            });
    }
}
