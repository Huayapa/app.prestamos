@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center gap-3 px-4 py-3 bg-gray-900 text-white rounded-lg font-medium transition'
            : 'flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg font-medium transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
