@extends('layouts.app')
@section('title', 'Accueil')
@section('content')
<section class="hero" aria-labelledby="hero-title">
  <div class="hero-spread">
    <div class="hero-copy">
      <span class="overline"><i class="fa-solid fa-fan"></i> CHAPITRE 01 — ENTRE DANS L'HISTOIRE</span>
      <h1 id="hero-title">Chaque page,<br>un nouvel<br><em>univers.</em></h1>
      <p class="lede">Animés à regarder, mangas à feuilleter. Explore les histoires, découvre leurs synopsis et trouve ton prochain univers.</p>
      <div class="hero-actions"><a class="button rose" href="{{ route('oeuvres.index') }}">Explorer la collection <i class="fa-solid fa-arrow-up-right-from-square"></i></a><a class="button cream" href="{{ route('about') }}">Notre histoire <i class="fa-solid fa-arrow-right-long"></i></a></div>
      <div class="tiny-caption">LECTURE · DÉCOUVERTES · ÉMOTIONS <i class="fa-solid fa-fan"></i></div>
    </div>
    <div class="hero-panels" aria-label="Illustrations de style manga japonais">
      <div class="hero-panel main"><img src="{{ asset('images/hero-sakura.svg') }}" alt="Ruelle et montagnes japonaises au printemps, cerisiers en fleurs"><span class="vertical-note" lang="ja">桜の季節、新しい物語</span></div>
      <div class="hero-panel mini-landscape"><span class="vertical-note" lang="ja">物語の始まり</span></div>
      <div class="hero-panel mini-bloom"><span class="bloom" aria-hidden="true">✿</span><span class="bubble">À toi d'écrire<br>la suite !</span></div>
    </div>
  </div>
</section>
<div class="page-edge" aria-hidden="true"><span>À FEUILLETER</span><span>À DÉCOUVRIR</span><span>À AIMER</span><span>À FEUILLETER</span></div>
<section class="section" aria-label="Découvrir OtakuList">
  <div class="feature-story" id="histoire">
    <div class="story-poster"><span class="poster-label"><i class="fa-solid fa-fan"></i> LE CHAPITRE DE LA SEMAINE</span><h3>Brise<br>d'après.</h3><p>Les histoires continuent...</p></div>
    <article class="feature-copy"><span class="issue">LE RENDEZ-VOUS OTAKU · ÉDITION 01</span><h3>Une histoire peut tout changer.</h3><p>Un titre, un studio, un univers à explorer. Prends le temps de lire les synopsis et laisse-toi surprendre par ta prochaine découverte.</p><a class="button cream" href="{{ route('about') }}">Découvrir le projet <i class="fa-solid fa-arrow-right-long"></i></a></article>
  </div>
</section>
<section class="section genre-section" id="decouvertes" aria-labelledby="genre-title">
  <div class="section-header"><div><div class="section-kicker">TROUVE TA PROCHAINE HISTOIRE</div><h2 id="genre-title">Ton humeur, <em>ton manga.</em></h2></div><span class="section-link">TROIS UNIVERS À DÉCOUVRIR</span></div>
  <div class="genre-grid">
    <a class="genre-tile" data-symbol="✿" href="{{ route('oeuvres.index', ['type' => 'anime']) }}#bibliotheque"><span>01 / À REGARDER</span><h3>Animés <i class="fa-solid fa-arrow-up-right-from-square"></i></h3><p>Des univers qui prennent vie à l'écran.</p></a>
    <a class="genre-tile" data-symbol="森" href="{{ route('oeuvres.index', ['type' => 'manga']) }}#bibliotheque"><span>02 / À FEUILLETER</span><h3>Mangas <i class="fa-solid fa-arrow-up-right-from-square"></i></h3><p>Des histoires à découvrir page après page.</p></a>
    <a class="genre-tile" data-symbol="✦" href="{{ route('oeuvres.index', ['status' => 'termine']) }}#bibliotheque"><span>03 / JUSQU'AU BOUT</span><h3>Terminés <i class="fa-solid fa-arrow-up-right-from-square"></i></h3><p>Pour découvrir une histoire complète.</p></a>
  </div>
</section>
@endsection
