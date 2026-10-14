@extends('layouts.app')
@section('title', 'Accueil')
@section('content')
<section class="hero" aria-labelledby="hero-title">
  <div class="hero-spread">
    <div class="hero-copy">
      <span class="overline">✿ CHAPITRE 01 — ENTRE DANS L'HISTOIRE</span>
      <h1 id="hero-title">Chaque page,<br>un nouvel<br><em>univers.</em></h1>
      <p class="lede">Animés à regarder, mangas à feuilleter. Explore les histoires, découvre leurs synopsis et trouve ton prochain univers.</p>
      <div class="hero-actions"><a class="button rose" href="#bibliotheque">Explorer la collection <span aria-hidden="true">↗</span></a><a class="button cream" href="{{ route('about') }}">Notre histoire <span aria-hidden="true">→</span></a></div>
      <div class="tiny-caption">LECTURE · DÉCOUVERTES · ÉMOTIONS <span aria-hidden="true">✿</span></div>
    </div>
    <div class="hero-panels" aria-label="Illustrations de style manga japonais">
      <div class="hero-panel main"><img src="{{ asset('images/hero-sakura.svg') }}" alt="Ruelle et montagnes japonaises au printemps, cerisiers en fleurs"><span class="vertical-note" lang="ja">桜の季節、新しい物語</span></div>
      <div class="hero-panel mini-landscape"><span class="vertical-note" lang="ja">物語の始まり</span></div>
      <div class="hero-panel mini-bloom"><span class="bloom" aria-hidden="true">✿</span><span class="bubble">À toi d'écrire<br>la suite !</span></div>
    </div>
  </div>
</section>
<div class="page-edge" aria-hidden="true"><span>À FEUILLETER</span><span>À DÉCOUVRIR</span><span>À AIMER</span><span>À FEUILLETER</span></div>
<section class="section" id="bibliotheque" aria-labelledby="featured-title">
  <div class="section-header"><div><div class="section-kicker">LE CATALOGUE OTAKULIST</div><h2 id="featured-title">Ta prochaine <em>histoire.</em></h2></div><span class="result-count">{{ $oeuvres->total() }} {{ $oeuvres->total() > 1 ? 'œuvres' : 'œuvre' }} à découvrir</span></div>
  <form class="catalogue-filters" action="{{ route('home') }}#bibliotheque" method="get" role="search" aria-label="Rechercher dans le catalogue">
    <div class="search-field"><label for="catalogue-search">Rechercher une œuvre</label><input id="catalogue-search" type="search" name="q" maxlength="120" value="{{ $filters['q'] ?? '' }}" placeholder="Naruto, Frieren…"></div>
    <div><label for="catalogue-type">Format</label><select id="catalogue-type" name="type"><option value="">Tous les formats</option value="anime" @selected(($filters['type'] ?? '') === 'anime')>Animés</option><option value="manga" @selected(($filters['type'] ?? '') === 'manga')>Mangas</option></select></div>
    <div><label for="catalogue-status">Statut</label><select id="catalogue-status" name="status"><option value="">Tous les statuts</option><option value="en_cours" @selected(($filters['status'] ?? '') === 'en_cours')>En cours</option><option value="termine" @selected(($filters['status'] ?? '') === 'termine')>Terminé</option><option value="a_venir" @selected(($filters['status'] ?? '') === 'a_venir')>À venir</option></select></div>
    <button class="button rose" type="submit">Rechercher ↗</button>
    <a class="reset-filters" href="{{ route('home') }}#bibliotheque">Réinitialiser</a>
  </form>
  @if($errors->any())<p class="filter-error" role="alert">Vérifie les filtres : choisis un format et un statut proposés, et un titre de 120 caractères maximum.</p>@endif
  <div class="catalogue-caption"><span>À REGARDER · À FEUILLETER · À DÉCOUVRIR</span><span>Les mieux notées en premier</span></div>
  <div class="feature-grid">
    @forelse($oeuvres as $oeuvre)
      <x-site.oeuvre-card :oeuvre="$oeuvre" />
    @empty
      <div class="catalogue-empty"><span aria-hidden="true">✿</span><h3>Aucune œuvre trouvée</h3><p>Essaie un autre titre ou réinitialise les filtres pour explorer toute la collection.</p><a class="button cream" href="{{ route('home') }}#bibliotheque">Réinitialiser les filtres →</a></div>
    @endforelse
  </div>
  @if($oeuvres->hasPages())
    <nav class="catalogue-pagination" aria-label="Pages du catalogue">
      @if($oeuvres->previousPageUrl())<a class="button cream" href="{{ $oeuvres->previousPageUrl() }}">← Précédent</a>@endif
      <span>Page {{ $oeuvres->currentPage() }} sur {{ $oeuvres->lastPage() }}</span>
      @if($oeuvres->nextPageUrl())<a class="button cream" href="{{ $oeuvres->nextPageUrl() }}">Suivant →</a>@endif
    </nav>
  @endif
  <div class="feature-story" id="histoire">
    <div class="story-poster"><span class="poster-label">✿ LE CHAPITRE DE LA SEMAINE</span><h3>Brise<br>d'après.</h3><p>Les histoires continuent...</p></div>
    <article class="feature-copy"><span class="issue">LE RENDEZ-VOUS OTAKU · ÉDITION 01</span><h3>Une histoire peut tout changer.</h3><p>Un titre, un studio, un univers à explorer. Prends le temps de lire les synopsis et laisse-toi surprendre par ta prochaine découverte.</p><a class="button cream" href="{{ route('about') }}">Découvrir le projet <span aria-hidden="true">→</span></a></article>
  </div>
</section>
<section class="section genre-section" id="decouvertes" aria-labelledby="genre-title">
  <div class="section-header"><div><div class="section-kicker">TROUVE TA PROCHAINE HISTOIRE</div><h2 id="genre-title">Ton humeur, <em>ton manga.</em></h2></div><span class="section-link">TROIS UNIVERS À DÉCOUVRIR</span></div>
  <div class="genre-grid">
    <a class="genre-tile" data-symbol="✿" href="{{ route('home', ['type' => 'anime']) }}#bibliotheque"><span>01 / À REGARDER</span><h3>Animés ↗</h3><p>Des univers qui prennent vie à l'écran.</p></a>
    <a class="genre-tile" data-symbol="森" href="{{ route('home', ['type' => 'manga']) }}#bibliotheque"><span>02 / À FEUILLETER</span><h3>Mangas ↗</h3><p>Des histoires à découvrir page après page.</p></a>
    <a class="genre-tile" data-symbol="✦" href="{{ route('home', ['status' => 'termine']) }}#bibliotheque"><span>03 / JUSQU'AU BOUT</span><h3>Terminés ↗</h3><p>Pour découvrir une histoire complète.</p></a>
  </div>
</section>
@endsection
