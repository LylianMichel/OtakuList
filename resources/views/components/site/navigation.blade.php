<nav class="navigation" aria-label="Navigation principale">
  <a class="brand" href="{{ route('home') }}" aria-label="OtakuList — retour à l'accueil">OtakuList<small>LE MANGA AUTREMENT</small></a>
  <div class="navigation-links">
    <a href="{{ route('home') }}" @if(request()->routeIs('home')) aria-current="page" @endif>Accueil</a>
    <a href="{{ route('oeuvres.index') }}#bibliotheque">Bibliothèque</a>
    <a href="{{ route('home') }}#decouvertes">Découvertes</a>
    <a href="{{ route('about') }}" @if(request()->routeIs('about')) aria-current="page" @endif>À propos</a>
    <a href="{{ route('contact') }}" @if(request()->routeIs('contact')) aria-current="page" @endif>Contact</a>
  </div>
  <div class="navigation-actions">
    <a class="search-link" href="{{ route('oeuvres.index') }}#bibliotheque">Explorer</a>
    <a class="button rose" href="{{ route('contact') }}">Écris-nous <span aria-hidden="true">↗</span></a>
  </div>
  <details class="mobile-menu"><summary>☰ Menu</summary><div class="mobile-links">
    <a href="{{ route('home') }}">Accueil</a>
    <a href="{{ route('oeuvres.index') }}#bibliotheque">Bibliothèque</a>
    <a href="{{ route('home') }}#decouvertes">Découvertes</a>
    <a href="{{ route('about') }}">À propos</a>
    <a href="{{ route('contact') }}">Contact</a>
  </div></details>
</nav>
