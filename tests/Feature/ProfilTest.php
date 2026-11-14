<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfilTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_access_or_update_a_profile(): void
    {
        $this->get('/profil')->assertRedirectToRoute('login');
        $this->get('/profil/edit')->assertRedirectToRoute('login');
        $this->put('/profil', [])->assertRedirectToRoute('login');
    }

    public function test_user_can_view_and_edit_their_profile(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/profil')->assertOk()->assertSee($user->name)->assertSee($user->email);
        $this->get('/profil/edit')->assertOk()->assertSee('name="nom"', false)->assertSee('name="prenom"', false);
    }

    public function test_profile_update_only_changes_the_authenticated_user(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $this->actingAs($user)->put('/profil', [
            'nom' => 'martin',
            'prenom' => 'emma',
            'email' => 'emma@example.test',
            'id' => $otherUser->id,
            'password' => 'unwanted-change',
        ])->assertRedirectToRoute('profil.show')->assertSessionHas('success');

        $this->assertSame('Emma Martin', $user->fresh()->name);
        $this->assertSame('martin', $user->fresh()->nom);
        $this->assertSame('emma', $user->fresh()->prenom);
        $this->assertSame('emma@example.test', $user->fresh()->email);
        $this->assertSame($user->password, $user->fresh()->password);
        $this->assertSame($otherUser->email, $otherUser->fresh()->email);
    }

    public function test_user_can_keep_their_email_and_cannot_take_another_users_email(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $payload = ['nom' => 'Martin', 'prenom' => 'Emma', 'email' => $user->email];

        $this->actingAs($user)->put('/profil', $payload)->assertSessionHasNoErrors();

        $payload['email'] = $otherUser->email;
        $this->from('/profil/edit')->put('/profil', $payload)
            ->assertRedirect('/profil/edit')
            ->assertSessionHasErrors(['email' => 'Cette adresse e-mail est déjà utilisée.'], null, 'updateProfileInformation');

        $this->assertSame($user->email, $user->fresh()->email);
    }

    public function test_invalid_profile_keeps_the_saved_values_and_displays_french_errors(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->followingRedirects()->from('/profil/edit')->put('/profil', [
            'email' => 'invalid',
        ])->assertOk()->assertSee('Le nom est requis.')->assertSee('Le prénom est requis.')
            ->assertSee('alert-error');

        $this->assertSame($user->name, $user->fresh()->name);
        $this->assertSame($user->email, $user->fresh()->email);
    }

    public function test_navigation_changes_when_user_logs_in(): void
    {
        $this->get('/')->assertOk()->assertSee('Connexion')->assertSee('Inscription')->assertDontSee('Déconnexion');

        $user = User::factory()->create();
        $this->actingAs($user)->get('/')->assertOk()->assertSee('Mon profil')->assertSee('Déconnexion')
            ->assertDontSee('>Connexion<', false)->assertDontSee('>Inscription<', false);
    }

    public function test_user_can_log_in_after_updating_their_email_with_uppercase_letters(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->put('/profil', [
            'nom' => 'Martin', 'prenom' => 'Emma', 'email' => 'Emma@Example.test',
        ])->assertSessionHasNoErrors();
        $this->assertSame('emma@example.test', $user->fresh()->email);

        $this->post('/logout')->assertRedirect('/');
        $this->post('/login', ['email' => 'Emma@Example.test', 'password' => 'password'])
            ->assertRedirectToRoute('home')->assertSessionHasNoErrors();

        $this->assertAuthenticatedAs($user);
    }
}
