@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block px-3 mx-2 py-3 rounded-lg font-medium transition text-white bg-gray-900'
            : 'block px-3 mx-2 py-3 rounded-lg font-medium transition text-gray-600 hover:bg-gray-100';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
