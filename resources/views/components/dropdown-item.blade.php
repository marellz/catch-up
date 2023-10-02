@props(['path' => '#'])

<a href="{{ $path }}" class="flex items-center space-x-2 px-4 py-2 hover:bg-dark-blue hover:text-white w-full">
    {{ $slot }}
</a>
