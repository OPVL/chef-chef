<?php

namespace Tests\Unit\Action;

use App\Actions\SortIngredientsByLocation;
use App\Models\Ingredient;
use PHPUnit\Framework\TestCase;
use App\Models\Recipe;
use App\Models\StorageLocation;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SortIngredientsByLocationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function test_that_true_is_true(): void
    {
        // $this->except();

        $ingredients = collect();
        StorageLocation::factory(5)->create()->each(function (StorageLocation $storageLocation) use (&$ingredients) {
            $ingredients->push(Ingredient::factory(5)->location($storageLocation)->make());
        });
        $recipe = Recipe::factory()->create();

        $recipe->ingredients()->saveMany($ingredients);

        dd($recipe->ingredients);
    }

    protected function action(): SortIngredientsByLocation
    {
        return app(SortIngredientsByLocation::class);
    }
}
