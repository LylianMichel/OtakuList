@if ($errors->any())
    <x-alert type="error" title="Le formulaire contient des erreurs.">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-alert>
@endif

@if (session('status'))
    <x-alert type="success">{{ session('status') === 'password-updated' ? 'Ton mot de passe a été modifié.' : session('status') }}</x-alert>
@endif

