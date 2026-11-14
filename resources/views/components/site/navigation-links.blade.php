<a href="{{ route('home') }}" @if(request()->routeIs('home')) aria-current="page" @endif><i class="fa-solid fa-house" aria-hidden="true"></i> Accueil</a>
<a href="{{ route('oeuvres.index') }}#bibliotheque" @if(request()->routeIs('oeuvres.*')) aria-current="page" @endif><i class="fa-solid fa-book-open" aria-hidden="true"></i> Bibliothèque</a>
<a href="{{ route('home') }}#decouvertes"><i class="fa-solid fa-compass" aria-hidden="true"></i> Découvertes</a>
<a href="{{ route('about') }}" @if(request()->routeIs('about')) aria-current="page" @endif><i class="fa-solid fa-circle-info" aria-hidden="true"></i> À propos</a>
<a href="{{ route('contact') }}" @if(request()->routeIs('contact')) aria-current="page" @endif><i class="fa-solid fa-envelope" aria-hidden="true"></i> Contact</a>
