<?php

namespace Tests\Feature\Admin;

use App\Models\Type;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TypeTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    /** @test */
    public function user_cannot_access_admin_types(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get(route('admin.type.create'))->assertRedirect(route('home'));
    }

    /** @test */
    public function can_get_create_page(): void
    {
        $this->actingAs(User::factory()->admin()->create());

        $this->get(route('admin.type.create'))->assertOk();
    }

    /** @test */
    public function can_get_index_page(): void
    {
        $this->actingAs(User::factory()->admin()->create());

        $this->get(route('admin.type.index'))->assertOk();
    }

    /** @test */
    public function can_create_type(): void
    {
        $this->actingAs(User::factory()->admin()->create());
        $this->assertNull(Type::first(), 'Database not cleared from previous run');

        $payload = [
            'name' => 'teaspoon',
        ];

        $this->put(route('admin.type.store'), $payload)
            ->assertRedirect(route('admin.type.index'))
            ->assertSessionHas('success', "created type: {$payload['name']}");

        $created = Type::first();

        $this->assertNotNull($created);
        $this->assertEquals($payload['name'], $created->name);
    }

    /** @test */
    public function shows_list_of_types_on_index(): void
    {
        $this->actingAs(User::factory()->admin()->create());
        $types = Type::factory(5)->create();

        $response = $this->get(route('admin.type.index'))
            ->assertOk();

        $types->each(function (Type $type) use ($response): void {
            $response->assertSeeText($type->name);
            $response->assertSeeText($type->label);
        });
    }

    /** @test */
    public function can_delete_type(): void
    {
        $this->actingAs(User::factory()->admin()->create());
        $type = Type::factory()->create();

        $this->delete(route('admin.type.delete', $type), ['confirm' => 'true'])
            ->assertRedirect(route('admin.type.index'))
            ->assertSessionHas('success', "deleted type: {$type->name}");

        $this->assertNull(Type::find($type->id));
    }

    /** @test */
    public function can_update_type(): void
    {
        $this->actingAs(User::factory()->admin()->create());
        $type = Type::factory()->create();

        $payload = [
            'name' => $this->faker->name(),
        ];

        $this->patch(route('admin.type.update', $type), $payload)
            ->assertRedirect(route('admin.type.index'))
            ->assertSessionHas('success', "updated type: {$payload['name']}");

        $updated = Type::first();

        $this->assertNotNull($updated);
        $this->assertEquals($type->id, $updated->id);
        $this->assertNotEquals($type->name, $updated->name);
        $this->assertEquals($payload['name'], $updated->name);
    }
}
