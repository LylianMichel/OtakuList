@props(['eyebrow', 'title', 'accent', 'intro', 'symbol' => '桜'])
<section class="page-heading">
  <div><span class="overline">{{ $eyebrow }}</span><h1>{{ $title }} <em>{{ $accent }}</em></h1><p class="lede">{{ $intro }}</p></div>
  <div class="page-art" aria-hidden="true"><strong>{{ $symbol }}</strong><span class="page-stamp">OtakuList · VOL. 01</span></div>
</section>
