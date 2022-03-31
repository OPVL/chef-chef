<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    /** @test */
    public function can_register()
    {
        $this->put(route('register.store'), [
            'name' => $this->faker->name,
            'email' => $this->faker->email(),
            'password' => 'blowfish',
        ])->assertRedirect(route('home'));
    }

    /** @test */
    public function can_get_register_page()
    {
        $this->get(route('register'))->assertOk();
    }

    /** @test */
    public function cannot_register_used_email()
    {
        $existing = User::factory()->create();

        $password = $this->faker->password(8);
        $this->put(route('register.store'), [
            'name' => $this->faker->name,
            'email' => $existing->email,
            'password' => $password,
            'repeat_password' => $password,
        ])->assertSessionHasErrors('email');
    }

    /** @test */
    public function cannot_register_malformed_email()
    {
        $password = $this->faker->password(8);
        $this->put(route('register.store'), [
            'name' => $this->faker->name,
            'email' => explode('@', $this->faker->email())[0],
            'password' => $password,
            'repeat_password' => $password,
        ])->assertSessionHasErrors('email');
    }

    /** @test */
    public function cannot_register_short_password()
    {
        $password = $this->faker->password(4);
        $this->put(route('register.store'), [
            'name' => $this->faker->name,
            'email' => $this->faker->email(),
            'password' => $password,
            'repeat_password' => $password,
        ])->assertSessionHasErrors('password');
    }

    /** @test */
    public function cannot_register_password_doesnt_match()
    {
        $password = $this->faker->password(8);
        $this->put(route('register.store'), [
            'name' => $this->faker->name,
            'email' => $this->faker->email(),
            'password' => $password,
            'repeat_password' => 'not-matching',
        ])->assertSessionHasErrors('repeat_password');
    }

    /** @test */
    public function cannot_register_no_name()
    {
        $password = $this->faker->password(8);
        $this->put(route('register.store'), [
            'email' => $this->faker->email(),
            'password' => $password,
            'repeat_password' => 'not-matching',
        ])->assertSessionHasErrors('name');
    }

    /** @test */
    public function cannot_register_empty_name()
    {
        $password = $this->faker->password(8);
        $this->put(route('register.store'), [
            'name' => '',
            'email' => $this->faker->email(),
            'password' => $password,
            'repeat_password' => 'not-matching',
        ])->assertSessionHasErrors('name');
    }
}
