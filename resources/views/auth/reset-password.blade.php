<x-layout.guest>
    <x-slot:title>Réinitialiser le mot de passe</x-slot:title>
    <div class="contact-sheet auth-sheet">
        <span class="contact-label">ÉCRIS LA SUITE</span>
        <h1>Un nouveau mot de passe.</h1>
        <form method="POST" action="{{ route('password.update') }}" class="site-form">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div>
                <x-label for="email" value="Adresse e-mail" />
                <x-input id="email" name="email" type="email" :value="old('email', $email)" autocomplete="email" required />
            </div>
            <div>
                <x-label for="password" value="Nouveau mot de passe (8 caractères minimum)" />
                <x-input id="password" name="password" type="password" autocomplete="new-password" minlength="8" required />
            </div>
            <div>
                <x-label for="password_confirmation" value="Confirmer le mot de passe" />
                <x-input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required />
            </div>
            <button type="submit" class="button rose">Réinitialiser →</button>
        </form>
    </div>
</x-layout.guest>

