@php
    $classes = "py-3 w-1/4 flex justify-center gap-2.5 border-b-2 title-font font-medium items-center leading-none rounded-t cursor-pointer hover:bg-green-800 bg-gray-800";
@endphp


<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>