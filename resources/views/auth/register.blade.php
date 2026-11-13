<x-layout.guest>
    <x-slot:title>Inscription</x-slot:title>
    <div class="contact-sheet auth-sheet">
        <span class="contact-label">REJOINS L'HISTOIRE</span>
        <h1>Bienvenue dans l'univers.</h1>
        <p>Déjà inscrit ? <a class="form-link" href="{{ route('login') }}">Connecte-toi ici</a>.</p>
        <form method="POST" action="{{ route('register') }}" class="site-form">
            @csrf
            <div>
                <x-label for="name" value="Nom" />
                <x-input id="name" name="name" :value="old('name')" autocomplete="name" maxlength="255" required autofocus />
            </div>
            <div>
                <x-label for="email" value="Adresse e-mail" />
                <x-input id="email" name="email" type="email" :value="old('email')" autocomplete="email" maxlength="255" required />
            </div>
            <div>
                <x-label for="password" value="Mot de passe (8 caractères minimum)" />
                <x-input id="password" name="password" type="password" autocomplete="new-password" minlength="8" required />
            </div>
            <div>
                <x-label for="password_confirmation" value="Confirmer le mot de passe" />
                <x-input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required />
            </div>
            <button type="submit" class="button rose">Créer mon compte →</button>
        </form>
    </div>
</x-layout.guest>

