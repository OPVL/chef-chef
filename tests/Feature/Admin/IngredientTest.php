<?php

namespace Tests\Feature\Admin;

use App\Models\Ingredient;
use App\Models\Type;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IngredientTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    /** @test */
    public function user_cannot_access_admin_ingredients(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get(route('admin.ingredient.create'))->assertRedirect(route('home'));
    }

    /** @test */
    public function can_get_create_page(): void
    {
        $this->actingAs(User::factory()->admin()->create());

        $this->get(route('admin.ingredient.create'))->assertOk();
    }

    /** @test */
    public function can_get_index_page(): void
    {
        $this->actingAs(User::factory()->admin()->create());

        $this->get(route('admin.ingredient.index'))->assertOk();
    }

    /** @test */
    public function can_create_ingredient(): void
    {
        $this->actingAs(User::factory()->admin()->create());
        $this->assertNull(Ingredient::first(), 'Database not cleared from previous run');

        $unit = Unit::factory()->create();
        $type = Type::factory()->create();

        $payload = [
            'name' => $this->faker->name(),
            'unit_id' => $unit->id,
            'type_id' => $type->id,
        ];

        $this->put(route('admin.ingredient.store'), $payload)
            ->assertRedirect(route('admin.ingredient.index'))
            ->assertSessionHas('success', "created ingredient: {$payload['name']}");

        $created = Ingredient::first();

        $this->assertNotNull($created);
        $this->assertEquals($payload['name'], $created->name);
        $this->assertEquals($payload['unit_id'], $created->unit->id);
        $this->assertEquals($payload['type_id'], $created->type->id);
    }

    /** @test */
    public function shows_list_of_ingredients_on_index(): void
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::factory()->admin()->create());
        $type = Type::factory()->create();
        $unit = Unit::factory()->create();
        $ingredients = Ingredient::factory(5)->type($type)->unit($unit)->create();

        $response = $this->get(route('admin.ingredient.index'))
            ->assertOk();
        $response->assertSeeText($type->name);

        $ingredients->each(function (Ingredient $ingredient) use ($response): void {
            $response->assertSeeText($ingredient->name);
        });
    }

    /** @test */
    public function can_delete_ingredient(): void
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::factory()->admin()->create());
        $ingredient = Ingredient::factory()->create();

        $this->delete(route('admin.ingredient.delete', $ingredient), ['confirm' => 'true'])
            ->assertRedirect(route('admin.ingredient.index'))
            ->assertSessionHas('success', "deleted ingredient: {$ingredient->name}");

        $this->assertNull(Ingredient::find($ingredient->id));
    }

    /** @test */
    public function can_update_ingredient(): void
    {
        $this->actingAs(User::factory()->admin()->create());
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
