@props(['oeuvres'])

<div {{ $attributes->merge(['class' => 'feature-grid']) }}>
    @forelse ($oeuvres as $oeuvre)
        <x-oeuvre-card :oeuvre="$oeuvre" />
    @empty
        <div class="catalogue-empty">
            <span aria-hidden="true">✿</span>
            <h3>Aucune œuvre trouvée</h3>
            <p>Essaie un autre titre ou réinitialise les filtres pour explorer toute la collection.</p>
            <a class="button cream" href="{{ route('oeuvres.index', ['search' => '']) }}">Réinitialiser les filtres →</a>
        </div>
    @endforelse
</div>
