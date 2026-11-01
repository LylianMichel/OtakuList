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
        $filters = $this->filtersFromRequest($request);
        $oeuvres = $this->filteredQuery($filters)
            ->orderByDesc('note')
            ->orderBy('id')
            ->paginate(12)
            ->appends($this->paginationFilters($filters))
            ->fragment('bibliotheque');

        return response()
            ->view('oeuvres.index', [
                'oeuvres' => $oeuvres,
                'filters' => $filters,
            ])
            ->cookie('search', $filters['search'], self::SEARCH_COOKIE_MINUTES);
    }

    /**
     * @return array{search: string, type?: string|null, status?: string|null}
     */
    private function filtersFromRequest(Request $request): array
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:120'],
            'type' => ['nullable', 'in:anime,manga'],
            'status' => ['nullable', 'in:en_cours,termine,a_venir'],
        ]);

        if ($request->has('search')) {
            $search = $filters['search'] ?? '';
        } else {
            $search = $request->cookie('search', '');
        }

        $filters['search'] = trim((string) $search);

        return $filters;
    }

    /**
     * @param  array{search: string, type?: string|null, status?: string|null}  $filters
     * @return Builder<Oeuvre>
     */
    private function filteredQuery(array $filters): Builder
    {
        $query = Oeuvre::query();

        if ($filters['search'] !== '') {
            $query->where('titre', 'like', '%'.$filters['search'].'%');
        }

        if (! empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (! empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query;
    }

    /**
     * @param  array{search: string, type?: string|null, status?: string|null}  $filters
     * @return array<string, string>
     */
    private function paginationFilters(array $filters): array
    {
        $paginationFilters = [];

        foreach ($filters as $name => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            $paginationFilters[$name] = $value;
        }

        return $paginationFilters;
    }
}
