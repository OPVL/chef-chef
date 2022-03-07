<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Type;
use App\Models\Unit;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class IngredientSeeder extends Seeder
{
    public function __construct(protected Csv $csv)
    {
        $this->csv->setFile('ingredients.csv');
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = collect($this->csv->read());
        if ($this->command) {
            $this->command->getOutput()->progressStart($rows->count());
        }

        $rows->each(
            function (array $ingredient): void {
                $payload = [
                    'name' => Str::headline($ingredient[0]),
                    'unit_id' => $this->getUnit($ingredient[2])->id,
                    'type_id' => $this->getType($ingredient[1], true)->id,
                ];

                if (!Ingredient::firstOrCreate($payload) && $this->command) {
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

    public function runDefaults(): void
    {
        $rows = collect(config('defaults.ingredients'))
            ->sort();
        if ($this->command) {
            $this->command->getOutput()->progressStart($rows->count());
        }


        $rows->map(
            function (array $ingredient): void {
                $payload = [
                    'name' => $ingredient['name'],
                    'unit_id' => $this->getUnit($ingredient['unit'])->id,
                    'type_id' => $this->getType($ingredient['type'], true)->id,
                ];

                if (!Ingredient::firstOrCreate($payload) || $this->command === null) {
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

    public function getUnit(string $label): Unit
    {
        try {
            return Unit::where('label', 'like', "%{$label}%")
                ->firstOrFail();
        } catch (ModelNotFoundException $th) {
            Log::warning("Unable to find Unit", ['label' => $label, 'error' => $th->getMessage()]);
            return Unit::where(config('fallback.unit'))->first();
        }
    }

    public function getType(string $name, bool $create = false): Type
    {
        try {
            return Type::where('name', 'like', "%{$name}%")
                ->firstOrFail();
        } catch (ModelNotFoundException $th) {
            Log::warning("Unable to find Type", ['name' => $name, 'error' => $th->getMessage()]);
            if ($create) {
                return Type::firstOrCreate(['name' => Str::ucfirst($name)]);
            }
            return Type::where(config('fallback.type'))->first();
        }
    }
}
