@props(['oeuvres'])

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach ($oeuvres as $oeuvre)
        <x-oeuvre-card :oeuvre="$oeuvre" />
    @endforeach
</div>
