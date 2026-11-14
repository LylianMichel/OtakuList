<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Laravel\Fortify\Contracts\SuccessfulPasswordResetLinkRequestResponse as ResponseContract;

class SuccessfulPasswordResetLinkRequestResponse implements ResponseContract
{
    public function __construct(protected string $status) {}

    public function toResponse(mixed $request): JsonResponse|RedirectResponse
    {
        $message = __($this->status);

        return $request->wantsJson()
            ? new JsonResponse(['message' => $message])
            : to_route('login')->with('success', $message);
    }
}
