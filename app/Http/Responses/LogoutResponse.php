<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Laravel\Fortify\Http\Responses\LogoutResponse as FortifyLogoutResponse;

class LogoutResponse extends FortifyLogoutResponse
{
    public function toResponse(mixed $request): JsonResponse|RedirectResponse
    {
        if (! $request->wantsJson()) {
            $request->session()->flash('success', 'Tu es maintenant déconnecté.');
        }

        return parent::toResponse($request);
    }
}
