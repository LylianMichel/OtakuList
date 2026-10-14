@props(['oeuvre'])
@php
  $statusLabel = ['en_cours' => 'En cours', 'termine' => 'Terminé', 'a_venir' => 'À venir'][$oeuvre->status] ?? $oeuvre->status;
  $image = $oeuvre->image;
  $imageUrl = null;
  if ($image && preg_match('~^https?://~i', $image)) {
      $imageUrl = $image;
  } elseif ($image && !str_contains($image, '..') && preg_match('~^[a-zA-Z0-9_./-]+$~', $image)) {
      $imageUrl = asset(str_starts_with($image, 'images/') || str_starts_with($image, 'storage/') ? $image : 'images/'.$image);
  }
@endphp
<article {{ $attributes->merge(['class' => 'manga-card oeuvre-card']) }}>
  <div class="cover-link catalogue-cover tone-{{ $oeuvre->id % 4 }}">
    @if($imageUrl)
      <img src="{{ $imageUrl }}" alt="Couverture de {{ $oeuvre->titre }}" loading="lazy">
    @else
      <div class="cover-placeholder"><span class="cover-edition">OTAKULIST / {{ $oeuvre->annee }}</span><span class="cover-flower" aria-hidden="true">✿</span><strong>{{ $oeuvre->titre }}</strong><span class="cover-caption">{{ $oeuvre->type === 'anime' ? 'À regarder' : 'À feuilleter' }}</span></div>
    @endif
    <span class="cover-tag">{{ $oeuvre->type === 'anime' ? 'Anime' : 'Manga' }}</span>
    <span class="rating" aria-label="Note : {{ $oeuvre->note }} sur 5">★ {{ number_format($oeuvre->note, 1, ',', ' ') }} <small>/ 5</small></span>
  </div>
  <div class="card-heading"><h3>{{ $oeuvre->titre }}</h3><span>{{ $oeuvre->annee }}</span></div>
  <div class="meta"><span class="status-{{ $oeuvre->status }}">{{ $statusLabel }}</span><span>{{ $oeuvre->nb_episodes_tomes === null ? 'Nombre à préciser' : $oeuvre->nb_episodes_tomes.' '.($oeuvre->type === 'anime' ? 'épisodes' : 'tomes') }}</span></div>
  <p class="studio">{{ $oeuvre->studio }}</p>
  <details class="synopsis"><summary>Lire le synopsis <span aria-hidden="true">＋</span></summary><p>{{ $oeuvre->synopsis }}</p></details>
</article>
