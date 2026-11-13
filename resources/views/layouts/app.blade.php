<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="theme-color" content="#fffaf3">
  <meta name="description" content="Explore le catalogue OtakuList : animés, mangas, synopsis et notes dans un univers inspiré des cerisiers en fleurs.">
  <title>@yield('title', 'Accueil') · OtakuList</title>
  <link rel="stylesheet" href="{{ asset('css/otaku.css') }}">
  <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
</head>
<body>
  <div class="site">
    <a class="skip-link" href="#main">Aller au contenu</a>
    <x-site.header />
    <x-site.navigation />
    <main id="main">
      @if ($errors->any() || session('status'))
        <div class="site-messages"><x-partials.alerts /></div>
      @endif
      @yield('content')
    </main>
    <x-site.ribbon />
    <x-site.footer />
  </div>
</body>
</html>
