<x-layout.guest>
    <x-slot:title>Connexion</x-slot:title>
    <div class="contact-sheet auth-sheet">
        <span class="contact-label">UN NOUVEAU CHAPITRE</span>
        <h1>Heureux de te revoir.</h1>
        <p>Pas encore de compte ? <a class="form-link" href="{{ route('register') }}">Inscris-toi ici</a>.</p>
        <form method="POST" action="{{ route('login') }}" class="site-form">
            @csrf
            <div>
                <x-label for="email" value="Adresse e-mail" />
                <x-input id="email" name="email" type="email" :value="old('email')" autocomplete="username" required autofocus />
            </div>
            <div>
                <x-label for="password" value="Mot de passe" />
                <x-input id="password" name="password" type="password" autocomplete="current-password" required />
            </div>
            <a class="form-link" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
            <div class="remember-field">
                <input id="remember" name="remember" type="checkbox" value="1" @checked(old('remember'))>
                <x-label for="remember" value="Rester connecté" />
            </div>
            <button type="submit" class="button rose">Se connecter →</button>
        </form>
    </div>
</x-layout.guest>

