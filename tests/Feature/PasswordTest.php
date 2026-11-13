<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class PasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_password_recovery_views_are_available(): void
    {
        $this->get(route('password.request'))->assertOk()->assertSee('Adresse e-mail');
        $this->get(route('password.reset', ['token' => 'test-token', 'email' => 'test@example.test']))
            ->assertOk()->assertSee('test-token')->assertSee('test@example.test');
    }

    public function test_password_reset_link_is_sent(): void
    {
        $user = User::factory()->create();
        Notification::fake();

        $this->from(route('password.request'))->post(route('password.email'), ['email' => $user->email])
            ->assertRedirectToRoute('password.request')->assertSessionHasNoErrors()->assertSessionHas('status');

        Notification::assertSentTo($user, ResetPassword::class);
    }

    public function test_valid_reset_token_changes_the_password(): void
    {
        $user = User::factory()->create();
        $token = Password::createToken($user);

        $this->post(route('password.update'), [
            'token' => $token,
            'email' => $user->email,
            'password' => 'new-password123',
            'password_confirmation' => 'new-password123',
        ])->assertRedirectToRoute('login')->assertSessionHasNoErrors();

        $this->assertTrue(Hash::check('new-password123', $user->fresh()->password));
        $this->assertDatabaseMissing('password_reset_tokens', ['email' => $user->email]);
    }

    public function test_invalid_reset_token_does_not_change_the_password(): void
    {
        $user = User::factory()->create();

        $this->post(route('password.update'), [
            'token' => 'invalid',
            'email' => $user->email,
            'password' => 'new-password123',
            'password_confirmation' => 'new-password123',
        ])->assertSessionHasErrors('email');

        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }

    public function test_guests_cannot_access_or_submit_password_changes(): void
    {
        $this->get(route('password.edit'))->assertRedirectToRoute('login');
        $this->put(route('user-password.update'), [])->assertRedirectToRoute('login');
    }

    public function test_authenticated_user_can_change_their_password(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user)->get(route('password.edit'))->assertOk()->assertSee('Mot de passe actuel');

        $this->from(route('password.edit'))->put(route('user-password.update'), [
            'current_password' => 'password',
            'password' => 'new-password123',
            'password_confirmation' => 'new-password123',
        ])->assertRedirectToRoute('password.edit')->assertSessionHasNoErrors()
            ->assertSessionHas('status', 'password-updated');

        $this->assertTrue(Hash::check('new-password123', $user->fresh()->password));
    }

    public function test_wrong_current_password_is_rejected_and_displayed(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->followingRedirects()->from(route('password.edit'))->put(route('user-password.update'), [
            'current_password' => 'incorrect',
            'password' => 'new-password123',
            'password_confirmation' => 'new-password123',
        ])->assertOk()->assertSee('alert-error');

        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }
}
