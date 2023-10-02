@props(['label' => 'Label'])

<div class="relative" x-data="{ open: false }" @click.away="open = false">
    <button type="button" class="border border-grey p-2 rounded flex items-center w-full text-left" @click="open = !open">
        <span class="flex-auto">
            {{ $label }}
        </span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"
            class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
        </svg>
    </button>

    <div class="flex flex-col border border-grey rounded absolute top-full transform translate-y-2 bg-white min-w-full z-20 max-h-[250px] overflow-auto right-0" x-show="open">
        {{ $slot }}
    </div>
</div>
