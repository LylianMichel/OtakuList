@extends('layouts.app')
@section('title', 'À propos')
@section('content')
<x-site.page-heading eyebrow="✿ CHAPITRE 02 — QUI SOMMES-NOUS ?" title="Une passion qui" accent="se partage." intro="OtakuList rassemble animés et mangas dans un catalogue pensé comme un carnet illustré, avec l'encre noire et les fleurs de cerisier pour fil rouge." />
<section class="section" aria-labelledby="about-heading">
  <div class="section-header"><div><div class="section-kicker">TROIS CASES, UNE HISTOIRE</div><h2 id="about-heading">L'esprit OtakuList <em>✿</em></h2></div></div>
  <div class="story-columns">
    <article class="story-column" data-symbol="本"><span class="index">01 / L'ORIGINE</span><h3>Le plaisir<br>de feuilleter.</h3><p>Retrouver l'émotion des librairies manga, le grain du papier et le plaisir de découvrir de nouveaux univers.</p></article>
    <article class="story-column" data-symbol="桜"><span class="index">02 / L'IDENTITÉ</span><h3>Une touche<br>de otaku.</h3><p>Du rose poudré pour la douceur, du noir intense pour l'encre et des cases dessinées pour raconter chaque page.</p></article>
    <article class="story-column" data-symbol="✦"><span class="index">03 / LE PROJET</span><h3>Ta prochaine<br>découverte.</h3><p>Explore les œuvres par format et statut, consulte leurs notes et découvre les histoires grâce à leurs synopsis.</p></article>
  </div>
</section>
<div class="quote-band"><strong>Les plus belles histoires naissent parfois d'une <em>simple page.</em></strong><a class="button dark" href="{{ route('contact') }}">Nous écrire ↗</a></div>
@endsection
