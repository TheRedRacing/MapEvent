@props(['active'])

@php
$classes = ($active ?? false)
            ? 'h-full w-full flex items-center gap-1 rounded-md cursor-pointer text-white bg-green-700 hover:bg-green-800'
            : 'h-full w-full flex items-center gap-1 rounded-md cursor-pointer text-white hover:bg-green-900';
@endphp

<li class="flex items-center" style="height: 50px;">
    <a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}    
    </a>
</li>

