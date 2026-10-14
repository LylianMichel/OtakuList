@props(['title', 'image', 'genre', 'chapters', 'tag' => 'À DÉCOUVRIR', 'volume' => '01', 'tone' => 'Manga'])
<article class="manga-card">
  <div class="cover-link" role="img" aria-label="Couverture fictive de {{ $title }}">
    <img src="{{ asset('images/' . $image) }}" alt="Illustration originale : {{ $title }}" loading="lazy">
    <span class="cover-tag">{{ $tag }}</span><span class="cover-number">{{ $volume }}</span>
  </div>
  <h3>{{ $title }}</h3><p>{{ $genre }} · {{ $chapters }} chapitres</p>
  <div class="meta"><span>{{ $tone }}</span><span>Édition papier</span></div>
</article>
