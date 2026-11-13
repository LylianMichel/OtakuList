<nav class="navigation" aria-label="Navigation principale">
  <a class="brand" href="{{ route('home') }}" aria-label="OtakuList — retour à l'accueil">OtakuList<small>LE MANGA AUTREMENT</small></a>
  <div class="navigation-links">
    <a href="{{ route('home') }}" @if(request()->routeIs('home')) aria-current="page" @endif>Accueil</a>
    <a href="{{ route('home') }}#bibliotheque">Bibliothèque</a>
    <a href="{{ route('home') }}#decouvertes">Découvertes</a>
    <a href="{{ route('about') }}" @if(request()->routeIs('about')) aria-current="page" @endif>À propos</a>
    <a href="{{ route('contact') }}" @if(request()->routeIs('contact')) aria-current="page" @endif>Contact</a>
  </div>
  <div class="navigation-actions">
    @auth
      <a class="form-link" href="{{ route('password.edit') }}">Mon compte</a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="button cream">Déconnexion</button>
      </form>
    @else
      <a class="form-link" href="{{ route('login') }}">Connexion</a>
      <a class="button rose" href="{{ route('register') }}">Inscription ↗</a>
    @endauth
  </div>
  <details class="mobile-menu"><summary>☰ Menu</summary><div class="mobile-links">
    <a href="{{ route('home') }}">Accueil</a>
    <a href="{{ route('home') }}#bibliotheque">Bibliothèque</a>
    <a href="{{ route('home') }}#decouvertes">Découvertes</a>
    <a href="{{ route('about') }}">À propos</a>
    <a href="{{ route('contact') }}">Contact</a>
    @auth
      <a href="{{ route('password.edit') }}">Mon compte</a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Déconnexion</button>
      </form>
    @else
      <a href="{{ route('login') }}">Connexion</a>
      <a href="{{ route('register') }}">Inscription</a>
    @endauth
  </div></details>
</nav>
