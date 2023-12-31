@props(['name' => '', 'label' => 'Label', 'type' => 'text', 'errors' => collect([])])


@php
    $id = Str::random(10);
@endphp


<div {{ $attributes->merge([
    'class' => 'flex flex-col',
]) }}>
    <label for="{{ $id }}" class="mb-2">{{ $label }} </label>
    <input type="{{ $type }}"
        class="p-2 rounded w-full border  {{ $errors->has($name) ? 'border-red' : 'border-grey' }}"
        name="{{ $name }}" id="{{ $id }}" />

    @if ($errors->has($name))
        <span class="text-red mt-1 text-sm">{{ $errors->first($name) }}</span>
    @endif
</div>
