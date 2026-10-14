@extends('layouts.app')
@section('title', 'Contact')
@section('content')
<x-site.page-heading eyebrow="✿ CHAPITRE 03 — À TON TOUR" title="Une idée ?" accent="Écris-nous." intro="Tu as une question, un coup de cœur manga à partager ou une idée pour notre univers ? Cette page présente la future section contact du site." symbol="文" />
<section class="section" aria-labelledby="contact-heading">
  <div class="section-header"><div><div class="section-kicker">LAISSE UN PETIT MOT</div><h2 id="contact-heading">Restons en contact <em>✿</em></h2></div></div>
  <div class="contact-layout">
    <article class="contact-sheet"><span class="contact-label">01 / UN MESSAGE À PARTAGER</span><h2>Les histoires commencent par un bonjour.</h2><p>Pour cette première version statique du TP, le formulaire et l'envoi d'e-mails ne sont pas encore activés.</p><div class="contact-mail">contact@exemple.fr</div><p class="contact-placeholder">Adresse fictive — à remplacer par la véritable adresse de contact avant publication.</p></article>
    <aside class="contact-note"><span class="contact-label">02 / UN MOT DOUX</span><blockquote>« Entre deux pages se cache peut-être le début d'une belle rencontre. »</blockquote><a class="button cream" href="{{ route('about') }}">Notre histoire →</a></aside>
  </div>
</section>
@endsection
