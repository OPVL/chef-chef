<?php

namespace Tests\Unit\Action;

use App\Actions\SortIngredientsByType;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Type;
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
class SortIngredientsByTypeTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function sort_puts_ingredients_by_location(): void
    {
        $locations = Type::factory(5)
            ->create();

        $locations->each(function (Type $location): void {
            Ingredient::factory(4)->location($location)->create();
        });

        $formatted = $this->action()->execute(Ingredient::all());

        $locations->each(function (Type $location) use ($formatted): void {
            $this->assertArrayHasKey($location->name, $formatted, "{$location->name} not included in collection");
            $this->assertCount($location->ingredients->count(), $formatted[$location->name], "{$location->name} incorrect count");
        });
    }

    /** @test */
    public function sorts_recipe_ingredients_by_location(): void
    {
        $this->withoutExceptionHandling();

        $locations = Type::factory(5)
            ->create();
        $locations->each(function (Type $location): void {
            Ingredient::factory(4)->location($location)->create();
        });

        $recipe = Recipe::factory()->create();
        $ingredients = Ingredient::all();
        $recipe->ingredients()->attach($ingredients);

        $formatted = $this->action()->execute($recipe->ingredients);

        $locations->each(function (Type $location) use ($formatted): void {
            $this->assertArrayHasKey($location->name, $formatted, "{$location->name} not included in collection");
            $this->assertCount($location->ingredients->count(), $formatted[$location->name], "{$location->name} incorrect count");
        });
    }

    protected function action(): SortIngredientsByType
    {
        return app(SortIngredientsByType::class);
    }
}
