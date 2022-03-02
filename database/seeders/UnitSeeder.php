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
            ->each(
                function (array|string $data, string $label): Unit {
                    if (is_array($data)) {
                        return Unit::create(array_merge(['label' => $label], $data));
                    }

                    return Unit::create(['label' => $label, 'name' => $data]);
                }
            );
    }
}
