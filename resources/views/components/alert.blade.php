@props(['type' => 'info', 'title' => null, 'dismissible' => false])

<x-patials.alert :type="$type" :title="$title" :dismissible="$dismissible" {{ $attributes }}>
    {{ $slot }}
</x-patials.alert>
