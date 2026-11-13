<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    #[TestWith(['login'])]
    #[TestWith(['register'])]
    public function test_guests_can_access_authentication_forms(string $route): void
    {
        $this->get(route($route))->assertOk()->assertSee('name="_token"', false);
    }

    public function test_registration_creates_a_user_and_redirects_to_login_as_a_guest(): void
    {
        $this->post(route('register'), [
            'name' => 'Lylian',
            'email' => 'lylian@example.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ])->assertRedirectToRoute('login')->assertSessionHasNoErrors()->assertSessionHas('status');

        $this->assertGuest();
        $user = User::where('email', 'lylian@example.test')->firstOrFail();
        $this->assertSame('Lylian', $user->name);
        $this->assertTrue(Hash::check('password123', $user->password));
    }

    public function test_registration_rejects_missing_fields(): void
    {
        $this->from(route('register'))->post(route('register'), [])
            ->assertRedirectToRoute('register')->assertSessionHasErrors(['name', 'email', 'password']);

        $this->assertDatabaseCount('users', 0);
    }

    public function test_registration_rejects_duplicate_email_and_unconfirmed_password(): void
    {
        $user = User::factory()->create();

        $this->post(route('register'), [
            'name' => 'Lylian',
            'email' => $user->email,
            'password' => 'short',
            'password_confirmation' => 'different',
        ])->assertSessionHasErrors(['email', 'password']);

        $this->assertDatabaseCount('users', 1);
        $this->assertGuest();
    }

    public function test_login_redirects_to_home_and_remember_me_is_supported(): void
    {
        $user = User::factory()->create();

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
            'remember' => '1',
        ])->assertRedirectToRoute('home')->assertSessionHasNoErrors();

        $this->assertAuthenticatedAs($user);
        $this->assertNotNull($user->fresh()->remember_token);
    }

    public function test_invalid_credentials_remain_on_login_and_display_an_alert(): void
    {
        $user = User::factory()->create();

        $this->followingRedirects()->from(route('login'))->post(route('login'), [
            'email' => $user->email,
            'password' => 'incorrect',
        ])->assertOk()->assertSee('alert-error');

        $this->assertGuest();
    }

    public function test_logout_ends_the_session(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('logout'))->assertRedirect('/');

        $this->assertGuest();
    }
}
