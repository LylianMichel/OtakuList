@foreach ($errors->getBags() as $errorBag)
    @if ($errorBag->any())
        <div class="site-messages">
            <x-alert type="error" title="Le formulaire contient des erreurs." dismissible>
                <ul>
                    @foreach ($errorBag->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-alert>
        </div>
    @endif
@endforeach

@if (session('status'))
    <div class="site-messages">
        <x-alert type="success" dismissible>{{ session('status') === 'password-updated' ? 'Ton mot de passe a été modifié.' : session('status') }}</x-alert>
    </div>
@endif
