<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function show(Request $request): View
    {
        return view('profil.show', ['user' => $request->user()]);
    }

    public function edit(Request $request): View
    {
        return view('profil.edit', ['user' => $request->user()]);
    }

    public function update(Request $request, UpdateUserProfileInformation $updateProfile): RedirectResponse
    {
        $updateProfile->update($request->user(), $request->only('nom', 'prenom', 'email'));

        return to_route('profil.show')->with('success', 'Ton profil a été mis à jour.');
    }
}
