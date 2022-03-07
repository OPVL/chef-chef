<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MiddlewareTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    /** @test */
    public function non_admin_user_cannot_access_admin_recipes(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get(route('admin.index'))->assertRedirect(route('home'));
    }

    /** @test */
    public function admin_user_can_access_admin(): void
    {
        $this->actingAs(User::factory()->admin()->create());

        $this->get(route('admin.index'))->assertOk();
    }
}
