<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Validation\Rule;

trait ProfileValidationRules
{
    protected function profileRules(?User $user = null): array
    {
        return [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($user?->id)],
        ];
    }

    protected function profileMessages(): array
    {
        return [
            'nom.required' => 'Le nom est requis.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'prenom.required' => 'Le prénom est requis.',
            'prenom.string' => 'Le prénom doit être une chaîne de caractères.',
            'prenom.max' => 'Le prénom ne doit pas dépasser 255 caractères.',
            'email.required' => 'Veuillez indiquer une adresse e-mail.',
            'email.string' => "L'adresse e-mail doit être une chaîne de caractères.",
            'email.email' => "L'adresse e-mail n'est pas valide.",
            'email.max' => "L'adresse e-mail ne doit pas dépasser 255 caractères.",
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
        ];
    }
}
