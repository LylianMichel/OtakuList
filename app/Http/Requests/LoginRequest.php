<?php

namespace App\Http\Requests;

use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;

class LoginRequest extends FortifyLoginRequest {
    /**
     * @return array<string, string>
     */
    public function messages(): array {
        return [
            Fortify::username().'.required' => 'Veuillez indiquer votre adresse e-mail.',
            'password.required' => 'Veuillez indiquer votre mot de passe.',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array {
        return [
            Fortify::username() => 'adresse e-mail',
            'password' => 'mot de passe',
        ];
    }
}
