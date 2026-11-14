<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Support\Facades\Event;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class AuthenticationTpTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_and_login_display_french_validation_errors(): void
    {
        $this->followingRedirects()->from('/register')->post('/register', [])
            ->assertOk()->assertSee('Le nom est requis.')->assertSee('Le prénom est requis.')
            ->assertSee('Veuillez indiquer une adresse e-mail.')->assertSee('alert-error');

        $this->followingRedirects()->from('/login')->post('/login', [])->assertOk()
            ->assertSee('Veuillez indiquer votre adresse e-mail.')->assertSee('Veuillez indiquer votre mot de passe.');
    }

    #[TestWith(['nom', ['invalid'], 'Le nom doit être une chaîne de caractères.'])]
    #[TestWith(['prenom', ['invalid'], 'Le prénom doit être une chaîne de caractères.'])]
    #[TestWith(['nom', 256, 'Le nom ne doit pas dépasser 255 caractères.'])]
    #[TestWith(['prenom', 256, 'Le prénom ne doit pas dépasser 255 caractères.'])]
    #[TestWith(['email', 'invalid', "L'adresse e-mail n'est pas valide."])]
    #[TestWith(['password_confirmation', 'different', 'La confirmation du mot de passe ne correspond pas.'])]
    public function test_registration_rejects_invalid_fields(string $field, array|string|int $value, string $message): void
    {
        $payload = [
            'nom' => 'Dupont', 'prenom' => 'Lylian', 'email' => 'lylian@example.test',
            'password' => 'password123', 'password_confirmation' => 'password123',
        ];
        $payload[$field] = is_int($value) ? str_repeat('a', $value) : $value;
        $errorField = $field === 'password_confirmation' ? 'password' : $field;

        $this->post('/register', $payload)->assertSessionHasErrors([$errorField => $message]);

        $this->assertDatabaseCount('users', 0);
    }

    public function test_wrong_login_displays_the_custom_message(): void
    {
        $user = User::factory()->create();

        $this->followingRedirects()->from('/login')->post('/login', [
            'email' => $user->email, 'password' => 'wrong-password',
        ])->assertOk()->assertSee('Ces identifiants ne correspondent pas à nos enregistrements.');

        $this->assertGuest();
    }

    public function test_reset_email_has_french_content_and_a_working_link(): void
    {
        $user = User::factory()->create(['name' => 'Emma Martin', 'email' => 'mailpit-check@example.test']);
        Event::fake([NotificationSent::class]);

        $this->post('/forgot-password', ['email' => $user->email])
            ->assertRedirectToRoute('login')->assertSessionHas('success');

        Event::assertDispatched(NotificationSent::class, function (NotificationSent $event) use ($user): bool {
            $notification = $event->notification;
            $this->assertInstanceOf(ResetPassword::class, $notification);
            $this->assertSame($user->id, $event->notifiable->id);
            $mail = $notification->toMail($user);
            $this->assertSame('Réinitialisation de votre mot de passe', $mail->subject);
            $this->assertSame('Bonjour Emma Martin,', $mail->greeting);
            $this->assertSame('Réinitialiser le mot de passe', $mail->actionText);
            $this->assertStringContainsString('aucune action', implode(' ', $mail->outroLines));
            $this->get($mail->actionUrl)->assertOk()->assertSee($notification->token);
            $this->post('/reset-password', [
                'token' => $notification->token,
                'email' => $user->email,
                'password' => 'new-password123',
                'password_confirmation' => 'new-password123',
            ])->assertRedirectToRoute('login')->assertSessionHasNoErrors();

            return true;
        });
    }
}
