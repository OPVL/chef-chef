<?php

namespace Tests\Unit\Action;

use App\Actions\SortIngredientsByLocation;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\StorageLocation;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SortIngredientsByLocationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function test_that_true_is_true(): void
    {
        StorageLocation::factory(5)
            ->create()->each(function (StorageLocation $location): void {
                Ingredient::factory(4)->location($location)->create();
            });
        $recipe = Recipe::factory()->create();
        $ingredients = Ingredient::all();
        $recipe->ingredients()->attach($ingredients);


        $formatted = $this->action()->execute($recipe->ingredients);

        dd($formatted);
    }

    protected function action(): SortIngredientsByLocation
    {
        return app(SortIngredientsByLocation::class);
    }
}
