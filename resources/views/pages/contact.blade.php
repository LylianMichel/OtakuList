@extends('layouts.app')
@section('title', 'Contact')
@section('content')
<x-site.page-heading eyebrow="✿ CHAPITRE 03 — À TON TOUR" title="Une idée ?" accent="Écris-nous." intro="Une question, un coup de cœur manga ou une idée pour notre univers ? Laisse-nous un petit mot." symbol="文" />

<section class="section" aria-labelledby="contact-heading">
    <div class="section-header">
        <div>
            <div class="section-kicker">LAISSE UN PETIT MOT</div>
            <h2 id="contact-heading">Restons en contact <em>✿</em></h2>
        </div>
    </div>

    <div class="contact-layout">
        <article class="contact-sheet">
            <span class="contact-label">01 / UN MESSAGE À PARTAGER</span>
            <h2>Tout commence par un bonjour.</h2>
            <p id="contact-help">Formulaire de démonstration : les champs sont vérifiés, mais aucun e-mail n'est envoyé et aucun message n'est conservé.</p>
            <form method="POST" action="{{ route('contact.store') }}" class="site-form" aria-describedby="contact-help">
                @csrf
                <div>
                    <x-label for="name" value="Ton nom" />
                    <x-input id="name" name="name" :value="old('name')" autocomplete="name" maxlength="100" required />
                </div>
                <div>
                    <x-label for="email" value="Ton adresse e-mail" />
                    <x-input id="email" name="email" type="email" :value="old('email')" autocomplete="email" maxlength="255" required />
                </div>
                <div>
                    <x-label for="subject" value="Le sujet de ton message" />
                    <x-input id="subject" name="subject" :value="old('subject')" maxlength="150" required />
                </div>
                <div>
                    <x-label for="message" value="Ton message" />
                    <textarea id="message" name="message" rows="5" maxlength="3000" required>{{ old('message') }}</textarea>
                </div>
                <button class="button rose" type="submit">Tester mon message <span aria-hidden="true">↗</span></button>
            </form>
        </article>
        <aside class="contact-note">
            <span class="contact-label">02 / UN MOT DOUX</span>
            <blockquote>« Entre deux pages se cache peut-être le début d'une belle rencontre. »</blockquote>
            <a class="button cream" href="{{ route('about') }}">Notre histoire →</a>
        </aside>
    </div>
</section>

<section class="section" aria-labelledby="alerts-heading">
    <div class="section-header">
        <div>
            <div class="section-kicker">LE COIN DU TP</div>
            <h2 id="alerts-heading">Les messages <em>du site.</em></h2>
        </div>
    </div>
    <p>Ces quatre exemples permettent de tester le composant d'alerte.</p>
    <div class="alert-examples">
        <x-alert type="success" title="Succès" dismissible>Ton message a bien été validé.</x-alert>
        <x-alert type="error" title="Erreur" dismissible>Vérifie les informations saisies dans le formulaire.</x-alert>
        <x-alert type="warning" title="Avertissement" dismissible>Vérifie ton adresse e-mail avant de valider.</x-alert>
        <x-alert type="info" title="Information" dismissible>Les champs du formulaire sont tous obligatoires.</x-alert>
    </div>
</section>
@endsection
