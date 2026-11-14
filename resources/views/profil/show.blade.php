<x-layout.app>
    @section('title', 'Mon profil')
    <section class="section auth-section" aria-labelledby="profil-heading">
        <div class="contact-sheet auth-sheet">
            <span class="contact-label">TON COIN OTAKULIST</span>
            <h1 id="profil-heading">Mon profil.</h1>
            <h2>{{ $user->name }}</h2>
            <dl class="profile-details">
                <div><dt>Prénom</dt><dd>{{ $user->prenom ?: 'Non renseigné' }}</dd></div>
                <div><dt>Nom</dt><dd>{{ $user->nom ?: 'Non renseigné' }}</dd></div>
                <div><dt>Adresse e-mail</dt><dd>{{ $user->email }}</dd></div>
            </dl>
            <div class="profile-actions">
                <a class="button rose" href="{{ route('profil.edit') }}"><i class="fa-solid fa-pen" aria-hidden="true"></i> Modifier mon profil</a>
                <a class="form-link" href="{{ route('password.edit') }}">Changer mon mot de passe</a>
            </div>
        </div>
    </section>
</x-layout.app>
