@php
    $adminNavigation = [
        'overview' => ['label' => 'Overview', 'icon' => 'M4 13h6V4H4v9Zm0 7h6v-5H4v5Zm10 0h6v-9h-6v9Zm0-16v5h6V4h-6Z'],
        'hero' => ['label' => 'Hero portrait', 'icon' => 'M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm-7 8a7 7 0 0 1 14 0'],
        'background' => ['label' => 'Projects background', 'icon' => 'M4 5h16v14H4zM4 15l4-4 4 4 3-3 5 5'],
        'services' => ['label' => 'Services', 'icon' => 'm12 3 2.1 6.9L21 12l-6.9 2.1L12 21l-2.1-6.9L3 12l6.9-2.1L12 3Z'],
        'projects' => ['label' => 'Projects', 'icon' => 'M3 7h18v12H3zM8 7V5h8v2'],
        'portfolio' => ['label' => 'Portfolio', 'icon' => 'M4 4h7v7H4zM13 4h7v7h-7zM4 13h7v7H4zM13 13h7v7h-7z'],
    ];
    $stats = [
        ['label' => 'Service cards', 'value' => $services->count(), 'target' => 'services'],
        ['label' => 'Projects', 'value' => $projects->count(), 'target' => 'projects'],
        ['label' => 'Portfolio cards', 'value' => $portfolios->count(), 'target' => 'portfolio'],
        ['label' => 'Hero portrait', 'value' => $heroImage ? 'Live' : 'Missing', 'target' => 'hero'],
    ];
    $storage = \Illuminate\Support\Facades\Storage::disk('public');
@endphp

<x-admin.layout title="Admin Dashboard">
    <div class="lg:grid lg:grid-cols-[260px_minmax(0,1fr)]">
        <!-- Sidebar navigation (desktop). -->
        <aside class="sticky top-0 hidden h-screen flex-col border-r border-edge/10 bg-surface/70 backdrop-blur-md lg:flex">
            <div class="flex h-16 items-center border-b border-edge/10 px-6">
                <a href="{{ url('/') }}" class="font-mono text-sm font-semibold text-ink">
                    <span class="text-primary">~/</span>{{ config('portfolio.handle') }}<span aria-hidden="true" class="cursor-blink text-primary">_</span>
                </a>
            </div>

            <nav aria-label="Dashboard sections" class="flex-1 space-y-1 overflow-y-auto px-3 py-6">
                <p class="px-3 pb-2 font-mono text-[11px] uppercase tracking-[0.2em] text-faint">Content</p>
                @foreach ($adminNavigation as $sectionId => $item)
                    <a data-section-link href="#{{ $sectionId }}" class="admin-nav-link">
                        <svg aria-hidden="true" class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $item['icon'] }}"></path></svg>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="border-t border-edge/10 p-4">
                <div class="flex items-center gap-3 rounded-xl border border-edge/10 bg-canvas/60 p-3">
                    <span aria-hidden="true" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-primary/15 font-mono text-sm font-semibold text-primary">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </span>
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-sm font-medium text-ink">{{ auth()->user()->name }}</p>
                        <p class="truncate text-xs text-muted">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <div class="min-w-0">
            <!-- Top bar: page title, quick links, theme toggle, and sign out. -->
            <header class="sticky top-0 z-40 border-b border-edge/10 bg-canvas/80 backdrop-blur-md">
                <div class="flex h-16 items-center justify-between gap-4 px-6">
                    <div class="flex min-w-0 items-center gap-3">
                        <a href="{{ url('/') }}" class="font-mono text-sm font-semibold text-ink lg:hidden"><span class="text-primary">~/</span>admin</a>
                        <span aria-hidden="true" class="hidden h-4 w-px bg-edge/15 sm:block lg:hidden"></span>
                        <p class="hidden truncate text-sm text-muted sm:block">Portfolio settings</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ url('/') }}" target="_blank" rel="noopener" class="admin-btn admin-btn-secondary hidden sm:inline-flex">
                            View site
                            <span aria-hidden="true">↗</span>
                        </a>
                        @include('partials.theme-toggle')
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="admin-btn admin-btn-secondary">
                                <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15 4h3a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-3M10 17l5-5-5-5M15 12H3"></path></svg>
                                <span class="hidden sm:inline">Sign out</span>
                            </button>
                        </form>
                    </div>
                </div>

                <nav aria-label="Dashboard sections" class="flex gap-1 overflow-x-auto border-t border-edge/10 px-4 py-2 lg:hidden">
                    @foreach ($adminNavigation as $sectionId => $item)
                        <a data-section-link href="#{{ $sectionId }}" class="admin-nav-link shrink-0 whitespace-nowrap">{{ $item['label'] }}</a>
                    @endforeach
                </nav>
            </header>

            <main class="mx-auto max-w-5xl space-y-8 px-6 py-10">
                <!-- Overview: greeting and content counts. -->
                <section id="overview" class="scroll-mt-28">
                    <p class="intro-rise font-mono text-xs text-primary" style="--i: 0">~/admin $ status</p>
                    <h1 class="intro-rise mt-2 text-3xl font-semibold tracking-tight text-ink sm:text-4xl" style="--i: 1">Portfolio settings</h1>
                    <p class="intro-rise mt-2 text-sm text-muted" style="--i: 2">Welcome back, {{ strtok(auth()->user()->name, ' ') }}. Everything you change here goes live on the homepage.</p>

                    <div class="mt-8 grid grid-cols-2 gap-4 lg:grid-cols-4">
                        @foreach ($stats as $stat)
                            <div class="intro-rise" style="--i: {{ $loop->index + 3 }}">
                                <a href="#{{ $stat['target'] }}" data-tilt="8" class="spotlight-card group block h-full rounded-2xl border border-edge/10 bg-surface p-5">
                                    <p class="font-mono text-xs text-faint">{{ strtolower($stat['label']) }}</p>
                                    <p class="mt-3 text-3xl font-semibold tracking-tight {{ $stat['value'] === 'Missing' ? 'text-faint' : 'text-ink' }}">{{ $stat['value'] }}</p>
                                    <p class="mt-3 font-mono text-[11px] text-primary opacity-0 transition group-hover:opacity-100">manage →</p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </section>

                @if ($errors->any())
                    <div role="alert" class="admin-alert-error">
                        <svg aria-hidden="true" class="mt-0.5 h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="9"></circle><path d="M12 8v5M12 16h.01"></path></svg>
                        <div>
                            <p class="font-medium">Please fix the following:</p>
                            <ul class="mt-1 list-disc space-y-0.5 pl-4">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Hero portrait -->
                <x-admin.section id="hero" step="01" title="Hero portrait" description="The image shown in the home page hero. JPG, PNG, and WebP images up to 5 MB are supported.">
                    <div class="grid gap-6 md:grid-cols-[220px_1fr] md:items-start">
                        <div class="relative aspect-[4/5] overflow-hidden rounded-xl border border-edge/10 bg-canvas">
                            @if ($heroImage)
                                <img src="{{ $heroImage }}" alt="Current portfolio portrait" class="h-full w-full object-cover object-top">
                                <span class="absolute left-2 top-2 rounded-md bg-canvas/85 px-2 py-0.5 font-mono text-[10px] text-primary backdrop-blur">live</span>
                            @else
                                <div class="flex h-full flex-col items-center justify-center gap-2 text-center">
                                    <span class="font-mono text-2xl text-faint">FU</span>
                                    <span class="px-4 text-xs text-faint">No portrait yet</span>
                                </div>
                            @endif
                        </div>

                        <div class="space-y-4">
                            <form method="POST" action="{{ route('admin.profile.hero-image.update') }}" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                @method('PUT')
                                <x-admin.file label="Choose a portrait" id="hero_image" name="hero_image" hint="up to 5 MB" required />
                                <button type="submit" data-loading-text="Uploading…" class="admin-btn admin-btn-primary">Save hero image</button>
                            </form>

                            @if ($heroImage)
                                <form method="POST" action="{{ route('admin.profile.hero-image.destroy') }}" data-confirm="Remove the hero portrait from the home page?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-btn admin-btn-danger">Remove hero image</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </x-admin.section>

                <!-- Projects background -->
                <x-admin.section id="background" step="02" title="Projects section background" description="The background image behind the projects section. JPG, PNG, and WebP images up to 8 MB are supported.">
                    @if ($projectsBackgroundImage)
                        <div class="relative mb-6 overflow-hidden rounded-xl border border-edge/10">
                            <img src="{{ $projectsBackgroundImage }}" alt="Current projects section background" class="max-h-60 w-full object-cover">
                            <span class="absolute left-3 top-3 rounded-md bg-canvas/85 px-2 py-0.5 font-mono text-[10px] text-primary backdrop-blur">live</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.profile.projects-background.update') }}" enctype="multipart/form-data" class="flex flex-col gap-4 sm:flex-row sm:items-end">
                        @csrf
                        @method('PUT')
                        <div class="flex-1">
                            <x-admin.file label="Choose a background image" id="projects_background" name="projects_background" hint="up to 8 MB" required />
                        </div>
                        <button type="submit" data-loading-text="Uploading…" class="admin-btn admin-btn-primary sm:mb-1">Save background</button>
                    </form>
                </x-admin.section>

                <!-- Services -->
                <x-admin.section id="services" step="03" title="Service cards" description="Add and edit the cards in the Services section. Choose an icon from the built-in set.">
                    <x-slot:actions>
                        <span class="admin-count">{{ $services->count() }} {{ Str::plural('card', $services->count()) }}</span>
                    </x-slot:actions>

                    <div class="space-y-3">
                        @forelse ($services as $service)
                            <details class="admin-item group">
                                <summary class="admin-item-summary">
                                    <span aria-hidden="true" class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-primary/25 bg-primary/10 font-mono text-xs text-primary">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                    <span class="min-w-0 flex-1">
                                        <span class="block truncate font-medium text-ink">{{ $service->title }}</span>
                                        <span class="block truncate text-xs text-muted">{{ $serviceIcons[$service->icon] ?? $service->icon }} · {{ $service->cta_label }}</span>
                                    </span>
                                    <span class="admin-chevron" aria-hidden="true"></span>
                                </summary>

                                <div class="admin-item-body">
                                    <form id="service-form-{{ $service->id }}" method="POST" action="{{ route('admin.services.update', $service) }}" class="grid gap-4 md:grid-cols-2">
                                        @csrf
                                        @method('PUT')
                                        <x-admin.input label="Title" id="service-title-{{ $service->id }}" name="title" :value="$service->title" required maxlength="120" />
                                        <x-admin.select label="Icon" id="service-icon-{{ $service->id }}" name="icon" :options="$serviceIcons" :selected="$service->icon" required />
                                        <div class="md:col-span-2">
                                            <x-admin.textarea label="Description" id="service-description-{{ $service->id }}" name="description" :value="$service->description" required maxlength="1000" />
                                        </div>
                                        <x-admin.input label="Button text" id="service-cta-label-{{ $service->id }}" name="cta_label" :value="$service->cta_label" required maxlength="80" />
                                        <x-admin.input label="Button link" id="service-cta-url-{{ $service->id }}" name="cta_url" :value="$service->cta_url" required maxlength="2048" hint="#contact or https://..." />
                                    </form>
                                    <div class="admin-item-actions">
                                        <form method="POST" action="{{ route('admin.services.destroy', $service) }}" data-confirm="Delete this service card?">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="admin-btn admin-btn-danger">Delete</button>
                                        </form>
                                        <button type="submit" form="service-form-{{ $service->id }}" data-loading-text="Saving…" class="admin-btn admin-btn-primary">Save card</button>
                                    </div>
                                </div>
                            </details>
                        @empty
                            <p class="admin-empty">No service cards yet. Add your first card below.</p>
                        @endforelse
                    </div>

                    <div class="admin-create">
                        <h3 class="admin-create-title"><span aria-hidden="true" class="text-primary">+</span> Add a service card</h3>
                        <form method="POST" action="{{ route('admin.services.store') }}" class="mt-5 grid gap-4 md:grid-cols-2">
                            @csrf
                            <x-admin.input label="Title" id="new-service-title" name="title" :value="old('title')" required maxlength="120" />
                            <x-admin.select label="Icon" id="new-service-icon" name="icon" :options="$serviceIcons" :selected="old('icon', 'shapes')" required />
                            <div class="md:col-span-2">
                                <x-admin.textarea label="Description" id="new-service-description" name="description" :value="old('description')" required maxlength="1000" />
                            </div>
                            <x-admin.input label="Button text" id="new-service-cta-label" name="cta_label" :value="old('cta_label', 'Discuss for Projects')" required maxlength="80" />
                            <x-admin.input label="Button link" id="new-service-cta-url" name="cta_url" :value="old('cta_url', '#contact')" required maxlength="2048" hint="#contact or https://..." />
                            <div class="md:col-span-2">
                                <button type="submit" data-loading-text="Adding…" class="admin-btn admin-btn-primary">Add service card</button>
                            </div>
                        </form>
                    </div>
                </x-admin.section>

                <!-- Projects -->
                <x-admin.section id="projects" step="04" title="Completed projects" description="Project previews on the public portfolio. Project images may be JPG, PNG, or WebP up to 5 MB.">
                    <x-slot:actions>
                        <span class="admin-count">{{ $projects->count() }} {{ Str::plural('project', $projects->count()) }}</span>
                    </x-slot:actions>

                    <div class="space-y-3">
                        @forelse ($projects as $project)
                            <details class="admin-item group">
                                <summary class="admin-item-summary">
                                    <img src="{{ $storage->url($project->image_path) }}" alt="" class="h-10 w-14 shrink-0 rounded-lg border border-edge/10 object-cover">
                                    <span class="min-w-0 flex-1">
                                        <span class="block truncate font-medium text-ink">{{ $project->title }}</span>
                                        <span class="block truncate text-xs text-muted">{{ $project->category }}{{ $project->url ? ' · linked' : '' }}</span>
                                    </span>
                                    <span class="admin-chevron" aria-hidden="true"></span>
                                </summary>

                                <div class="admin-item-body">
                                    <form id="project-form-{{ $project->id }}" method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data" class="grid gap-4 md:grid-cols-2">
                                        @csrf
                                        @method('PUT')
                                        <x-admin.input label="Title" id="project-title-{{ $project->id }}" name="title" :value="$project->title" required maxlength="120" />
                                        <x-admin.input label="Category" id="project-category-{{ $project->id }}" name="category" :value="$project->category" required maxlength="80" />
                                        <x-admin.input label="Project link (optional)" id="project-url-{{ $project->id }}" name="url" type="url" :value="$project->url" maxlength="2048" placeholder="https://" />
                                        <x-admin.file label="Replace preview image (optional)" id="project-image-{{ $project->id }}" name="image" hint="up to 5 MB" />
                                    </form>
                                    <div class="admin-item-actions">
                                        <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" data-confirm="Delete this project?">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="admin-btn admin-btn-danger">Delete</button>
                                        </form>
                                        <button type="submit" form="project-form-{{ $project->id }}" data-loading-text="Saving…" class="admin-btn admin-btn-primary">Save project</button>
                                    </div>
                                </div>
                            </details>
                        @empty
                            <p class="admin-empty">No projects yet. Add your first project below.</p>
                        @endforelse
                    </div>

                    <div class="admin-create">
                        <h3 class="admin-create-title"><span aria-hidden="true" class="text-primary">+</span> Add a project</h3>
                        <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" class="mt-5 grid gap-4 md:grid-cols-2">
                            @csrf
                            <x-admin.input label="Title" id="new-project-title" name="title" :value="old('title')" required maxlength="120" />
                            <x-admin.input label="Category" id="new-project-category" name="category" :value="old('category', 'Portfolio')" required maxlength="80" />
                            <x-admin.input label="Project link (optional)" id="new-project-url" name="url" type="url" :value="old('url')" maxlength="2048" placeholder="https://" />
                            <x-admin.file label="Preview image" id="new-project-image" name="image" hint="up to 5 MB" required />
                            <div class="md:col-span-2">
                                <button type="submit" data-loading-text="Adding…" class="admin-btn admin-btn-primary">Add project</button>
                            </div>
                        </form>
                    </div>
                </x-admin.section>

                <!-- Portfolio -->
                <x-admin.section id="portfolio" step="05" title="Portfolio cards" description="Cards below Projects: a cover image, details, and comma-separated tools such as Figma, Laravel, or Tailwind CSS. Images may be JPG, PNG, or WebP up to 5 MB.">
                    <x-slot:actions>
                        <span class="admin-count">{{ $portfolios->count() }} {{ Str::plural('card', $portfolios->count()) }}</span>
                    </x-slot:actions>

                    <div class="space-y-3">
                        @forelse ($portfolios as $portfolio)
                            <details class="admin-item group">
                                <summary class="admin-item-summary">
                                    <img src="{{ $storage->url($portfolio->image_path) }}" alt="" class="h-10 w-14 shrink-0 rounded-lg border border-edge/10 object-cover">
                                    <span class="min-w-0 flex-1">
                                        <span class="block truncate font-medium text-ink">{{ $portfolio->title }}</span>
                                        <span class="block truncate text-xs text-muted">{{ $portfolio->category }} · {{ $portfolio->tools }}</span>
                                    </span>
                                    <span class="admin-chevron" aria-hidden="true"></span>
                                </summary>

                                <div class="admin-item-body">
                                    <form id="portfolio-form-{{ $portfolio->id }}" method="POST" action="{{ route('admin.portfolios.update', $portfolio) }}" enctype="multipart/form-data" class="grid gap-4 md:grid-cols-2">
                                        @csrf
                                        @method('PUT')
                                        <x-admin.input label="Title" id="portfolio-title-{{ $portfolio->id }}" name="title" :value="$portfolio->title" required maxlength="120" />
                                        <x-admin.input label="Category" id="portfolio-category-{{ $portfolio->id }}" name="category" :value="$portfolio->category" required maxlength="80" />
                                        <div class="md:col-span-2">
                                            <x-admin.textarea label="Description" id="portfolio-description-{{ $portfolio->id }}" name="description" :value="$portfolio->description" required maxlength="1000" />
                                        </div>
                                        <x-admin.input label="Tools (comma-separated)" id="portfolio-tools-{{ $portfolio->id }}" name="tools" :value="$portfolio->tools" required maxlength="1000" placeholder="Figma, Laravel, Tailwind CSS" />
                                        <x-admin.input label="Project link (optional)" id="portfolio-url-{{ $portfolio->id }}" name="url" type="url" :value="$portfolio->url" maxlength="2048" placeholder="https://" />
                                        <div class="md:col-span-2">
                                            <x-admin.file label="Replace image (optional)" id="portfolio-image-{{ $portfolio->id }}" name="image" hint="up to 5 MB" />
                                        </div>
                                    </form>
                                    <div class="admin-item-actions">
                                        <form method="POST" action="{{ route('admin.portfolios.destroy', $portfolio) }}" data-confirm="Delete this portfolio card?">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="admin-btn admin-btn-danger">Delete</button>
                                        </form>
                                        <button type="submit" form="portfolio-form-{{ $portfolio->id }}" data-loading-text="Saving…" class="admin-btn admin-btn-primary">Save portfolio card</button>
                                    </div>
                                </div>
                            </details>
                        @empty
                            <p class="admin-empty">No portfolio cards yet. Add your first one below.</p>
                        @endforelse
                    </div>

                    <div class="admin-create">
                        <h3 class="admin-create-title"><span aria-hidden="true" class="text-primary">+</span> Add a portfolio card</h3>
                        <form method="POST" action="{{ route('admin.portfolios.store') }}" enctype="multipart/form-data" class="mt-5 grid gap-4 md:grid-cols-2">
                            @csrf
                            <x-admin.input label="Title" id="new-portfolio-title" name="title" :value="old('title')" required maxlength="120" />
                            <x-admin.input label="Category" id="new-portfolio-category" name="category" :value="old('category')" required maxlength="80" />
                            <div class="md:col-span-2">
                                <x-admin.textarea label="Description" id="new-portfolio-description" name="description" :value="old('description')" required maxlength="1000" />
                            </div>
                            <x-admin.input label="Tools (comma-separated)" id="new-portfolio-tools" name="tools" :value="old('tools')" required maxlength="1000" placeholder="Figma, Laravel, Tailwind CSS" />
                            <x-admin.input label="Project link (optional)" id="new-portfolio-url" name="url" type="url" :value="old('url')" maxlength="2048" placeholder="https://" />
                            <div class="md:col-span-2">
                                <x-admin.file label="Cover image" id="new-portfolio-image" name="image" hint="up to 5 MB" required />
                            </div>
                            <div class="md:col-span-2">
                                <button type="submit" data-loading-text="Adding…" class="admin-btn admin-btn-primary">Add portfolio card</button>
                            </div>
                        </form>
                    </div>
                </x-admin.section>

                <p class="pb-6 text-center font-mono text-xs text-faint">signed in as {{ auth()->user()->email }}</p>
            </main>
        </div>
    </div>
</x-admin.layout>
