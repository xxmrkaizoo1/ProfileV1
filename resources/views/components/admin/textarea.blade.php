@props(['label', 'id', 'value' => ''])

<div>
    <label for="{{ $id }}" class="mb-1.5 block text-sm font-medium text-ink-soft">{{ $label }}</label>
    <textarea id="{{ $id }}" {{ $attributes->merge(['class' => 'admin-input', 'rows' => 3]) }}>{{ $value }}</textarea>
</div>
