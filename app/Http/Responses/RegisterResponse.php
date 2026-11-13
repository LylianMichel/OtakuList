<?php

namespace App\Http\Responses;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    /**
     * Fortify connecte automatiquement les nouveaux inscrits ; le TP demande une connexion manuelle.
     *
     * @param  Request  $request
     */
    public function toResponse($request): RedirectResponse
    {
        Auth::guard(config('fortify.guard'))->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login')->with('status', 'Ton compte est créé. Tu peux maintenant te connecter.');
    }
}
