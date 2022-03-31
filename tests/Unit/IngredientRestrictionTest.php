<?php

namespace Tests\Unit;

use App\Models\Ingredient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IngredientRestrictionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function ingredient_is_vegan(): void
    {

        $ingredient = Ingredient::factory()->create();

        $this->assertTrue($ingredient->isVegan);
    }
}
