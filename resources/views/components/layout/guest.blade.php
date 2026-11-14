<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Authentification' }} · OtakuList</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
</head>
<body>
    <div class="site">
        <a class="skip-link" href="#main">Aller au contenu</a>
        <x-site.header />
        <x-site.navigation />
        <main id="main">
            <x-partials.alerts />
            <x-partials.flash-messages />
            <section class="section auth-section">
                {{ $slot }}
            </section>
        </main>
        <x-site.footer />
    </div>
</body>
</html>
