@props(['label', 'id', 'hint' => 'JPG, PNG or WebP'])

<div>
    <label for="{{ $id }}" class="block">
        <span class="mb-1.5 block text-sm font-medium text-ink-soft">{{ $label }}</span>
        <span data-file-drop class="admin-dropzone">
            <img data-file-preview alt="" class="hidden h-12 w-16 shrink-0 rounded-lg border border-edge/10 object-cover">
            <span data-file-icon aria-hidden="true" class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-edge/10 bg-edge/[0.04] text-muted transition">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 16V4m0 0L7 9m5-5 5 5"></path><path d="M4 16v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2"></path></svg>
            </span>
            <span class="min-w-0 flex-1">
                <span data-file-name class="block truncate text-sm font-medium text-ink">Choose a file</span>
                <span class="block text-xs text-muted">or drag it here · {{ $hint }}</span>
            </span>
        </span>
    </label>
    <input id="{{ $id }}" type="file" data-file-input accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" {{ $attributes->merge(['class' => 'sr-only']) }}>
</div>
