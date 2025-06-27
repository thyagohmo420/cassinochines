@props([
    'tag' => 'td',
])

<{{ $tag }}
style="background:#0D0D0D"
    {{ $attributes->class(['fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3']) }}
>
    {{ $slot }}
</{{ $tag }}>
