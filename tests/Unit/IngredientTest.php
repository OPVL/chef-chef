<?php

namespace Tests\Unit;

use App\Models\Ingredient;
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
        $unit = Unit::factory()->create();
        $ingredient = Ingredient::factory()->unit($unit)->create();

        dd($ingredient->display);
    }
}
