<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class ContactTest extends TestCase
{
    public function test_contact_displays_the_form_and_four_alert_types(): void
    {
        $this->get(route('contact'))->assertOk()
            ->assertSee('name="message"', false)
            ->assertSee('name="_token"', false)
            ->assertSee('alert-success')->assertSee('alert-error')
            ->assertSee('alert-warning')->assertSee('alert-info');
    }

    public function test_valid_message_displays_a_demo_confirmation(): void
    {
        $this->post(route('contact.store'), [
            'name' => 'Lylian',
            'email' => 'lylian@example.test',
            'subject' => 'Une idée',
            'message' => 'Ajouter mon manga préféré.',
        ])->assertRedirectToRoute('contact')->assertSessionHasNoErrors()
            ->assertSessionHas('status', 'Ton message est valide. Démonstration uniquement : aucun e-mail envoyé.');
    }

    public function test_empty_form_displays_validation_errors_in_the_layout(): void
    {
        $this->followingRedirects()->from(route('contact'))->post(route('contact.store'), [])->assertOk()
            ->assertSee('Le formulaire contient des erreurs.')
            ->assertSee('Le champ nom est obligatoire.');
    }

    #[TestWith(['email', 'invalid', 'Indique une adresse e-mail valide.'])]
    #[TestWith(['name', 101, 'Le champ nom ne doit pas dépasser 100 caractères.'])]
    #[TestWith(['email', 256, 'Le champ adresse e-mail ne doit pas dépasser 255 caractères.'])]
    #[TestWith(['subject', 151, 'Le champ sujet ne doit pas dépasser 150 caractères.'])]
    #[TestWith(['message', 3001, 'Le champ message ne doit pas dépasser 3000 caractères.'])]
    public function test_invalid_contact_fields_are_rejected(string $field, string|int $value, string $error): void
    {
        $payload = [
            'name' => 'Lylian',
            'email' => 'lylian@example.test',
            'subject' => 'Une idée',
            'message' => 'Mon message',
        ];
        $payload[$field] = is_int($value) ? str_repeat('a', $value) : $value;

        $this->from(route('contact'))->post(route('contact.store'), $payload)
            ->assertRedirectToRoute('contact')->assertSessionHasErrors([$field => $error]);
    }
}
