<?php

namespace Tests\Unit\Action;

use App\Actions\DeleteType;
use App\Models\Ingredient;
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
        $type = Type::factory()->create();
        $this->assertModelExists($type);

        $this->assertTrue($this->action()->execute($type));
        $this->assertModelMissing($type);
    }

    /** @test */
    public function it_creates_fallback_if_not_exist(): void
    {
        $this->assertNotNull(config('fallback.type.name'), 'fallback type not configured');
        $this->assertNull(Type::firstWhere('name', config('fallback.type.name')), 'fallback type already exists?');

        $type = Type::factory()->create();
        $this->action()->execute($type);

        $this->assertModelMissing($type);
        $this->assertNotNull(Type::firstWhere('name', config('fallback.type.name')));
    }

    /** @test */
    public function it_moves_ingredients_to_fallback_if_none_specified(): void
    {
        $type = Type::factory()->create();
        $ingredients = Ingredient::factory(5)->type($type)->create();
        $this->assertCount(5, $type->ingredients);
        $this->assertEquals($type->id, $ingredients->first()->type_id);

        $this->action()->execute($type);

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
