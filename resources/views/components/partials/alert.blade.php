<div {{ $attributes->merge(['class' => 'alert alert-'.$type, 'role' => 'alert']) }}
    @if ($dismissible) x-data="{ show: true }" x-show="show" x-transition @endif>
    <div class="alert-content">
        <i class="fa-solid {{ $icon }} alert-icon" aria-hidden="true"></i>
        <div class="alert-message">
            @if ($title)
                <strong class="alert-title">{{ $title }}</strong>
            @endif
            <div>{{ $slot }}</div>
        </div>
        @if ($dismissible)
            <button type="button" class="alert-close" x-on:click="show = false" aria-label="Fermer le message">
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
            </button>
        @endif
    </div>
</div>
