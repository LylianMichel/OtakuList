<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    use ProfileValidationRules;

    public function update(User $user, array $input): void
    {
        if (config('fortify.lowercase_usernames') && is_string($input['email'] ?? null)) {
            $input['email'] = Str::lower($input['email']);
        }

        $validated = Validator::make(
            $input,
            $this->profileRules($user),
            $this->profileMessages(),
        )->validateWithBag('updateProfileInformation');

        if ($validated['email'] !== $user->email) {
            $user->email_verified_at = null;
        }

        $user->fill([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'name' => Str::title(Str::lower($validated['prenom'].' '.$validated['nom'])),
            'email' => $validated['email'],
        ])->save();
    }
}
