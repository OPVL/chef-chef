<?php

namespace Tests\Feature\Admin;

use App\Models\Allergen;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AllergenTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    /** @test */
    public function user_cannot_access_admin_allergens(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get(route('admin.allergen.create'))->assertRedirect(route('home'));
    }

    /** @test */
    public function can_get_create_page(): void
    {
        $this->actingAs(User::factory()->admin()->create());

        $this->get(route('admin.allergen.create'))->assertOk();
    }

    /** @test */
    public function can_get_index_page(): void
    {
        $this->actingAs(User::factory()->admin()->create());

        $this->get(route('admin.allergen.index'))->assertOk();
    }

    /** @test */
    public function can_create_allergen(): void
    {
        $this->actingAs(User::factory()->admin()->create());
        $this->assertNull(Allergen::first(), 'Database not cleared from previous run');

        $payload = [
            'name' => $this->faker->name(),
        ];

        $this->put(route('admin.allergen.store'), $payload)
            ->assertRedirect(route('admin.allergen.index'))
            ->assertSessionHas('success', "created allergen: {$payload['name']}");

        $created = Allergen::first();

        $this->assertNotNull($created);
        $this->assertEquals($payload['name'], $created->name);
        $this->assertFalse($created->animal_product);
    }

    /** @test */
    public function shows_list_of_allergens_on_index(): void
    {
        $this->actingAs(User::factory()->admin()->create());
        $allergens = Allergen::factory(5)->create();

        $response = $this->get(route('admin.allergen.index'))
            ->assertOk();

        $allergens->each(function (Allergen $allergen) use ($response): void {
            $response->assertSeeText($allergen->name);
        });
    }

    /** @test */
    public function can_delete_allergen(): void
    {
        $this->actingAs(User::factory()->admin()->create());
        $allergen = Allergen::factory()->create();

        $this->delete(route('admin.allergen.delete', $allergen), ['confirm' => 'true'])
            ->assertRedirect(route('admin.allergen.index'))
            ->assertSessionHas('success', "deleted allergen: {$allergen->name}");

        $this->assertNull(Allergen::find($allergen->id));
    }

    /** @test */
    public function can_update_allergen(): void
    {
        $this->actingAs(User::factory()->admin()->create());
        $allergen = Allergen::factory()
            ->create();

        $payload = [
            'name' => $this->faker->name(),
            'animal_product' => true,
        ];

        $this->patch(route('admin.allergen.update', $allergen), $payload)
            ->assertRedirect(route('admin.allergen.index'))
            ->assertSessionHas('success', "updated allergen: {$payload['name']}");

        $updated = Allergen::first();

        $this->assertNotNull($updated);
        $this->assertEquals($allergen->id, $updated->id);
        $this->assertNotEquals($allergen->name, $updated->name);
        $this->assertNotEquals($allergen->animal_product, $updated->animal_product);
        $this->assertEquals($payload['name'], $updated->name);
        $this->assertEquals($payload['animal_product'], $updated->animal_product);
    }
}
