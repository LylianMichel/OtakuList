<?php

namespace App\Http\Controllers;

use App\Models\Oeuvre;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogueController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:120'],
            'type' => ['nullable', 'in:anime,manga'],
            'status' => ['nullable', 'in:en_cours,termine,a_venir'],
        ]);
        $query = Oeuvre::query();
        if ($search = trim($filters['q'] ?? '')) {
            $query->where('titre', 'like', '%'.$search.'%');
        }
        foreach (['type', 'status'] as $field) {
            if (! empty($filters[$field])) {
                $query->where($field, $filters[$field]);
            }
        }

        return view('pages.home', [
            'oeuvres' => $query->orderByDesc('note')->orderBy('id')->paginate(12)->withQueryString()->fragment('bibliotheque'),
            'filters' => $filters,
        ]);
    }
}
