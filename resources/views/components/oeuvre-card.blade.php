@props(['oeuvre'])

<div class="border rounded-lg p-4">
    <h2>{{ $oeuvre->titre }}</h2>

    <p>Type : {{ $oeuvre->type }}</p>
    <p>Année : {{ $oeuvre->annee }}</p>
    <p>Statut : {{ $oeuvre->status }}</p>
</div>

