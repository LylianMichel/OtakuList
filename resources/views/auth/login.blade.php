<x-layout.guest>
    <x-slot:title>Connexion</x-slot:title>
    <div class="contact-sheet auth-sheet" aria-labelledby="login-heading">
        <span class="contact-label">REPRENDS LE FIL</span>
        <h1 id="login-heading">Heureux de te revoir.</h1>
        <p>Connecte-toi pour retrouver ton univers OtakuList.</p>
        <form method="POST" action="{{ route('login') }}" class="site-form" id="loginForm">
            @csrf
            <div>
                <x-label for="email" value="Ton adresse e-mail" />
                <x-input id="email" name="email" type="email" :value="old('email')" autocomplete="email" maxlength="255" required autofocus />
            </div>
            <div x-data="{ visible: false }">
                <x-label for="password" value="Ton mot de passe" />
                <x-input id="password" name="password" type="password" x-bind:type="visible ? 'text' : 'password'" autocomplete="current-password" required />
                <button type="button" class="form-link password-toggle" x-on:click="visible = !visible" x-bind:aria-pressed="visible" aria-pressed="false" aria-controls="password" x-text="visible ? 'Masquer le mot de passe' : 'Afficher le mot de passe'">Afficher le mot de passe</button>
            </div>
            <div class="remember-field">
                <input id="remember" name="remember" type="checkbox" value="1" @checked(old('remember'))>
                <x-label for="remember" value="Se souvenir de moi" />
            </div>
            <button type="submit" class="button rose">Me connecter <span aria-hidden="true">→</span></button>
            <a class="form-link" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
            <p>Pas encore de compte ? <a class="form-link" href="{{ route('register') }}">Rejoins OtakuList</a></p>
        </form>
    </div>
</x-layout.guest>
