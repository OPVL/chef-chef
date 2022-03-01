<?php

namespace Tests\Unit\Action;

use App\Actions\SortIngredientsByType;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Type;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Should format keys by their type
 *
 * eg. [
 *      'type_name' => [
 *          ... // all ingredients belonging to this type
 *      ],
 *      ...
 *  ]
 */
class SortIngredientsByTypeTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function sort_puts_ingredients_by_type(): void
    {
        $types = Type::factory(5)
            ->create();

        $types->each(function (Type $type): void {
            Ingredient::factory(4)->type($type)->create();
        });

        $formatted = $this->action()->execute(Ingredient::all());

        $types->each(function (Type $type) use ($formatted): void {
            $this->assertArrayHasKey($type->name, $formatted, "{$type->name} not included in collection");
            $this->assertCount($type->ingredients->count(), $formatted[$type->name], "{$type->name} incorrect count");
        });
    }

    /** @test */
    public function sorts_recipe_ingredients_by_type(): void
    {
        $this->withoutExceptionHandling();

        $types = Type::factory(5)
            ->create();
        $types->each(function (Type $type): void {
            Ingredient::factory(4)->type($type)->create();
        });

        $recipe = Recipe::factory()->create();
        $ingredients = Ingredient::all();
        $recipe->ingredients()->attach($ingredients);

        $formatted = $this->action()->execute($recipe->ingredients);

        $types->each(function (Type $type) use ($formatted): void {
            $this->assertArrayHasKey($type->name, $formatted, "{$type->name} not included in collection");
            $this->assertCount($type->ingredients->count(), $formatted[$type->name], "{$type->name} incorrect count");
        });
    }

    protected function action(): SortIngredientsByType
    {
        return app(SortIngredientsByType::class);
    }
}
