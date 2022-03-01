<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect(config('defaults.types'))
            ->sort()
            ->each(function (string $type): void {
                Type::create(['name' => $type]);
            });
    }
}
