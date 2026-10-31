<!doctype html>
<html lang="fr">
<x-site.head />
<body>
  <div class="site">
    <a class="skip-link" href="#main">Aller au contenu</a>
    <x-site.header />
    <x-site.navigation />
    <main id="main">@yield('content')</main>
    <x-site.ribbon />
    <x-site.footer />
  </div>
</body>
</html>
