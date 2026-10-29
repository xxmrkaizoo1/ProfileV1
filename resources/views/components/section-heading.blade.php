@props(['number', 'label', 'description' => null, 'headingId' => null])

<div data-scroll-reveal class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
    <div>
        <p class="font-mono text-xs uppercase tracking-[0.2em] text-primary">{{ $number }} / {{ $label }}</p>
        <h2 @if ($headingId) id="{{ $headingId }}" @endif class="mt-3 max-w-2xl text-3xl font-semibold tracking-tight text-ink sm:text-4xl">
            {{ $slot }}
        </h2>
    </div>
    @if ($description)
        <p class="max-w-md text-sm leading-6 text-muted sm:text-right">{{ $description }}</p>
    @endif
</div>
