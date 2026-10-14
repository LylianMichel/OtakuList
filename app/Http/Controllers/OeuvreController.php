<?php

namespace App\Http\Controllers;

class OeuvreController
{
    public function index(Request $request): View {
        $categorie = $request->query('categorie');

        $taches = Tache::query()
            ->ofCategorie($categorie)
            ->latest('expiration')
            ->get();

        $categories = Tache::query()->distinct()->orderBy('categorie')->pluck('categorie');

        return view('taches.index', [
            'taches' => $taches,
            'categories' => $categories,
            'categorieSelectionnee' => $categorie,
        ]);
    }

}
