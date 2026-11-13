<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Authentification' }} · OtakuList</title>
    <link rel="stylesheet" href="{{ asset('css/otaku.css') }}">
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
</head>
<body>
    <div class="site">
        <a class="skip-link" href="#main">Aller au contenu</a>
        <x-site.header />
        <x-site.navigation />
        <main id="main">
            <section class="section auth-section">
                <x-partials.alerts />
                {{ $slot }}
            </section>
        </main>
        <x-site.footer />
    </div>
</body>
</html>

