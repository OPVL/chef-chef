<?php

namespace Tests\Unit\Action;

use App\Actions\CreateRecipe;
use App\Actions\DeleteType;
use App\Actions\SortIngredientsByType;
use App\Models\Cuisine;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Type;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteTypeTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    /** @test */
    public function can_delete_type(): void
    {
        $location = Type::factory()->create();
        $this->assertModelExists($location);

        $this->assertTrue($this->action()->execute($location));
        $this->assertModelMissing($location);
    }

    /** @test */
    public function it_creates_fallback_if_not_exist(): void
    {
        $this->assertNotNull(config('fallback.type.name'), 'fallback location not configured');
        $this->assertNull(Type::firstWhere('name', config('fallback.type.name')), 'fallback location already exists?');

        $location = Type::factory()->create();
        $this->action()->execute($location);

        $this->assertModelMissing($location);
        $this->assertNotNull(Type::firstWhere('name', config('fallback.type.name')));
    }

    /** @test */
    public function it_moves_ingredients_to_fallback_if_none_specified(): void
    {
        $location = Type::factory()->create();
        $ingredients = Ingredient::factory(5)->location($location)->create();
        $this->assertCount(5, $location->ingredients);
        $this->assertEquals($location->id, $ingredients->first()->type_id);

        $this->action()->execute($location);

        $fallback = Type::firstWhere('name', config('fallback.type.name'));

        $ingredients->each(function (Ingredient $ingredient) use ($fallback): void {
            $this->assertEquals($fallback->id, $ingredient->fresh()->type_id);
        });
    }

    protected function action(): DeleteType
    {
        return app(DeleteType::class);
    }
}
