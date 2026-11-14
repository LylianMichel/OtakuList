<x-layout.guest>
    <x-slot:title>Inscription</x-slot:title>
    <div class="contact-sheet auth-sheet" aria-labelledby="register-heading">
        <span class="contact-label">UN NOUVEAU CHAPITRE</span>
        <h1 id="register-heading">Ton univers commence ici.</h1>
        <p>Crée ton compte et partage ta passion des mangas et des animés.</p>
        <form method="POST" action="{{ route('register') }}" class="site-form" id="registerForm">
            @csrf
            <div>
                <x-label for="prenom" value="Ton prénom" />
                <x-input id="prenom" name="prenom" :value="old('prenom')" autocomplete="given-name" maxlength="255" required autofocus />
            </div>
            <div>
                <x-label for="nom" value="Ton nom" />
                <x-input id="nom" name="nom" :value="old('nom')" autocomplete="family-name" maxlength="255" required />
            </div>
            <div>
                <x-label for="email" value="Ton adresse e-mail" />
                <x-input id="email" name="email" type="email" :value="old('email')" autocomplete="email" maxlength="255" required />
            </div>
            <div x-data="{ visible: false }">
                <x-label for="password" value="Ton mot de passe (8 caractères minimum)" />
                <x-input id="password" name="password" type="password" x-bind:type="visible ? 'text' : 'password'" autocomplete="new-password" minlength="8" required />
                <button type="button" class="form-link password-toggle" x-on:click="visible = !visible" x-bind:aria-pressed="visible" aria-pressed="false" aria-controls="password" x-text="visible ? 'Masquer le mot de passe' : 'Afficher le mot de passe'">Afficher le mot de passe</button>
            </div>
            <div x-data="{ visible: false }">
                <x-label for="password-confirm" value="Confirme ton mot de passe" />
                <x-input id="password-confirm" name="password_confirmation" type="password" x-bind:type="visible ? 'text' : 'password'" autocomplete="new-password" minlength="8" required />
                <button type="button" class="form-link password-toggle" x-on:click="visible = !visible" x-bind:aria-pressed="visible" aria-pressed="false" aria-controls="password-confirm" x-text="visible ? 'Masquer la confirmation' : 'Afficher la confirmation'">Afficher la confirmation</button>
            </div>
            <button type="submit" class="button rose">Créer mon compte <span aria-hidden="true">→</span></button>
            <p>Déjà dans l’aventure ? <a class="form-link" href="{{ route('login') }}">Connecte-toi</a></p>
        </form>
    </div>
</x-layout.guest>
