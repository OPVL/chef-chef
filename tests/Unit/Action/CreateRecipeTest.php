<?php

namespace Tests\Unit\Action;

use App\Actions\CreateRecipe;
use App\Models\Cuisine;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateRecipeTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    /** @test */
    public function can_create_recipe(): void
    {
        $cuisine = Cuisine::factory()->create();
        $name = $this->faker->word();
        $description = $this->faker->sentences(3, true);

        $recipe = $this->action()->execute([
            'name' => $name,
            'description' => $description,
            'cuisine_id' => $cuisine->id,
        ]);

        $this->assertModelExists($recipe);
        $this->assertEquals($name, $recipe->name);
        $this->assertEquals($description, $recipe->description);
        $this->assertEquals($cuisine->id, $recipe->cuisine_id);
    }

    protected function action(): CreateRecipe
    {
        return app(CreateRecipe::class);
    }
}
