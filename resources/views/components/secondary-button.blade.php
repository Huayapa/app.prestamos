<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center bg-white px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition']) }}>
    {{ $slot }}
</button>
