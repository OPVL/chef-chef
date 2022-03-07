<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = collect(
            collect(config('defaults.units'))
        );
        if ($this->command) {
            $this->command->getOutput()->progressStart($rows->count());
        }

        $rows->sort()
            ->each(
                function (array|string $data, string $label): void {
                    if (is_array($data)) {
                        $data['name'] = Str::ucfirst($data['name']);
                        $unit = Unit::create(array_merge(['label' => $label], $data));
                    } else {
                        $unit = Unit::create(['label' => $label, 'name' => Str::ucfirst($data)]);
                    }

                    if (!$unit || $this->command === null) {
                        return;
                    }

                    $this->command->getOutput()->progressAdvance();
                }
            );
        if (!$this->command) {
            return;
        }

        $this->command->getOutput()->progressFinish();
    }
}
