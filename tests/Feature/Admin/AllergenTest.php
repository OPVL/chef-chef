<?php

namespace Tests\Feature\Admin;

use App\Models\Allergen;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AllergenTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_get_index(): void
    {
        $this->actingAs(User::factory()->admin()->create());
        $allergens = Allergen::factory(5)->create();

        $response = $this->get(route('admin.allergen.index'))
            ->assertOk();

        $allergens->each(function (Allergen $allergen) use ($response): void {
            $response->assertSeeText($allergen->name);
        });
    }
}
