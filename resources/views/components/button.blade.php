@props(['type' => '', 'color' => 'bg-dark-blue hover:bg-light-blue hover:text-dark-blue text-white'])

<button
    {{ $attributes->merge([
        'type' => $type,
        'class' => 'inline-flex justify-center items-center py-2 px-5 rounded space-x-2'.' '.$color,
    ]) }}>

    {{ $slot }}
</button>
