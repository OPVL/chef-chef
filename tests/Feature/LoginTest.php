<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_login_with_valid_user(): void
    {
        $user = User::factory()->create(['password' => 'blowfish']);

        // Auth::shouldReceive('attempt')->andReturn(true);

        $this->put(route('login.store'), [
            'email' => $user->email,
            'password' => 'blowfish',
        ])->assertRedirect(route('home'));
    }

    /** @test */
    public function can_logout_by_csrf(): void
    {
        $user = User::factory()->create(['password' => 'blowfish']);
        // Auth::shouldReceive('attempt')->andReturn(true);

        $this->actingAs($user)->delete(route('login.delete'))
            ->assertRedirect(route('home'));
    }

    /** @test */
    public function can_get_login_page(): void
    {
        $this->get(route('login'))->assertOk();
    }

    // /** @test */
    // public function cannot_login_with_wrong_email()
    // {
    //     $user = User::factory()->create(['password' => 'blowfish']);

    //     $this->put(route('login.store'), [
    //         'email' => $user->email,
    //         'password' => 'blowfish',
    //     ])->assertRedirect(route('home'));
    // }

    // /** @test */
    // public function cannot_login_with_wrong_password()
    // {
    //     $user = User::factory()->create(['password' => 'blowfish']);

    //     $this->put(route('login.store'), [
    //         'email' => $user->email,
    //         'password' => 'blowfish',
    //     ])->assertRedirect(route('home'));
    // }
}
