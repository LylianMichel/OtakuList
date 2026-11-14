<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, ProfileValidationRules;

    public function create(array $input): User
    {
        $validated = Validator::make($input, [
            ...$this->profileRules(),
            'password' => $this->passwordRules(),
        ], [
            ...$this->profileMessages(),
            'password.required' => 'Veuillez indiquer un mot de passe.',
            'password.string' => 'Le mot de passe doit être une chaîne de caractères.',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ])->validate();

        return User::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'name' => Str::title(Str::lower($validated['prenom'].' '.$validated['nom'])),
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
    }
}
