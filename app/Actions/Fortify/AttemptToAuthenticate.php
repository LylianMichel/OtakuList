<?php
// fichier app/Actions/Fortify/AttemptToAuthenticate.php
namespace App\Actions\Fortify;

use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Actions\AttemptToAuthenticate as FortifyAttemptToAuthenticate;
use Laravel\Fortify\Fortify;

class AttemptToAuthenticate extends FortifyAttemptToAuthenticate {
    /**
     * @throws ValidationException
     */
    protected function throwFailedAuthenticationException($request) {
        $this->limiter->increment($request);

        throw ValidationException::withMessages([
            Fortify::username() => ['Ces identifiants ne correspondent pas à nos enregistrements.'],
        ]);
    }
}
