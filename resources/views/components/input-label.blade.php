@props(['value'])

<label {{ $attributes->merge(['class' => 'leading-7 text-sm text-gray-400']) }}>
    {{ $value ?? $slot }}
</label>
