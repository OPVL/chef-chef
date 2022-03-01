<?php

namespace Tests\Unit\Action;

use App\Actions\CreateRecipe;
use App\Actions\DeleteStorageLocation;
use App\Actions\SortIngredientsByLocation;
use App\Models\Cuisine;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\StorageLocation;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteStorageLocationTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    /** @test */
    public function can_delete_storage_location(): void
    {
        $location = StorageLocation::factory()->create();
        $this->assertModelExists($location);

        $this->assertTrue($this->action()->execute($location));
        $this->assertModelMissing($location);
    }

    /** @test */
    public function it_creates_fallback_if_not_exist(): void
    {
        $this->assertNotNull(config('fallback.storage-location.name'), 'fallback location not configured');
        $this->assertNull(StorageLocation::firstWhere('name', config('fallback.storage-location.name')), 'fallback location already exists?');

        $location = StorageLocation::factory()->create();
        $this->action()->execute($location);

        $this->assertModelMissing($location);
        $this->assertNotNull(StorageLocation::firstWhere('name', config('fallback.storage-location.name')));
    }

    /** @test */
    public function it_moves_ingredients_to_fallback_if_none_specified(): void
    {
        $location = StorageLocation::factory()->create();
        $ingredients = Ingredient::factory(5)->location($location)->create();
        $this->assertCount(5, $location->ingredients);
        $this->assertEquals($location->id, $ingredients->first()->storage_location_id);

        $this->action()->execute($location);

        $fallback = StorageLocation::firstWhere('name', config('fallback.storage-location.name'));

        $ingredients->each(function (Ingredient $ingredient) use ($fallback): void {
            $this->assertEquals($fallback->id, $ingredient->fresh()->storage_location_id);
        });
    }

    protected function action(): DeleteStorageLocation
    {
        return app(DeleteStorageLocation::class);
    }
}
