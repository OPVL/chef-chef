<?php

namespace Tests\Unit;

use App\Models\Allergen;
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
    public function when_no_unit_on_pivot_ingredient_display_used(): void
    {
        $unit = Unit::factory()->create(['name' => 'can', 'label' => 'can']);
        $ingredient = Ingredient::factory()->unit($unit)->create(['name' => 'kidney beans']);
        $recipe = Recipe::factory()->create();

        $recipe->ingredients()->sync([$ingredient->id => []]);

        $this->assertEquals('can of kidney beans', $recipe->ingredients->first()->display);
    }

    /** @test */
    public function when_no_quantity_on_pivot_outputs_0(): void
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

    /** @test */
    public function can_be_vegan(): void
    {
        $ingredient = Ingredient::factory()->create();

        $this->assertFalse($ingredient->animal_product);
        $this->assertTrue($ingredient->isVegan);
    }

    /** @test */
    public function can_have_allergens(): void
    {
        /** @var Allergen $allergen */
        $allergen = Allergen::factory()->create();
        /** @var Ingredient $ingredient */
        $ingredient = Ingredient::factory()->allergens([$allergen])->create();

        $this->assertContains($allergen->id, $ingredient->fresh()->allergens->pluck('id'));
    }

    /** @test */
    public function can_get_ingredients_without_gluten_scope(): void
    {
        /** @var Allergen $allergen */
        $allergen = Allergen::factory()->create(['name' => 'gluten']);
        $glutenIngredients = Ingredient::factory(5)->allergens([$allergen])->create();
        $noGlutenIngredients = Ingredient::factory(5)->create();
        $glutenFree = Ingredient::select('id')->glutenFree()->get();

        $this->assertCount(10, Ingredient::all());
        $this->assertCount(5, Ingredient::select('id')->glutenFree()->get());

        $glutenIngredients->each(function (Ingredient $ingredient) use ($glutenFree): void {
            $this->assertNotContains($ingredient->id, $glutenFree->pluck('id'));
        });
    }

    /** @test */
    public function can_get_ingredients_without_allergens_scope(): void
    {
        $gluten = Allergen::factory()->create(['name' => 'gluten']);
        $shellfish = Allergen::factory()->create(['name' => 'shellfish']);

        $glutenIngredients = Ingredient::factory(5)->allergens([$gluten])->create();
        $shellfishIngredients = Ingredient::factory(5)->allergens([$shellfish])->create();
        $cleanIngredients = Ingredient::factory(5)->create();

        $glutenIngredientsCollection = Ingredient::select('id')->withoutAllergens($gluten)->get();
        $shellfishIngredientsCollection = Ingredient::select('id')->withoutAllergens($shellfish)->get();
        $cleanIngredientsCollection = Ingredient::select('id')->withoutAllergens($gluten, $shellfish)->get();

        $this->assertCount(15, Ingredient::all());
        $this->assertCount(10, $glutenIngredientsCollection);
        $this->assertCount(10, $shellfishIngredientsCollection);
        $this->assertCount(5, $cleanIngredientsCollection);

        $glutenIngredients->each(function (Ingredient $ingredient) use ($glutenIngredientsCollection): void {
            $this->assertNotContains($ingredient->id, $glutenIngredientsCollection->pluck('id'));
        });

        $shellfishIngredients->each(function (Ingredient $ingredient) use ($shellfishIngredientsCollection): void {
            $this->assertNotContains($ingredient->id, $shellfishIngredientsCollection->pluck('id'));
        });

        $cleanIngredients->each(function (Ingredient $ingredient) use ($cleanIngredientsCollection): void {
            $this->assertContains($ingredient->id, $cleanIngredientsCollection->pluck('id'));
        });
    }

    /** @test */
    public function can_get_ingredients_with_allergens_scope(): void
    {
        $gluten = Allergen::factory()->create(['name' => 'gluten']);
        $shellfish = Allergen::factory()->create(['name' => 'shellfish']);

        $glutenIngredients = Ingredient::factory(5)->allergens([$gluten])->create();
        $shellfishIngredients = Ingredient::factory(5)->allergens([$shellfish])->create();
        $cleanIngredients = Ingredient::factory(5)->create();

        $glutenIngredientsCollection = Ingredient::select('id')->withAllergens($gluten)->get();
        $shellfishIngredientsCollection = Ingredient::select('id')->withAllergens($shellfish)->get();
        $bothIngredientsCollection = Ingredient::select('id')->withAllergens($gluten, $shellfish)->get();

        $this->assertCount($glutenIngredients->count() + $shellfishIngredients->count() + $cleanIngredients->count(), Ingredient::all());
        $this->assertCount($glutenIngredients->count(), $glutenIngredientsCollection);
        $this->assertCount($shellfishIngredients->count(), $shellfishIngredientsCollection);
        $this->assertCount($glutenIngredients->count() + $shellfishIngredients->count(), $bothIngredientsCollection);

        $glutenIngredients->each(function (Ingredient $ingredient) use ($glutenIngredientsCollection): void {
            $this->assertContains($ingredient->id, $glutenIngredientsCollection->pluck('id'));
        });

        $shellfishIngredients->each(function (Ingredient $ingredient) use ($shellfishIngredientsCollection): void {
            $this->assertContains($ingredient->id, $shellfishIngredientsCollection->pluck('id'));
        });

        $cleanIngredients->each(function (Ingredient $ingredient) use ($bothIngredientsCollection): void {
            $this->assertNotContains($ingredient->id, $bothIngredientsCollection->pluck('id'));
        });
    }
}
