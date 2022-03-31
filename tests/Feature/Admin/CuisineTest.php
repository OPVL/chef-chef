<?php

namespace Tests\Feature\Admin;

use App\Models\Cuisine;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CuisineTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    /** @test */
    public function user_cannot_access_admin_cuisines(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get(route('admin.cuisine.create'))->assertRedirect(route('home'));
    }

    /** @test */
    public function can_get_create_page(): void
    {
        $this->actingAs(User::factory()->admin()->create());

        $this->get(route('admin.cuisine.create'))->assertOk();
    }

    /** @test */
    public function can_get_index_page(): void
    {
        $this->actingAs(User::factory()->admin()->create());

        $this->get(route('admin.cuisine.index'))->assertOk();
    }

    /** @test */
    public function can_create_cuisine(): void
    {
        $this->actingAs(User::factory()->admin()->create());
        $this->assertNull(Cuisine::first(), 'Database not cleared from previous run');

        $payload = [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
        ];

        $this->put(route('admin.cuisine.store'), $payload)
            ->assertRedirect(route('admin.cuisine.index'))
            ->assertSessionHas('success', "created cuisine: {$payload['name']}");

        $created = Cuisine::first();

        $this->assertNotNull($created);
        $this->assertEquals($payload['name'], $created->name);
        $this->assertEquals($payload['description'], $created->description);
    }

    /** @test */
    public function shows_list_of_cuisines_on_index(): void
    {
        $this->actingAs(User::factory()->admin()->create());
        $cuisines = Cuisine::factory(5)->create();

        $response = $this->get(route('admin.cuisine.index'))
            ->assertOk();

        $cuisines->each(function (Cuisine $cuisine) use ($response): void {
            $response->assertSeeText($cuisine->name);
            $response->assertSeeText($cuisine->label);
        });
    }

    /** @test */
    public function can_delete_cuisine(): void
    {
        $this->actingAs(User::factory()->admin()->create());
        $cuisine = Cuisine::factory()->create();

        $this->delete(route('admin.cuisine.delete', $cuisine), ['confirm' => 'true'])
            ->assertRedirect(route('admin.cuisine.index'))
            ->assertSessionHas('success', "deleted cuisine: {$cuisine->name}");

        $this->assertNull(Cuisine::find($cuisine->id));
    }

    /** @test */
    public function can_update_cuisine(): void
    {
        $this->actingAs(User::factory()->admin()->create());
        $cuisine = Cuisine::factory()->create();

        $payload = [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
        ];

        $this->patch(route('admin.cuisine.update', $cuisine), $payload)
            ->assertRedirect(route('admin.cuisine.index'))
            ->assertSessionHas('success', "updated cuisine: {$payload['name']}");

        $updated = Cuisine::first();

        $this->assertNotNull($updated);
        $this->assertEquals($cuisine->id, $updated->id);
        $this->assertNotEquals($cuisine->name, $updated->name);
        $this->assertNotEquals($cuisine->description, $updated->description);
        $this->assertEquals($payload['name'], $updated->name);
        $this->assertEquals($payload['description'], $updated->description);
    }
}
