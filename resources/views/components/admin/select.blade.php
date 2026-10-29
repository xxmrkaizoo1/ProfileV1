@props(['label', 'id', 'options', 'selected' => null])

<div>
    <label for="{{ $id }}" class="mb-1.5 block text-sm font-medium text-ink-soft">{{ $label }}</label>
    <select id="{{ $id }}" {{ $attributes->merge(['class' => 'admin-input admin-select']) }}>
        @foreach ($options as $value => $optionLabel)
            <option value="{{ $value }}" @selected($selected === $value)>{{ $optionLabel }}</option>
        @endforeach
    </select>
</div>
