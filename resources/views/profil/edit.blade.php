<x-layout.app>
    @section('title', 'Modifier mon profil')
    <section class="section auth-section" aria-labelledby="profil-heading">
        <div class="contact-sheet auth-sheet">
            <span class="contact-label">TON COIN OTAKULIST</span>
            <h1 id="profil-heading">Modifier mon profil.</h1>
            <form method="POST" action="{{ route('profil.update') }}" class="site-form">
                @csrf
                @method('PUT')
                <div>
                    <x-label for="prenom" value="Ton prénom" />
                    <x-input id="prenom" name="prenom" :value="old('prenom', $user->prenom)" autocomplete="given-name" maxlength="255" required />
                </div>
                <div>
                    <x-label for="nom" value="Ton nom" />
                    <x-input id="nom" name="nom" :value="old('nom', $user->nom)" autocomplete="family-name" maxlength="255" required />
                </div>
                <div>
                    <x-label for="email" value="Ton adresse e-mail" />
                    <x-input id="email" name="email" type="email" :value="old('email', $user->email)" autocomplete="email" maxlength="255" required />
                </div>
                <button type="submit" class="button rose">Enregistrer les modifications <span aria-hidden="true">→</span></button>
                <a class="form-link" href="{{ route('password.edit') }}">Changer mon mot de passe</a>
                <a class="form-link" href="{{ route('profil.show') }}">Retour à mon profil</a>
            </form>
        </div>
    </section>
</x-layout.app>
