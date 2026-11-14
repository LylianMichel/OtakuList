<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Laravel\Fortify\Http\Responses\LoginResponse as FortifyLoginResponse;

class LoginResponse extends FortifyLoginResponse
{
    public function toResponse(mixed $request): JsonResponse|RedirectResponse
    {
        if (! $request->wantsJson()) {
            $request->session()->flash('success', 'Tu es maintenant connecté.');
        }

        return parent::toResponse($request);
    }
}
