@props(['label' => 'Label'])

<div class="relative" x-data="{ open: false }" @click.away="open = false">
    <button type="button" class="border border-grey p-2 rounded flex items-center w-full text-left" @click="open = !open">
        <span class="flex-auto">
            {{ $label }}
        </span>
        <x-icons.sort />
    </button>

    <div class="flex flex-col border border-grey rounded absolute top-full transform translate-y-2 bg-white min-w-full z-20 max-h-[250px] overflow-auto right-0" x-show="open">
        {{ $slot }}
    </div>
</div>
