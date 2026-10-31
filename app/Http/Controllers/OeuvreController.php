<?php

namespace App\Http\Controllers;

use App\Models\Oeuvre;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OeuvreController extends Controller
{
    private const SEARCH_COOKIE_MINUTES = 60;

    public function index(Request $request): Response
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:120'],
            'type' => ['nullable', 'in:anime,manga'],
            'status' => ['nullable', 'in:en_cours,termine,a_venir'],
        ]);

        $search = trim((string) ($request->has('search')
            ? ($filters['search'] ?? '')
            : $request->cookie('search', '')));
        $filters['search'] = $search;

        $oeuvres = Oeuvre::query()
            ->when($search !== '', fn (Builder $query): Builder => $query->where('titre', 'like', '%'.$search.'%'))
            ->when($filters['type'] ?? null, fn (Builder $query, string $type): Builder => $query->where('type', $type))
            ->when($filters['status'] ?? null, fn (Builder $query, string $status): Builder => $query->where('status', $status))
            ->orderByDesc('note')
            ->orderBy('id')
            ->paginate(12)
            ->appends(array_filter($filters, fn (?string $value): bool => $value !== null && $value !== ''))
            ->fragment('bibliotheque');

        return response()
            ->view('oeuvres.index', [
                'oeuvres' => $oeuvres,
                'filters' => $filters,
            ])
            ->cookie('search', $search, self::SEARCH_COOKIE_MINUTES);
    }
}
