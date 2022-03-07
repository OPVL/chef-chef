<?php

namespace Tests\Feature;

use App\Models\Ingredient;
use App\Models\User;
use Database\Seeders\IngredientSeeder;
use Database\Seeders\UnitSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\TestCase;

class AjaxControllerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function unauthenticated_user_cannot_ajax(): void
    {
        $this->get(route('ajax.ingredient'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_user_can_ajax(): void
    {
        $this->actingAs(User::factory()->create());
        $this->get(route('ajax.ingredient'))
            ->assertOk();
    }

    /** @test */
    public function can_get_ingredients(): void
    {
        $this->actingAs(User::factory()->create());
        $this->seedDefaultIngredients();

        $ingredient = Ingredient::first();
        $this->get(
            route(
                'ajax.ingredient',
                ['query' => Str::substr($ingredient->name, 2, 5)]
            )
        )->assertOk()
            ->assertSeeText($ingredient->name);
    }

    /** @test */
    public function ingredients_only_show_close_matches(): void
    {
        $this->actingAs(User::factory()->create());
        $this->seedDefaultIngredients();

        $first = Ingredient::orderBy('id', 'asc')->first();
        $last = Ingredient::orderBy('id', 'desc')->first();

        $this->assertNotEquals($first->id, $last->id);
        $this->get(
            route(
                'ajax.ingredient',
                [
                    'query' => Str::substr($first->name, 2, 5),
                ]
            )
        )->assertOk()
            ->assertSeeText($first->name)
            ->assertDontSeeText($last->name);
    }

    protected function seedDefaultIngredients(): void
    {
        App(UnitSeeder::class)->run();
        App(IngredientSeeder::class)->runDefaults();
    }
}
