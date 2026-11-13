<x-layout.guest>
    <x-slot:title>Mot de passe oublié</x-slot:title>
    <div class="contact-sheet auth-sheet">
        <span class="contact-label">RETROUVE LE FIL</span>
        <h1>Mot de passe oublié ?</h1>
        <p>Indique ton adresse e-mail pour recevoir un lien de réinitialisation.</p>
        <form method="POST" action="{{ route('password.email') }}" class="site-form">
            @csrf
            <div>
                <x-label for="email" value="Adresse e-mail" />
                <x-input id="email" name="email" type="email" :value="old('email')" autocomplete="email" required autofocus />
            </div>
            <button type="submit" class="button rose">Recevoir un lien →</button>
            <a class="form-link" href="{{ route('login') }}">Retour à la connexion</a>
        </form>
    </div>
</x-layout.guest>

