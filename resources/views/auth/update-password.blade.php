<x-layout.app>
    <section class="section auth-section">
        <div class="contact-sheet auth-sheet">
            <span class="contact-label">MON COMPTE</span>
            <h1>Changer de mot de passe.</h1>
            <form method="POST" action="{{ route('user-password.update') }}" class="site-form">
                @csrf
                @method('PUT')
                <div>
                    <x-label for="current_password" value="Mot de passe actuel" />
                    <x-input id="current_password" name="current_password" type="password" autocomplete="current-password" required />
                </div>
                <div>
                    <x-label for="password" value="Nouveau mot de passe (8 caractères minimum)" />
                    <x-input id="password" name="password" type="password" autocomplete="new-password" minlength="8" required />
                </div>
                <div>
                    <x-label for="password_confirmation" value="Confirmer le mot de passe" />
                    <x-input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required />
                </div>
                <button type="submit" class="button rose">Modifier le mot de passe →</button>
            </form>
        </div>
    </section>
</x-layout.app>

