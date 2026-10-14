<?php

namespace App\Http\Controllers;
use App\Models\Oeuvre;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\Response;

class OeuvreController extends Controller
{
    private const SEARCH_COOKIE_MINUTES = 60;
    public function index(Request $request): Response
    {
        $search = $request->has('search')
            ? ($request->query('search') ?: null)
            : $request->cookie('search');

        $oeuvres = Oeuvre::query()
            ->when($search, function ($query, $search) {
                return $query->where('titre', 'like', '%' . $search . '%');
            })
            ->get();

        return response()
            ->view('oeuvres.index', [
                'oeuvres' => $oeuvres,
                'search' => $search,
            ])
            ->cookie('search', (string) $search, self::SEARCH_COOKIE_MINUTES);
    }

}
