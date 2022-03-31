<?php

namespace Tests\Feature\Admin;

use App\Models\Cuisine;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecipeTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    /** @test */
    public function user_cannot_access_admin_recipes(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get(route('admin.recipe.create'))->assertRedirect(route('home'));
    }

    /** @test */
    public function can_get_create_page(): void
    {
        $this->actingAs(User::factory()->admin()->create());

        $this->get(route('admin.recipe.create'))->assertOk();
    }

    /** @test */
    public function can_get_index_page(): void
    {
        $this->actingAs(User::factory()->admin()->create());

        $this->get(route('admin.recipe.index'))->assertOk();
    }

    /** @test */
    public function can_create_recipe(): void
    {
        $this->actingAs(User::factory()->admin()->create());
        $this->assertNull(Recipe::first(), 'Database not cleared from previous run');

        $cuisine = Cuisine::factory()->create();

        $payload = [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'cuisine_id' => $cuisine->id,
        ];

        $this->put(route('admin.recipe.store'), $payload)
            ->assertRedirect(route('admin.recipe.ingredient.create', 1))
            ->assertSessionHas('success', "created recipe: {$payload['name']}");

        $created = Recipe::first();

        $this->assertNotNull($created);
        $this->assertEquals($payload['name'], $created->name);
        $this->assertEquals($payload['description'], $created->description);
        $this->assertEquals($payload['cuisine_id'], $created->cuisine->id);
    }

    /** @test */
    public function can_update_recipe(): void
    {
        $this->actingAs(User::factory()->admin()->create());
        $recipe = Recipe::factory()->create();

        $cuisine = Cuisine::factory()->create();

        $payload = [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'cuisine_id' => $cuisine->id,
        ];

        $this->patch(route('admin.recipe.update', $recipe), $payload)
            ->assertRedirect(route('admin.recipe.index'))
            ->assertSessionHas('success', "updated recipe: {$payload['name']}");

        $updated = Recipe::first();

        $this->assertNotNull($updated);
        $this->assertEquals($recipe->id, $updated->id);
        $this->assertEquals($payload['name'], $updated->name);
        $this->assertEquals($payload['description'], $updated->description);
        $this->assertEquals($payload['cuisine_id'], $updated->cuisine->id);
    }

    /** @test */
    public function shows_list_of_recipes_on_index(): void
    {
        $this->actingAs(User::factory()->admin()->create());
        $cuisine = Cuisine::factory()->create();
        $recipes = Recipe::factory(5)->cuisine($cuisine)->create();

        $response = $this->get(route('admin.recipe.index'))->assertOk();
        $response->assertSeeText($cuisine->name);

        $recipes->each(function (Recipe $recipe) use ($response): void {
            $response->assertSeeText($recipe->name);
        });
    }

    /** @test */
    public function can_delete_recipe(): void
    {
        $this->actingAs(User::factory()->admin()->create());
        $recipe = Recipe::factory()->create();

        $this->delete(route('admin.recipe.delete', $recipe), ['confirm' => 'true'])
            ->assertRedirect(route('admin.recipe.index'))
            ->assertSessionHas('success', "deleted recipe: {$recipe->name}");

        $this->assertNull(Recipe::find($recipe->id));
    }
}
