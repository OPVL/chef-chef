<?php

namespace Tests\Unit\Action;

use App\Actions\SortIngredientsByLocation;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\StorageLocation;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Should format keys by their location
 *
 * eg. [
 *      'location_name' => [
 *          ... // all ingredients belonging to this location
 *      ],
 *      ...
 *  ]
 */
class SortIngredientsByLocationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function sort_puts_ingredients_by_location(): void
    {
        $locations = StorageLocation::factory(5)
            ->create();

        $locations->each(function (StorageLocation $location): void {
            Ingredient::factory(4)->location($location)->create();
        });

        $formatted = $this->action()->execute(Ingredient::all());

        $locations->each(function (StorageLocation $location) use ($formatted): void {
            $this->assertArrayHasKey($location->name, $formatted, "{$location->name} not included in collection");
            $this->assertCount($location->ingredients->count(), $formatted[$location->name], "{$location->name} incorrect count");
        });
    }

    /** @test */
    public function sorts_recipe_ingredients_by_location(): void
    {
        $this->withoutExceptionHandling();

        $locations = StorageLocation::factory(5)
            ->create();
        $locations->each(function (StorageLocation $location): void {
            Ingredient::factory(4)->location($location)->create();
        });

        $recipe = Recipe::factory()->create();
        $ingredients = Ingredient::all();
        $recipe->ingredients()->attach($ingredients);

        $formatted = $this->action()->execute($recipe->ingredients);

        $locations->each(function (StorageLocation $location) use ($formatted): void {
            $this->assertArrayHasKey($location->name, $formatted, "{$location->name} not included in collection");
            $this->assertCount($location->ingredients->count(), $formatted[$location->name], "{$location->name} incorrect count");
        });
    }

    protected function action(): SortIngredientsByLocation
    {
        return app(SortIngredientsByLocation::class);
    }
}
