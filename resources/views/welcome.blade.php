@php
    $profile = config('portfolio');
    $navigation = ['about' => 'About', 'stack' => 'Stack', 'services' => 'Services', 'projects' => 'Projects', 'portfolio' => 'Portfolio', 'contact' => 'Contact'];
    $terminalSessions = [
        ['command' => 'whoami', 'output' => [strtolower($profile['name']).' — computer technology student']],
        ['command' => 'cat stack.txt', 'output' => ['laravel  php  javascript  node.js  mysql']],
        ['command' => 'ls ~/projects', 'output' => ['travel-websites  counselling-system', 'ai-chat-student  smartplant-iot']],
        ['command' => 'echo $STATUS', 'output' => [$profile['open_to_work'] ? 'open to work ✓' : 'busy building']],
    ];
    $processSteps = [
        ['title' => 'Empathize', 'description' => 'Listen closely to understand the real problem and the people behind it.'],
        ['title' => 'Define', 'description' => 'Turn insights into a clear, focused problem statement.'],
        ['title' => 'Ideate', 'description' => 'Explore several directions before committing to the strongest one.'],
        ['title' => 'Prototype', 'description' => 'Build fast, working versions to try ideas early.'],
        ['title' => 'Qualitative test', 'description' => 'Gather honest feedback through real conversations with users.'],
        ['title' => 'Quantitative test', 'description' => 'Measure results with data and refine what works.'],
    ];
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="{{ $profile['name'] }}: {{ $profile['role'] }}. {{ $profile['bio'] }}">
    <title>{{ $profile['name'] }} · Developer Portfolio</title>
    @include('partials.theme-script')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="overflow-x-hidden bg-canvas font-sans text-ink antialiased">
    <div aria-hidden="true" class="page-grid"></div>

    <!-- Header section: site navigation, theme toggle, and admin access. -->
    <header id="site-header" class="site-header fixed inset-x-0 top-0 z-50 border-b border-transparent backdrop-blur-md">
        <div aria-hidden="true" class="game-scroll-progress absolute left-0 top-0 h-px w-full origin-left scale-x-0 bg-primary"></div>

        <nav aria-label="Main navigation" class="mx-auto max-w-6xl px-6">
            <div class="flex h-16 items-center justify-between gap-6">
                <a href="#home" class="font-mono text-sm font-semibold tracking-tight text-ink" aria-label="{{ $profile['name'] }} home">
                    <span class="text-primary">~/</span>{{ $profile['handle'] }}<span aria-hidden="true" class="cursor-blink text-primary">_</span>
                </a>

                <ul class="hidden items-center gap-8 text-sm text-muted md:flex">
                    @foreach ($navigation as $sectionId => $label)
                        <li><a data-section-link href="#{{ $sectionId }}" class="nav-link transition hover:text-ink">{{ $label }}</a></li>
                    @endforeach
                </ul>

                <div class="hidden items-center gap-3 md:flex">
                    @include('partials.theme-toggle')
                    @auth
                        @if (auth()->user()->is_admin)
                            <a href="{{ route('admin.profile.edit') }}" class="rounded-lg border border-edge/15 px-3.5 py-2 text-sm text-ink-soft transition hover:border-primary/60 hover:text-ink">Admin</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="rounded-lg px-3 py-2 text-sm text-muted transition hover:text-ink">Admin Login</a>
                    @endauth
                    <a href="#contact" class="rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-on-primary transition hover:-translate-y-0.5 hover:shadow-[0_8px_24px_var(--theme-glow)]">
                        Hire me
                    </a>
                </div>

                <div class="flex items-center gap-3 md:hidden">
                    @include('partials.theme-toggle')
                    <button id="menu-btn" type="button"
                        class="inline-flex items-center gap-2 rounded-lg border border-edge/15 px-3.5 py-2 text-sm font-medium text-ink transition hover:border-primary/60 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary"
                        aria-controls="mobile-menu" aria-expanded="false">
                        <span>Menu</span>
                        <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div id="mobile-menu" class="hidden border-t border-edge/10 bg-canvas/95 py-5 md:hidden">
                <ul class="flex flex-col gap-1 text-sm text-ink-soft">
                    @foreach ($navigation as $sectionId => $label)
                        <li><a data-section-link href="#{{ $sectionId }}" class="block rounded-lg px-3 py-2 transition hover:bg-edge/5 hover:text-ink">{{ $label }}</a></li>
                    @endforeach
                    @auth
                        @if (auth()->user()->is_admin)
                            <li><a href="{{ route('admin.profile.edit') }}" class="block rounded-lg px-3 py-2 transition hover:bg-edge/5 hover:text-ink">Admin Dashboard</a></li>
                        @endif
                    @else
                        <li><a href="{{ route('login') }}" class="block rounded-lg px-3 py-2 transition hover:bg-edge/5 hover:text-ink">Admin Login</a></li>
                    @endauth
                    <li class="pt-3">
                        <a href="#contact" class="inline-flex rounded-lg bg-primary px-4 py-2.5 font-semibold text-on-primary">Hire me</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <!-- Home section: introduction, portrait, and primary calls to action. -->
        <section id="home" class="relative isolate overflow-hidden px-6 pb-24 pt-32 sm:pb-32 sm:pt-40">
            <div class="mx-auto grid max-w-6xl items-center gap-14 lg:grid-cols-[1.35fr_1fr] lg:gap-16">
                <div>
                    <p class="intro-rise font-mono text-sm text-primary" style="--i: 0">~/{{ $profile['handle'] }} $ whoami</p>

                    <h1 class="intro-rise mt-5 text-5xl font-semibold tracking-tight text-ink sm:text-7xl" style="--i: 1">
                        {{ $profile['name'] }}
                    </h1>

                    <p class="intro-rise mt-5 text-xl leading-snug text-ink-soft sm:text-2xl" style="--i: 2">
                        Computer Technology student &amp;
                        <span data-word-rotator data-words="{{ json_encode($profile['roles']) }}" class="word-rotator text-primary">{{ $profile['roles'][0] }}</span>
                    </p>

                    <p class="intro-rise mt-5 max-w-xl text-base leading-7 text-muted" style="--i: 3">{{ $profile['bio'] }}</p>

                    <div class="intro-rise mt-9 flex flex-wrap gap-3" style="--i: 4">
                        <a href="#projects" class="group inline-flex items-center gap-2 rounded-lg bg-primary px-5 py-3 text-sm font-semibold text-on-primary transition hover:-translate-y-0.5 hover:shadow-[0_10px_30px_var(--theme-glow)]">
                            View projects
                            <span aria-hidden="true" class="transition group-hover:translate-x-0.5">→</span>
                        </a>
                        <a href="{{ $profile['github_url'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 rounded-lg border border-edge/15 px-5 py-3 text-sm font-medium text-ink transition hover:-translate-y-0.5 hover:border-primary/60">
                            <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 0 0-3.16 19.49c.5.09.68-.22.68-.48v-1.7c-2.78.6-3.37-1.34-3.37-1.34-.45-1.16-1.11-1.47-1.11-1.47-.91-.62.07-.6.07-.6 1 .07 1.53 1.03 1.53 1.03.9 1.52 2.34 1.08 2.91.83.09-.65.35-1.08.63-1.33-2.22-.25-4.55-1.11-4.55-4.94 0-1.09.39-1.98 1.03-2.68-.1-.25-.45-1.27.1-2.64 0 0 .84-.27 2.75 1.02a9.6 9.6 0 0 1 5 0c1.91-1.3 2.75-1.02 2.75-1.02.55 1.37.2 2.39.1 2.64.64.7 1.03 1.59 1.03 2.68 0 3.84-2.34 4.68-4.57 4.93.36.31.68.92.68 1.85v2.75c0 .27.18.58.69.48A10 10 0 0 0 12 2Z"></path></svg>
                            GitHub
                        </a>
                        <a href="mailto:{{ $profile['email'] }}" class="inline-flex items-center gap-2 rounded-lg px-4 py-3 text-sm font-medium text-ink-soft transition hover:text-primary">
                            Email me
                        </a>
                    </div>

                    <dl class="intro-rise mt-12 grid max-w-lg grid-cols-3 gap-6 border-t border-edge/10 pt-6" style="--i: 5">
                        <div>
                            <dt class="font-mono text-xs text-faint">status</dt>
                            <dd class="mt-1.5 flex items-center gap-2 text-sm text-ink">
                                @if ($profile['open_to_work'])
                                    <span aria-hidden="true" class="relative flex h-2 w-2">
                                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-primary opacity-60"></span>
                                        <span class="relative inline-flex h-2 w-2 rounded-full bg-primary"></span>
                                    </span>
                                    Open to work
                                @else
                                    Busy building
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="font-mono text-xs text-faint">focus</dt>
                            <dd class="mt-1.5 text-sm text-ink">Backend &amp; APIs</dd>
                        </div>
                        <div>
                            <dt class="font-mono text-xs text-faint">main stack</dt>
                            <dd class="mt-1.5 text-sm text-ink">Laravel · PHP</dd>
                        </div>
                    </dl>
                </div>

                <div class="intro-rise hero-stage relative mx-auto w-full max-w-sm lg:max-w-none" style="--i: 3">
                    <div data-hero-scroll class="hero-scroll-layer">
                    <div data-tilt="9" class="relative">
                    <div aria-hidden="true" class="depth-back preserve-3d absolute inset-0">
                        <div class="wire-globe">
                            <span style="--r: 0deg"></span><span style="--r: 30deg"></span><span style="--r: 60deg"></span>
                            <span style="--r: 90deg"></span><span style="--r: 120deg"></span><span style="--r: 150deg"></span>
                            <span class="wire-globe-latitude"></span>
                            <span class="wire-globe-latitude" style="--z: 110px; --s: .866"></span>
                            <span class="wire-globe-latitude" style="--z: -110px; --s: .866"></span>
                        </div>
                    </div>
                    <div aria-hidden="true" class="absolute -inset-3 rounded-[1.75rem] border border-dashed border-edge/10"></div>
                    <figure class="group depth-1 relative aspect-[4/5] overflow-hidden rounded-2xl border border-edge/10 bg-surface shadow-[0_40px_80px_var(--theme-shadow)]">
                        @if ($heroImage)
                            <img src="{{ $heroImage }}" alt="Portrait of {{ $profile['name'] }}" class="absolute inset-0 h-full w-full object-cover object-top grayscale transition duration-700 group-hover:scale-[1.03]">
                        @else
                            <div class="flex h-full flex-col items-center justify-center px-6 text-center">
                                <div aria-hidden="true" class="mb-5 flex h-24 w-24 items-center justify-center rounded-full border border-edge/10 bg-edge/[0.04] font-mono text-2xl text-faint">FU</div>
                                <span class="font-mono text-xs uppercase tracking-[0.2em] text-muted">Your photo goes here</span>
                                <span class="mt-2 text-xs text-faint">Add your portrait from the admin panel</span>
                            </div>
                        @endif
                        <figcaption class="absolute inset-x-3 bottom-3 flex items-center justify-between rounded-xl border border-edge/10 bg-canvas/80 px-4 py-3 backdrop-blur-md">
                            <span class="font-mono text-xs text-ink">{{ '@'.$profile['handle'] }}</span>
                            <span class="font-mono text-xs text-muted">Laravel · PHP · JS</span>
                        </figcaption>
                    </figure>

                    <div aria-hidden="true" class="depth-3 preserve-3d absolute -left-6 top-[12%] sm:-left-12">
                        <div class="float-y code-chip"><span class="text-primary">$</span> php artisan serve</div>
                    </div>
                    <div aria-hidden="true" class="depth-2 preserve-3d absolute -right-4 top-[46%] sm:-right-10">
                        <div class="float-y code-chip" style="--delay: -2s"><span class="text-primary">GET</span> /api/projects <span class="text-primary">200</span></div>
                    </div>
                    <div aria-hidden="true" class="depth-3 preserve-3d absolute -left-4 bottom-[18%] sm:-left-8">
                        <div class="float-y code-chip" style="--delay: -4s"><span class="text-primary">❯</span> ollama run llama3</div>
                    </div>
                    </div>
                    </div>
                </div>
            </div>

            <div aria-hidden="true" class="hero-floor"></div>
        </section>

        <!-- About section: bio, terminal, focus areas, and current interests in a bento grid. -->
        <section id="about" class="px-6 py-20 sm:py-24">
            <div class="mx-auto max-w-6xl">
                <x-section-heading number="01" label="About" description="A quick look at who I am, what I build, and what I’m learning next.">
                    Building practical systems, <span class="text-primary">one project at a time.</span>
                </x-section-heading>

                <div class="mt-12 grid gap-4 lg:grid-cols-3">
                    <div data-scroll-reveal="flip" class="lg:col-span-2">
                    <article data-tilt="4" class="spotlight-card h-full rounded-2xl border border-edge/10 bg-surface p-7">
                        <p class="font-mono text-xs text-faint">about.md</p>
                        <div class="mt-4 space-y-4 text-base leading-7 text-ink-soft">
                            @foreach ($profile['about'] as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                        </div>
                    </article>
                    </div>

                    <div data-scroll-reveal="flip" class="lg:row-span-2">
                    <div data-tilt="6" class="h-full overflow-hidden rounded-2xl border border-edge/10 bg-surface shadow-[0_30px_60px_var(--theme-shadow)]">
                        <div class="flex items-center gap-2 border-b border-edge/10 px-4 py-3">
                            <span aria-hidden="true" class="h-2.5 w-2.5 rounded-full bg-edge/20"></span>
                            <span aria-hidden="true" class="h-2.5 w-2.5 rounded-full bg-edge/20"></span>
                            <span aria-hidden="true" class="h-2.5 w-2.5 rounded-full bg-edge/20"></span>
                            <span class="ml-2 font-mono text-xs text-faint">firas@linux: ~</span>
                        </div>
                        <div data-terminal="{{ json_encode($terminalSessions) }}" aria-label="Terminal summary" class="min-h-72 p-5 font-mono text-[13px] leading-6">
                            <div data-terminal-body class="space-y-0.5">
                                @foreach ($terminalSessions as $session)
                                    <p class="text-ink"><span class="text-primary">$ </span>{{ $session['command'] }}</p>
                                    @foreach ($session['output'] as $outputText)
                                        <p class="text-muted">{{ $outputText }}</p>
                                    @endforeach
                                @endforeach
                                <p class="text-ink"><span class="text-primary">$ </span><span aria-hidden="true" class="terminal-caret"></span></p>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div data-scroll-reveal="flip">
                    <article data-tilt="6" class="spotlight-card h-full rounded-2xl border border-edge/10 bg-surface p-7">
                        <p class="font-mono text-xs text-faint">what-i-do.txt</p>
                        <ul class="mt-4 space-y-2.5 text-sm text-ink-soft">
                            @foreach ($profile['focus'] as $focusArea)
                                <li class="flex gap-3"><span aria-hidden="true" class="font-mono text-primary">→</span>{{ $focusArea }}</li>
                            @endforeach
                        </ul>
                    </article>
                    </div>

                    <div data-scroll-reveal="flip">
                    <article data-tilt="6" class="spotlight-card h-full rounded-2xl border border-edge/10 bg-surface p-7">
                        <p class="font-mono text-xs text-faint">currently-exploring/</p>
                        <dl class="mt-4 space-y-3.5">
                            @foreach ($profile['exploring'] as $interest)
                                <div>
                                    <dt class="text-sm font-medium text-ink">{{ $interest['title'] }}</dt>
                                    <dd class="mt-0.5 text-xs leading-5 text-muted">{{ $interest['detail'] }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    </article>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stack section: technologies grouped by area. -->
        <section id="stack" class="px-6 py-20 sm:py-24">
            <div class="mx-auto max-w-6xl">
                <x-section-heading number="02" label="Stack" description="Tools I use to build, from the database up to the interface.">
                    The <span class="text-primary">tech stack</span> behind my work.
                </x-section-heading>

                @php
                    $cubeFaces = [
                        ['name' => 'Laravel', 'area' => 'framework'],
                        ['name' => 'PHP', 'area' => 'backend'],
                        ['name' => 'JavaScript', 'area' => 'frontend'],
                        ['name' => 'Node.js', 'area' => 'runtime'],
                        ['name' => 'MySQL', 'area' => 'database'],
                        ['name' => 'Linux', 'area' => 'daily os'],
                    ];
                @endphp
                <div class="mt-12 grid gap-4 lg:grid-cols-[minmax(0,340px)_1fr]">
                    <div data-scroll-reveal="flip" class="relative flex min-h-80 flex-col items-center justify-center overflow-hidden rounded-2xl border border-edge/10 bg-surface p-8">
                        <div aria-hidden="true" class="absolute inset-0 bg-[radial-gradient(circle_at_50%_45%,var(--theme-glow-soft),transparent_65%)]"></div>
                        <div class="tech-cube-scene relative">
                            <div data-tech-cube class="tech-cube" role="img" aria-label="3D cube showing Laravel, PHP, JavaScript, Node.js, MySQL and Linux">
                                @foreach ($cubeFaces as $face)
                                    <div class="tech-cube-face">
                                        <span class="text-lg font-semibold text-ink">{{ $face['name'] }}</span>
                                        <span class="font-mono text-[11px] text-primary">{{ $face['area'] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <p class="relative mt-12 font-mono text-[11px] text-faint">drag to spin ↻</p>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        @foreach ($profile['stack'] as $group => $technologies)
                            <div data-scroll-reveal="flip" class="{{ $loop->last ? 'sm:col-span-2' : '' }}">
                                <div data-tilt="5" class="spotlight-card h-full rounded-2xl border border-edge/10 bg-surface p-6">
                                    <h3 class="font-mono text-xs text-faint">{{ strtolower($group) }}/</h3>
                                    <ul class="mt-4 flex flex-wrap gap-2">
                                        @foreach ($technologies as $technology)
                                            <li class="rounded-md border border-edge/10 bg-edge/[0.03] px-2.5 py-1 font-mono text-xs text-ink-soft transition hover:-translate-y-0.5 hover:border-primary/50 hover:text-primary">{{ $technology }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-16">
                    <p data-scroll-reveal class="font-mono text-xs uppercase tracking-[0.2em] text-faint">How I work</p>
                    <ol class="mt-5 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($processSteps as $index => $step)
                            <li data-scroll-reveal="flip" class="spotlight-card group rounded-2xl border border-edge/10 bg-surface p-6">
                                <span class="font-mono text-xs text-primary">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <h3 class="mt-3 font-medium text-ink">{{ $step['title'] }}</h3>
                                <p class="mt-1.5 text-sm leading-6 text-muted">{{ $step['description'] }}</p>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </section>

        <!-- Services section: displays admin-managed service cards. -->
        <section id="services" class="px-6 py-20 sm:py-24">
            <div class="mx-auto max-w-6xl">
                <x-section-heading number="03" label="Services" description="Ways I can help bring your idea to life.">
                    What I can <span class="text-primary">build for you.</span>
                </x-section-heading>

                <div class="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse ($services as $service)
                        <div data-scroll-reveal="flip">
                        <article data-tilt="7" class="spotlight-card h-full flex flex-col rounded-2xl border border-edge/10 bg-surface p-7">
                            <div class="flex h-11 w-11 items-center justify-center rounded-lg border border-primary/25 bg-primary/10 text-primary">
                                @switch($service->icon)
                                    @case('palette')
                                        <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a9 9 0 1 0 0 18h1.2a1.8 1.8 0 0 0 1.3-3.1 1.8 1.8 0 0 1 1.3-3.1H18a3 3 0 0 0 3-3c0-4.9-4-8.8-9-8.8Z"></path><circle cx="7.5" cy="11" r="1"></circle><circle cx="10" cy="7.5" r="1"></circle><circle cx="14" cy="7.5" r="1"></circle><circle cx="17" cy="11" r="1"></circle></svg>
                                        @break
                                    @case('pen-tool')
                                        <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19 7-7 3 3-7 7-3-3Z"></path><path d="m18 13-3-3 2-2a3 3 0 0 0-4.2-4.2l-2 2 3 3"></path><path d="M11 9 4 16v4h4l7-7"></path></svg>
                                        @break
                                    @case('code')
                                        <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="m8 8-4 4 4 4M16 8l4 4-4 4M14 5l-4 14"></path></svg>
                                        @break
                                    @case('megaphone')
                                        <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="m3 11 18-5v12L3 13v-2Z"></path><path d="m11 15 2 6H8l-2-7M5 11v2"></path></svg>
                                        @break
                                    @case('camera')
                                        <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7h3l2-3h6l2 3h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2Z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                                        @break
                                    @default
                                        <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3 2.1 6.9L21 12l-6.9 2.1L12 21l-2.1-6.9L3 12l6.9-2.1L12 3Z"></path></svg>
                                @endswitch
                            </div>
                            <h3 class="mt-6 text-lg font-medium text-ink">{{ $service->title }}</h3>
                            <p class="mt-2 flex-1 text-sm leading-6 text-muted">{{ $service->description }}</p>
                            <a href="{{ $service->cta_url }}" class="group mt-6 inline-flex items-center gap-2 font-mono text-xs text-primary transition hover:text-primary-soft">
                                {{ $service->cta_label }}
                                <span aria-hidden="true" class="transition group-hover:translate-x-1">→</span>
                            </a>
                        </article>
                        </div>
                    @empty
                        <p class="rounded-2xl border border-dashed border-edge/15 px-6 py-12 text-center text-sm text-muted sm:col-span-2 lg:col-span-3">
                            Services are coming soon.
                        </p>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Projects section: admin-managed project previews plus selected GitHub repositories. -->
        <section id="projects" class="px-6 py-20 sm:py-24"
            @if ($projectsBackgroundImage)
                style="background-image: linear-gradient(180deg, var(--theme-bg), color-mix(in srgb, var(--theme-bg) 90%, transparent) 30%, color-mix(in srgb, var(--theme-bg) 90%, transparent) 70%, var(--theme-bg)), url('{{ $projectsBackgroundImage }}'); background-position: center; background-size: cover;"
            @endif>
            <div class="mx-auto max-w-6xl">
                <x-section-heading number="04" label="Projects" description="Featured work, plus what I’ve been shipping on GitHub.">
                    Things I’ve <span class="text-primary">built.</span>
                </x-section-heading>

                <div id="project-grid" class="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse ($projects as $project)
                        <div data-scroll-reveal="flip">
                        <article data-tilt="7" class="spotlight-card h-full group overflow-hidden rounded-2xl border border-edge/10 bg-surface">
                            @if ($project->url)
                                <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer" class="block focus:outline-none focus-visible:ring-2 focus-visible:ring-primary">
                            @else
                                <div>
                            @endif
                                    <div class="relative aspect-[16/10] overflow-hidden border-b border-edge/10 bg-surface-raised">
                                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($project->image_path) }}"
                                            alt="{{ $project->title }} project preview"
                                            loading="lazy"
                                            class="h-full w-full object-cover transition duration-700 group-hover:scale-[1.04]">
                                    </div>
                                    <div class="flex items-center justify-between gap-4 p-5">
                                        <div>
                                            <h3 class="font-medium text-ink">{{ $project->title }}</h3>
                                            <p class="mt-1 font-mono text-xs text-muted">{{ $project->category }}</p>
                                        </div>
                                        @if ($project->url)
                                            <span aria-hidden="true" class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-edge/15 text-sm text-ink-soft transition group-hover:border-primary group-hover:bg-primary group-hover:text-on-primary">↗</span>
                                        @endif
                                    </div>
                            @if ($project->url)
                                </a>
                            @else
                                </div>
                            @endif
                        </article>
                        </div>
                    @empty
                        <p class="rounded-2xl border border-dashed border-edge/15 px-6 py-12 text-center text-sm text-muted sm:col-span-2 lg:col-span-3">
                            New projects are on the way.
                        </p>
                    @endforelse
                </div>

                <div data-scroll-reveal="flip" class="mt-12 overflow-hidden rounded-2xl border border-edge/10 bg-surface">
                    <div class="flex items-center justify-between gap-4 border-b border-edge/10 px-6 py-4">
                        <h3 class="font-mono text-xs text-faint">github.com/{{ $profile['handle'] }}</h3>
                        <a href="{{ $profile['github_url'] }}?tab=repositories" target="_blank" rel="noopener noreferrer" class="font-mono text-xs text-primary transition hover:text-primary-soft">View all →</a>
                    </div>
                    <ul class="divide-y divide-edge/10">
                        @foreach ($profile['repositories'] as $repository)
                            <li>
                                <a href="{{ $profile['github_url'] }}/{{ $repository['name'] }}" target="_blank" rel="noopener noreferrer" class="group flex items-center justify-between gap-4 px-6 py-4 transition hover:bg-surface-raised">
                                    <div class="min-w-0">
                                        <p class="truncate font-mono text-sm text-ink transition group-hover:text-primary">{{ $repository['name'] }}</p>
                                        <p class="mt-0.5 truncate text-sm text-muted">{{ $repository['description'] }}</p>
                                    </div>
                                    <div class="flex shrink-0 items-center gap-4">
                                        <span class="hidden rounded-md border border-edge/10 px-2 py-0.5 font-mono text-xs text-muted sm:inline">{{ $repository['language'] }}</span>
                                        <span aria-hidden="true" class="text-faint transition group-hover:translate-x-0.5 group-hover:text-primary">↗</span>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

        <!-- Portfolio section: displays admin-managed work, descriptions, and tools. -->
        <section id="portfolio" class="px-6 py-20 sm:py-24">
            <div class="mx-auto max-w-6xl">
                <x-section-heading number="05" label="Portfolio" description="A closer look at selected pieces and the tools behind them.">
                    Selected <span class="text-primary">work.</span>
                </x-section-heading>

                <div class="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse ($portfolios as $portfolio)
                        <div data-scroll-reveal="flip">
                        <article data-tilt="7" class="spotlight-card h-full group overflow-hidden rounded-2xl border border-edge/10 bg-surface">
                            @if ($portfolio->url)
                                <a href="{{ $portfolio->url }}" target="_blank" rel="noopener noreferrer" class="block h-full focus:outline-none focus-visible:ring-2 focus-visible:ring-primary">
                            @else
                                <div class="h-full">
                            @endif
                                    <div class="relative aspect-[16/10] overflow-hidden border-b border-edge/10 bg-surface-raised">
                                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($portfolio->image_path) }}"
                                            alt="{{ $portfolio->title }} portfolio preview"
                                            loading="lazy"
                                            class="h-full w-full object-cover transition duration-700 group-hover:scale-[1.04]">
                                    </div>
                                    <div class="p-5">
                                        <p class="font-mono text-xs text-primary">{{ $portfolio->category }}</p>
                                        <div class="mt-2 flex items-start justify-between gap-4">
                                            <h3 class="font-medium text-ink">{{ $portfolio->title }}</h3>
                                            @if ($portfolio->url)
                                                <span aria-hidden="true" class="shrink-0 text-faint transition group-hover:text-primary">↗</span>
                                            @endif
                                        </div>
                                        <p class="mt-2 text-sm leading-6 text-muted">{{ $portfolio->description }}</p>
                                        <div class="mt-4 flex flex-wrap gap-2">
                                            @foreach (array_filter(array_map('trim', explode(',', $portfolio->tools))) as $tool)
                                                <span class="rounded-md border border-edge/10 bg-edge/[0.03] px-2 py-0.5 font-mono text-xs text-ink-soft">{{ $tool }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                            @if ($portfolio->url)
                                </a>
                            @else
                                </div>
                            @endif
                        </article>
                        </div>
                    @empty
                        <p class="rounded-2xl border border-dashed border-edge/15 px-6 py-12 text-center text-sm text-muted sm:col-span-2 lg:col-span-3">
                            Portfolio pieces are coming soon.
                        </p>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Contact section: direct email and GitHub links. -->
        <section id="contact" aria-labelledby="contact-heading" class="px-6 py-20 sm:py-28">
            <div data-scroll-reveal="flip" class="mx-auto max-w-6xl">
            <div data-tilt="3" class="spotlight-card relative grid gap-10 overflow-hidden rounded-3xl border border-edge/10 bg-surface p-8 sm:p-12 lg:grid-cols-[1.2fr_1fr] lg:items-center">
                <div aria-hidden="true" class="orbit-scene pointer-events-none absolute -right-24 -top-24 h-80 w-80 opacity-70">
                    <span class="orbit-ring" style="--orbit-tilt: 68deg; --orbit-speed: 14s"></span>
                    <span class="orbit-ring" style="--orbit-tilt: 76deg; --orbit-speed: 22s; inset: 14%"></span>
                    <span class="orbit-ring" style="--orbit-tilt: 60deg; --orbit-speed: 30s; inset: 28%"></span>
                </div>
                <div class="relative">
                    <p class="font-mono text-xs uppercase tracking-[0.2em] text-primary">06 / Contact</p>
                    <h2 id="contact-heading" class="mt-3 text-3xl font-semibold tracking-tight text-ink sm:text-5xl">
                        Let’s build something <span class="text-primary">useful.</span>
                    </h2>
                    <p class="mt-4 max-w-md text-base leading-7 text-muted">
                        Have a project, internship, or idea in mind? I’d love to hear about it.
                    </p>
                </div>

                <div class="relative space-y-3">
                    <a href="mailto:{{ $profile['email'] }}?subject=Project%20inquiry" class="group flex items-center justify-between gap-4 rounded-xl border border-edge/10 bg-canvas px-5 py-4 transition hover:border-primary/50">
                        <span>
                            <span class="block font-mono text-xs text-faint">email</span>
                            <span class="mt-0.5 block break-all text-sm text-ink">{{ $profile['email'] }}</span>
                        </span>
                        <span aria-hidden="true" class="text-faint transition group-hover:translate-x-0.5 group-hover:text-primary">→</span>
                    </a>
                    <a href="{{ $profile['github_url'] }}" target="_blank" rel="noopener noreferrer" class="group flex items-center justify-between gap-4 rounded-xl border border-edge/10 bg-canvas px-5 py-4 transition hover:border-primary/50">
                        <span>
                            <span class="block font-mono text-xs text-faint">github</span>
                            <span class="mt-0.5 block text-sm text-ink">{{ '@'.$profile['handle'] }}</span>
                        </span>
                        <span aria-hidden="true" class="text-faint transition group-hover:translate-x-0.5 group-hover:text-primary">↗</span>
                    </a>
                </div>
            </div>
            </div>
        </section>
    </main>

    <!-- Footer section: copyright and quick links. -->
    <footer class="border-t border-edge/10 px-6 py-8">
        <div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-4 text-xs text-faint sm:flex-row">
            <p class="font-mono">&copy; {{ now()->year }} {{ $profile['name'] }} · built with Laravel</p>
            <div class="flex items-center gap-5">
                <a href="{{ $profile['github_url'] }}" target="_blank" rel="noopener noreferrer" class="transition hover:text-primary">GitHub</a>
                <a href="mailto:{{ $profile['email'] }}" class="transition hover:text-primary">Email</a>
                <a href="#home" class="transition hover:text-primary">Back to top ↑</a>
            </div>
        </div>
    </footer>

    @include('partials.robot-assistant')
</body>

</html>
