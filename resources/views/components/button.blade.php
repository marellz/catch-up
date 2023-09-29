@props(['type' => ''])

<button
    {{ $attributes->merge([
        'type' => $type,
        'class' => 'inline-flex justify-center items-center py-2 px-5 bg-dark-blue text-white rounded',
    ]) }}>

    {{ $slot }}
</button>
