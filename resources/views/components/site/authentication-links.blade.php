@guest
    <a class="form-link" href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket" aria-hidden="true"></i> Connexion</a>
    <a class="button rose" href="{{ route('register') }}"><i class="fa-solid fa-user-plus" aria-hidden="true"></i> Inscription</a>
@endguest
@auth
    <a class="form-link" href="{{ route('profil.show') }}"><i class="fa-solid fa-user" aria-hidden="true"></i> Mon profil</a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="button cream"><i class="fa-solid fa-right-from-bracket" aria-hidden="true"></i> Déconnexion</button>
    </form>
@endauth
