@extends('layouts.app')
@section('title', 'Les œuvres')
@section('content')
<section class="section" id="bibliotheque" aria-labelledby="featured-title">
  <div class="section-header"><div><div class="section-kicker">LE CATALOGUE OTAKULIST</div><h2 id="featured-title">Ta prochaine <em>histoire.</em></h2></div><span class="result-count">{{ $oeuvres->total() }} {{ $oeuvres->total() > 1 ? 'œuvres' : 'œuvre' }} à découvrir</span></div>
  <form class="catalogue-filters" action="{{ route('oeuvres.index') }}#bibliotheque" method="get" role="search" aria-label="Rechercher dans le catalogue">
    <div class="search-field"><label for="catalogue-search">Rechercher une œuvre</label><input id="catalogue-search" type="search" name="search" maxlength="120" value="{{ $filters['search'] ?? '' }}" placeholder="Naruto, Frieren…"></div>
    <div><label for="catalogue-type">Format</label><select id="catalogue-type" name="type"><option value="">Tous les formats</option><option value="anime" @selected(($filters['type'] ?? '') === 'anime')>Animés</option><option value="manga" @selected(($filters['type'] ?? '') === 'manga')>Mangas</option></select></div>
    <div><label for="catalogue-status">Statut</label><select id="catalogue-status" name="status"><option value="">Tous les statuts</option><option value="en_cours" @selected(($filters['status'] ?? '') === 'en_cours')>En cours</option><option value="termine" @selected(($filters['status'] ?? '') === 'termine')>Terminé</option><option value="a_venir" @selected(($filters['status'] ?? '') === 'a_venir')>À venir</option></select></div>
    <button class="button rose" type="submit">Rechercher ↗</button>
    <a class="reset-filters" href="{{ route('oeuvres.index', ['search' => '']) }}#bibliotheque">Réinitialiser</a>
  </form>
  @if($errors->any())<p class="filter-error" role="alert">Vérifie les filtres : choisis un format et un statut proposés, et un titre de 120 caractères maximum.</p>@endif
  <div class="catalogue-caption"><span>À REGARDER · À FEUILLETER · À DÉCOUVRIR</span><span>Les mieux notées en premier</span></div>
  <x-oeuvre-grid :oeuvres="$oeuvres" />
  @if($oeuvres->hasPages())
    <nav class="catalogue-pagination" aria-label="Pages du catalogue">
      @if($oeuvres->previousPageUrl())<a class="button cream" href="{{ $oeuvres->previousPageUrl() }}">← Précédent</a>@endif
      <span>Page {{ $oeuvres->currentPage() }} sur {{ $oeuvres->lastPage() }}</span>
      @if($oeuvres->nextPageUrl())<a class="button cream" href="{{ $oeuvres->nextPageUrl() }}">Suivant →</a>@endif
    </nav>
  @endif
</section>
@endsection
