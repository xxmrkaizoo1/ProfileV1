@props(['title'])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ $title }} · {{ config('portfolio.name') }}</title>
    @include('partials.theme-script')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body {{ $attributes->merge(['class' => 'min-h-screen overflow-x-hidden bg-canvas font-sans text-ink antialiased']) }}>
    <div aria-hidden="true" class="page-grid"></div>

    {{ $slot }}

    @if (session('status'))
        <div data-toast role="status" class="admin-toast fixed right-4 top-4 z-[70] flex w-[min(24rem,calc(100vw-2rem))] items-start gap-3 overflow-hidden rounded-xl border border-primary/30 bg-surface/95 px-4 py-3.5 text-sm shadow-[0_20px_50px_var(--theme-shadow)] backdrop-blur-md">
            <span aria-hidden="true" class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-primary text-on-primary">
                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"></path></svg>
            </span>
            <p class="flex-1 text-ink">{{ session('status') }}</p>
            <button type="button" data-toast-close aria-label="Dismiss notification" class="-m-1 flex h-7 w-7 shrink-0 items-center justify-center rounded-md text-faint transition hover:bg-edge/5 hover:text-ink">
                <svg aria-hidden="true" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"></path></svg>
            </button>
            <span aria-hidden="true" class="admin-toast-timer absolute inset-x-0 bottom-0 h-0.5 origin-left bg-primary"></span>
        </div>
    @endif
</body>

</html>
