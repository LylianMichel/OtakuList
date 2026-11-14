@foreach (array_keys(\App\View\Components\Partials\Alert::TYPES) as $type)
    @if (session($type))
        <div class="site-messages">
            <x-partials.alert :type="$type" dismissible>{{ session($type) }}</x-partials.alert>
        </div>
    @endif
@endforeach
