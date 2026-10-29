@props(['id', 'step', 'title', 'description' => null])

<section id="{{ $id }}" data-scroll-reveal {{ $attributes->merge(['class' => 'scroll-mt-28 rounded-2xl border border-edge/10 bg-surface p-6 sm:p-8']) }}>
    <header class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <p class="font-mono text-xs text-primary">{{ $step }}</p>
            <h2 class="mt-1.5 text-xl font-semibold tracking-tight text-ink">{{ $title }}</h2>
            @if ($description)
                <p class="mt-2 max-w-2xl text-sm leading-6 text-muted">{{ $description }}</p>
            @endif
        </div>
        {{ $actions ?? '' }}
    </header>

    <div class="mt-7">
        {{ $slot }}
    </div>
</section>
