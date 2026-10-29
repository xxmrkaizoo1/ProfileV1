<x-admin.layout title="Admin Login">
    <div class="grid min-h-screen lg:grid-cols-[1.05fr_1fr]">
        <!-- Brand panel: identity, a short terminal snippet, and a slowly spinning wireframe globe. -->
        <aside class="relative hidden overflow-hidden border-r border-edge/10 bg-surface lg:flex lg:flex-col lg:justify-between lg:p-12">
            <div aria-hidden="true" class="pointer-events-none absolute -bottom-40 -right-40 h-[520px] w-[520px] opacity-60 [perspective:1200px]">
                <div class="wire-globe" style="--globe: 520px">
                    <span style="--r: 0deg"></span><span style="--r: 30deg"></span><span style="--r: 60deg"></span>
                    <span style="--r: 90deg"></span><span style="--r: 120deg"></span><span style="--r: 150deg"></span>
                    <span class="wire-globe-latitude"></span>
                    <span class="wire-globe-latitude" style="--z: 130px; --s: .866"></span>
                    <span class="wire-globe-latitude" style="--z: -130px; --s: .866"></span>
                </div>
            </div>

            <a href="{{ url('/') }}" class="relative font-mono text-sm font-semibold text-ink">
                <span class="text-primary">~/</span>{{ config('portfolio.handle') }}<span aria-hidden="true" class="cursor-blink text-primary">_</span>
            </a>

            <div class="relative max-w-md">
                <p class="font-mono text-xs uppercase tracking-[0.2em] text-primary">Admin console</p>
                <h2 class="mt-4 text-4xl font-semibold tracking-tight text-ink">Manage your portfolio in one place.</h2>
                <p class="mt-4 text-base leading-7 text-muted">Update your portrait, services, projects and portfolio cards. Changes go live on the homepage instantly.</p>

                <div aria-hidden="true" class="mt-10 overflow-hidden rounded-2xl border border-edge/10 bg-canvas/70 backdrop-blur-sm">
                    <div class="flex items-center gap-2 border-b border-edge/10 px-4 py-3">
                        <span class="h-2.5 w-2.5 rounded-full bg-edge/20"></span>
                        <span class="h-2.5 w-2.5 rounded-full bg-edge/20"></span>
                        <span class="h-2.5 w-2.5 rounded-full bg-edge/20"></span>
                        <span class="ml-2 font-mono text-xs text-faint">admin@portfolio: ~</span>
                    </div>
                    <div class="space-y-1 p-5 font-mono text-[13px] leading-6">
                        <p class="text-ink"><span class="text-primary">$ </span>php artisan admin:create</p>
                        <p class="text-muted">✓ administrator account ready</p>
                        <p class="text-ink"><span class="text-primary">$ </span>open /admin</p>
                        <p class="text-muted">waiting for sign in<span class="terminal-caret"></span></p>
                    </div>
                </div>
            </div>

            <p class="relative font-mono text-xs text-faint">&copy; {{ now()->year }} {{ config('portfolio.name') }}</p>
        </aside>

        <!-- Sign-in form. -->
        <main class="relative flex flex-col px-6 py-6 sm:px-10">
            <div class="flex items-center justify-between gap-4">
                <a href="{{ url('/') }}" class="group inline-flex items-center gap-2 text-sm text-muted transition hover:text-ink">
                    <span aria-hidden="true" class="transition group-hover:-translate-x-0.5">←</span>
                    Back to portfolio
                </a>
                @include('partials.theme-toggle')
            </div>

            <div class="flex flex-1 items-center justify-center py-12">
                <div class="intro-rise w-full max-w-sm">
                    <span aria-hidden="true" class="flex h-12 w-12 items-center justify-center rounded-xl border border-primary/30 bg-primary/10 text-primary">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="10" width="16" height="11" rx="2.5"></rect><path d="M8 10V7a4 4 0 0 1 8 0v3"></path><circle cx="12" cy="15.5" r="1.3" fill="currentColor"></circle></svg>
                    </span>
                    <h1 class="mt-6 text-3xl font-semibold tracking-tight text-ink">Admin login</h1>
                    <p class="mt-2 text-sm text-muted">Sign in to manage your portfolio content.</p>

                    @if ($errors->any())
                        <div role="alert" class="admin-alert-error mt-6">
                            <svg aria-hidden="true" class="mt-0.5 h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="9"></circle><path d="M12 8v5M12 16h.01"></path></svg>
                            <span>{{ $errors->first() }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.login.store') }}" class="mt-8 space-y-5">
                        @csrf
                        <x-admin.input label="Email address" id="email" name="email" type="email" :value="old('email')" required autofocus autocomplete="username" placeholder="you@example.com" />

                        <div>
                            <label for="password" class="mb-1.5 block text-sm font-medium text-ink-soft">Password</label>
                            <div class="relative">
                                <input id="password" name="password" type="password" required autocomplete="current-password" placeholder="••••••••••••" class="admin-input pr-12">
                                <button type="button" data-password-toggle="password" aria-label="Show password" aria-pressed="false" class="absolute inset-y-0 right-0 flex w-12 items-center justify-center text-faint transition hover:text-ink focus:outline-none focus-visible:text-primary">
                                    <svg aria-hidden="true" data-password-icon="show" class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    <svg aria-hidden="true" data-password-icon="hide" class="hidden h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3l18 18M10.6 10.6a3 3 0 0 0 4.2 4.2M9.9 5.2A10.4 10.4 0 0 1 12 5c6.4 0 10 7 10 7a17 17 0 0 1-3.2 4.2M6.6 6.6C3.8 8.4 2 12 2 12s3.6 7 10 7c1.5 0 2.9-.4 4.1-1"></path></svg>
                                </button>
                            </div>
                        </div>

                        <label class="flex items-center gap-2.5 text-sm text-ink-soft">
                            <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded accent-[var(--theme-primary)]">
                            Keep me signed in
                        </label>

                        <button type="submit" data-loading-text="Signing in…" class="admin-btn admin-btn-primary w-full justify-center py-3">
                            Sign in
                            <span aria-hidden="true">→</span>
                        </button>
                    </form>

                    <p class="mt-8 text-center font-mono text-xs text-faint">Need an account? Run <span class="text-ink-soft">php artisan admin:create</span></p>
                </div>
            </div>
        </main>
    </div>
</x-admin.layout>
