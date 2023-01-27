@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-sm text-gray-500 mb-2']) }}>
    {{ $value ?? $slot }}
</label>