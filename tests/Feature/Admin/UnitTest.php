<?php

namespace Tests\Feature\Admin;

use App\Models\Unit;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UnitTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    /** @test */
    public function user_cannot_access_admin_units(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get(route('admin.unit.create'))->assertRedirect(route('home'));
    }

    /** @test */
    public function can_get_create_page(): void
    {
        $this->actingAs(User::factory()->admin()->create());

        $this->get(route('admin.unit.create'))->assertOk();
    }

    /** @test */
    public function can_get_index_page(): void
    {
        $this->actingAs(User::factory()->admin()->create());

        $this->get(route('admin.unit.index'))->assertOk();
    }

    /** @test */
    public function can_create_unit(): void
    {
        $this->actingAs(User::factory()->admin()->create());
        $this->assertNull(Unit::first(), 'Database not cleared from previous run');

        $payload = [
            'name' => 'teaspoon',
            'label' => 'tsp',
        ];

        $this->put(route('admin.unit.store'), $payload)
            ->assertRedirect(route('admin.unit.index'))
            ->assertSessionHas('success', "created unit: {$payload['name']}");

        $created = Unit::first();

        $this->assertNotNull($created);
        $this->assertEquals($payload['name'], $created->name);
        $this->assertEquals($payload['label'], $created->label);
    }

    /** @test */
    public function shows_list_of_units_on_index(): void
    {
        $this->actingAs(User::factory()->admin()->create());
        $units = Unit::factory(5)->create();

        $response = $this->get(route('admin.unit.index'))
            ->assertOk();

        $units->each(function (Unit $unit) use ($response): void {
            $response->assertSeeText($unit->name);
            $response->assertSeeText($unit->label);
        });
    }

    /** @test */
    public function can_delete_unit(): void
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::factory()->admin()->create());
        $unit = Unit::factory()->create();

        $this->delete(route('admin.unit.delete', $unit), ['confirm' => 'true'])
            ->assertRedirect(route('admin.unit.index'))
            ->assertSessionHas('success', "deleted unit: {$unit->name}");

        $this->assertNull(Unit::find($unit->id));
    }
}
