@foreach (array_keys(\App\View\Components\Patials\Alert::TYPES) as $type)
    @if (session($type))
        <div class="site-messages">
            <x-alert :type="$type" dismissible>{{ session($type) }}</x-alert>
        </div>
    @endif
@endforeach
