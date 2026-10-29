@props(['label', 'id', 'hint' => null])

<div>
    <label for="{{ $id }}" class="mb-1.5 block text-sm font-medium text-ink-soft">{{ $label }}</label>
    <input id="{{ $id }}" {{ $attributes->merge(['class' => 'admin-input', 'type' => 'text']) }}>
    @if ($hint)
        <p class="mt-1.5 text-xs text-faint">{{ $hint }}</p>
    @endif
</div>
