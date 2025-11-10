

<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'disabled:bg-white disabled:text-gray-900 disabled:border-2 disabled:border-gray-900 inline-flex items-center gap-2 px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition']) }}>
    {{ $slot }}
</button>
