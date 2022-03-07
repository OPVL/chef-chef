<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = collect(
            collect(config('defaults.types'))
        );
        $this->command->getOutput()->progressStart($rows->count());

        $rows->sort()
            ->each(
                function (string $type): void {
                    if (!Type::create(['name' => Str::ucfirst($type)])) {
                        return;
                    }

                    $this->command->getOutput()->progressAdvance();
                }
            );
        $this->command->getOutput()->progressFinish();
    }
}
