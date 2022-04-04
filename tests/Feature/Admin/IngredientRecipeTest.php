<?php

namespace Tests\Feature\Admin;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Type;
use App\Models\Unit;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IngredientRecipeTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    /** @test */
    public function user_cannot_create_page_without_recipe(): void
    {
        $this->asAdmin();
        $this->get(route('admin.recipe.ingredient.create', 1))->assertStatus(404);
    }

    /** @test */
    public function can_get_create_page(): void
    {
        $this->withoutExceptionHandling();

        $this->asAdmin();
        $recipe = Recipe::factory()->create();
        $url = route('admin.recipe.ingredient.create', $recipe->id);
        // dd($url);

        $this->get($url)->assertOk();
    }

    /** @test */
    public function can_store_ingredients_against_recipe(): void
    {
        $this->withoutExceptionHandling();

        $this->asAdmin();
        $recipe = Recipe::factory()->create();
        $ingredients = Ingredient::factory(5)->create();

        $payload = [
            'ingredient' => $ingredients->pluck('id')->toArray(),
        ];

        $this->put(route('admin.recipe.ingredient.store', $recipe), $payload)
            ->assertRedirect(route('admin.recipe.ingredient.edit', $recipe))
            ->assertSessionHas('success', "stored {$ingredients->count()} ingredients for recipe: {$recipe->name}");
    }

    /** @test */
    public function can_store_ingredients_quantities_against_recipe(): void
    {
        $this->withoutExceptionHandling();

        $this->asAdmin();
        $recipe = Recipe::factory()->create();
        $ingredientsOne = Ingredient::factory(5)->create();

        $ingredientsTwo = Ingredient::factory(5)->create();

        $payload = [
            'quantity' => $ingredientsTwo->map(function ($ingredient) {
                return (float) ($this->faker->numberBetween(0, 1000) / 10);
            }),
            'unit' => $ingredientsTwo->pluck('id')->toArray(),
        ];

        // dd($payload);

        $this->patch(route('admin.recipe.ingredient.update', $recipe), $payload)
            ->assertRedirect(route('admin.recipe.get', $recipe))
            ->assertSessionHas('success', "updated {$ingredientsTwo->count()} ingredients for recipe: {$recipe->name}");

        $this->assertCount(5, $recipe->ingredients);
    }

    /** @test */
    public function can_delete_ingredient(): void
    {
        $this->asAdmin();
        $ingredient = Ingredient::factory()->create();

        $this->delete(route('admin.ingredient.delete', $ingredient), ['confirm' => 'true'])
            ->assertRedirect(route('admin.ingredient.index'))
            ->assertSessionHas('success', "deleted ingredient: {$ingredient->name}");

        $this->assertNull(Ingredient::find($ingredient->id));
    }

    /** @test */
    public function can_update_ingredient(): void
    {
        $this->asAdmin();
        $ingredient = Ingredient::factory()
            ->unit(Unit::factory()->create())
            ->type(Type::factory()->create())
            ->create();

        $payload = [
            'name' => $this->faker->name(),
            'unit_id' => Unit::factory()->create()->id,
            'type_id' => Type::factory()->create()->id,
        ];

        $this->patch(route('admin.ingredient.update', $ingredient), $payload)
            ->assertRedirect(route('admin.ingredient.index'))
            ->assertSessionHas('success', "updated ingredient: {$payload['name']}");

        $updated = Ingredient::first();

        $this->assertNotNull($updated);
        $this->assertEquals($ingredient->id, $updated->id);
        $this->assertNotEquals($ingredient->name, $updated->name);
        $this->assertNotEquals($ingredient->unit_id, $updated->unit_id);
        $this->assertNotEquals($ingredient->type_id, $updated->type_id);
        $this->assertEquals($payload['name'], $updated->name);
        $this->assertEquals($payload['unit_id'], $updated->unit_id);
        $this->assertEquals($payload['type_id'], $updated->type_id);
    }
}
