<?php

namespace Tests\Unit;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Unit;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class IngredientTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_create_ingredient(): void
    {
        $ingredient = Ingredient::factory()->create();

        $this->assertModelExists($ingredient);
    }

    /** @test */
    public function can_get_nice_display_name(): void
    {
        $unit = Unit::factory()->create(['name' => 'teaspoon', 'label' => 'tsp']);
        $ingredient = Ingredient::factory()->unit($unit)->create(['name' => 'salt']);

        $this->assertEquals('teaspoon of salt', $ingredient->display);
    }

    /** @test */
    public function can_get_nice_display_name_alt(): void
    {
        $unit = Unit::factory()->create(['name' => 'can', 'label' => 'can']);
        $ingredient = Ingredient::factory()->unit($unit)->create(['name' => 'baked beans']);

        $this->assertEquals('can of baked beans', $ingredient->display);
    }

    /** @test */
    public function will_use_pivot_when_available(): void
    {
        $unit = Unit::factory()->create(['name' => 'teaspoon']);
        $pivotUnit = Unit::factory()->create(['name' => 'gram', 'label' => 'g']);
        $ingredient = Ingredient::factory()->unit($unit)->create(['name' => 'salt']);
        $recipe = Recipe::factory()->create();

        $recipe->ingredients()->sync([$ingredient->id => [
            'quantity' => 20,
            'unit_id' => $pivotUnit->id,
        ]]);

        $this->assertEquals('20g of salt', $recipe->ingredients->first()->display);
    }

    /** @test */
    public function correctly_displays_small_pivot_units(): void
    {
        $unit = Unit::factory()->create(['name' => 'gram']);
        $pivotUnit = Unit::factory()->create(['name' => 'tablespoon', 'label' => 'tbsp']);
        $ingredient = Ingredient::factory()->unit($unit)->create(['name' => 'cumin']);
        $recipe = Recipe::factory()->create();

        $recipe->ingredients()->sync([$ingredient->id => [
            'quantity' => 0.5,
            'unit_id' => $pivotUnit->id,
        ]]);

        $this->assertEquals('1/2tbsp of cumin', $recipe->ingredients->first()->display);
    }

    /** @test */
    public function correctly_displays_small_pivot_units_alt(): void
    {
        $unit = Unit::factory()->create(['name' => 'gram', 'label' => 'g']);
        $pivotUnit = Unit::factory()->create(['name' => 'teaspoon', 'label' => 'tsp']);
        $ingredient = Ingredient::factory()->unit($unit)->create(['name' => 'paprika']);
        $recipe = Recipe::factory()->create();

        $recipe->ingredients()->sync([$ingredient->id => [
            'quantity' => 1 / 4,
            'unit_id' => $pivotUnit->id,
        ]]);

        $this->assertEquals('1/4tsp of paprika', $recipe->ingredients->first()->display);
    }

    /** @test */
    public function correctly_displays_non_measurable_units_singular(): void
    {
        $unit = Unit::factory()->create(['name' => 'gram', 'label' => 'g']);
        $pivotUnit = Unit::factory()->create(['name' => 'item', 'label' => 's', 'measurable' => false]);
        $ingredient = Ingredient::factory()->unit($unit)->create(['name' => 'lemon']);
        $recipe = Recipe::factory()->create();

        $recipe->ingredients()->sync([$ingredient->id => [
            'quantity' => 1,
            'unit_id' => $pivotUnit->id,
        ]]);

        $this->assertEquals('1 lemon', $recipe->ingredients->first()->display);
    }

    /** @test */
    public function correctly_displays_non_measurable_units_plural(): void
    {
        $unit = Unit::factory()->create(['name' => 'gram', 'label' => 'g']);
        $pivotUnit = Unit::factory()->create(['name' => 'item', 'label' => 's', 'measurable' => false]);
        $ingredient = Ingredient::factory()->unit($unit)->create(['name' => 'orange']);
        $recipe = Recipe::factory()->create();

        $recipe->ingredients()->sync([$ingredient->id => [
            'quantity' => 2,
            'unit_id' => $pivotUnit->id,
        ]]);

        $this->assertEquals('2 oranges', $recipe->ingredients->first()->display);
    }

    /** @test */
    public function correctly_displays_measurable_spaced(): void
    {
        $unit = Unit::factory()->create(['name' => 'gram', 'label' => 'g']);
        $pivotUnit = Unit::factory()->create(['name' => 'can', 'label' => 'can', 'should_space' => true]);
        $ingredient = Ingredient::factory()->unit($unit)->create(['name' => 'kidney beans']);
        $recipe = Recipe::factory()->create();

        $recipe->ingredients()->sync([$ingredient->id => [
            'quantity' => 2,
            'unit_id' => $pivotUnit->id,
        ]]);

        $this->assertEquals('2 can of kidney beans', $recipe->ingredients->first()->display);
    }

    /** @test */
    public function when_no_unit_on_pivot_ingredient_display_used()
    {
        $unit = Unit::factory()->create(['name' => 'can', 'label' => 'can']);
        $ingredient = Ingredient::factory()->unit($unit)->create(['name' => 'kidney beans']);
        $recipe = Recipe::factory()->create();

        $recipe->ingredients()->sync([$ingredient->id => []]);

        $this->assertEquals('can of kidney beans', $recipe->ingredients->first()->display);
    }

    /** @test */
    public function when_no_quantity_on_pivot_outputs_0()
    {
        $unit = Unit::factory()->create(['name' => 'can', 'label' => 'can']);
        $pivotUnit = Unit::factory()->create(['name' => 'cup', 'label' => 'cup', 'should_space' => true]);
        $ingredient = Ingredient::factory()->unit($unit)->create(['name' => 'kidney beans']);
        $recipe = Recipe::factory()->create();

        $recipe->ingredients()->sync([$ingredient->id => [
            'unit_id' => $pivotUnit->id,
        ]]);

        $this->assertEquals('0 cup of kidney beans', $recipe->ingredients->first()->display);
    }
}
