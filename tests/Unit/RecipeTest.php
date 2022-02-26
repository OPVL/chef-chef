<?php

namespace Tests\Unit;

use App\Models\Recipe;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RecipeTest extends TestCase
{
    use DatabaseMigrations;

    public function test_can_create_recipe(): void
    {
        $recipe = Recipe::factory()->create();

        $this->assertModelExists($recipe);
    }

    public function test_can_create_recipe_with_ingredients(): void
    {
        $recipe = Recipe::factory()->hasIngredients(5)->create();

        $this->assertModelExists($recipe);
        $this->assertNotEmpty($recipe->ingredients());
    }
}
