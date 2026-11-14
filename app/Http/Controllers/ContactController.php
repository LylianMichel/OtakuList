<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:3000'],
        ], [
            'email.email' => 'Indique une adresse e-mail valide.',
        ]);

        return to_route('contact')->with('status', 'Ton message est valide. Démonstration uniquement : aucun e-mail envoyé.');
    }
}
