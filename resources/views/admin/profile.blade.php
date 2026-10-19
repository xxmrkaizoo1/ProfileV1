<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#09090b] px-6 py-10 text-white">
    <main class="mx-auto max-w-5xl">
        <div class="flex items-center justify-between gap-4">
            <div>
                <a href="{{ url('/') }}" class="text-sm text-gray-400 transition hover:text-white">&larr; View portfolio</a>
                <h1 class="mt-4 text-3xl font-semibold">Portfolio settings</h1>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="rounded-full border border-white/15 px-4 py-2 text-sm text-gray-300 transition hover:border-white/40 hover:text-white">Sign out</button>
            </form>
        </div>

        <section class="mt-8 rounded-2xl border border-white/10 bg-white/[0.03] p-6 sm:p-8">
            <h2 class="text-xl font-medium">Hero portrait</h2>
            <p class="mt-2 text-sm leading-6 text-gray-400">Upload the image shown in the home page hero. JPG, PNG, and WebP images up to 5 MB are supported.</p>

            @if (session('status'))
                <p role="status" class="mt-5 rounded-lg border border-emerald-500/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-300">
                    {{ session('status') }}
                </p>
            @endif

            @error('hero_image')
                <p role="alert" class="mt-5 rounded-lg border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-300">{{ $message }}</p>
            @enderror

            @if ($heroImage)
                <img src="{{ $heroImage }}" alt="Current portfolio portrait" class="mt-6 max-h-[28rem] w-full rounded-xl border border-white/10 object-cover object-top">
            @endif

            <form method="POST" action="{{ route('admin.profile.hero-image.update') }}" enctype="multipart/form-data" class="mt-6 space-y-5">
                @csrf
                @method('PUT')
                <div>
                    <label for="hero_image" class="mb-2 block text-sm text-gray-300">Choose a portrait</label>
                    <input id="hero_image" name="hero_image" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" required
                        class="block w-full rounded-lg border border-white/10 bg-black/30 text-sm text-gray-300 file:mr-4 file:border-0 file:bg-white/10 file:px-4 file:py-3 file:text-white hover:file:bg-white/15">
                </div>
                <button type="submit" class="rounded-full bg-gradient-to-r from-blue-600 to-purple-600 px-5 py-3 text-sm font-semibold transition hover:brightness-110">
                    Save hero image
                </button>
            </form>

            @if ($heroImage)
                <form method="POST" action="{{ route('admin.profile.hero-image.destroy') }}" onsubmit="return confirm('Remove the hero portrait from the home page?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="mt-4 rounded-full border border-red-400/30 px-5 py-3 text-sm font-semibold text-red-300 transition hover:border-red-400/60 hover:bg-red-500/10 hover:text-red-200">
                        Remove hero image
                    </button>
                </form>
            @endif
        </section>

        <section class="mt-8 rounded-2xl border border-white/10 bg-white/[0.03] p-6 sm:p-8">
            <h2 class="text-xl font-medium">Projects section background</h2>
            <p class="mt-2 text-sm leading-6 text-gray-400">Choose the background image behind the completed projects gallery. JPG, PNG, and WebP images up to 8 MB are supported.</p>

            @error('projects_background')
                <p role="alert" class="mt-5 rounded-lg border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-300">{{ $message }}</p>
            @enderror

            @if ($projectsBackgroundImage)
                <img src="{{ $projectsBackgroundImage }}" alt="Current projects section background" class="mt-6 max-h-72 w-full rounded-xl border border-white/10 object-cover">
            @endif

            <form method="POST" action="{{ route('admin.profile.projects-background.update') }}" enctype="multipart/form-data" class="mt-6 flex flex-col gap-4 sm:flex-row sm:items-end">
                @csrf
                @method('PUT')
                <div class="flex-1">
                    <label for="projects_background" class="mb-2 block text-sm text-gray-300">Choose a background image</label>
                    <input id="projects_background" name="projects_background" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" required
                        class="block w-full rounded-lg border border-white/10 bg-black/30 text-sm text-gray-300 file:mr-4 file:border-0 file:bg-white/10 file:px-4 file:py-3 file:text-white hover:file:bg-white/15">
                </div>
                <button type="submit" class="rounded-full bg-gradient-to-r from-blue-600 to-purple-600 px-5 py-3 text-sm font-semibold transition hover:brightness-110">
                    Save background
                </button>
            </form>
        </section>

        <section id="services" class="mt-8 rounded-2xl border border-white/10 bg-white/[0.03] p-6 sm:p-8">
            <div>
                <h2 class="text-xl font-medium">Service cards</h2>
                <p class="mt-2 text-sm leading-6 text-gray-400">Add and edit the cards in the Services section. Choose an icon from the built-in set.</p>
            </div>

            @if ($errors->any())
                <div role="alert" class="mt-5 rounded-lg border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-300">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="mt-6 space-y-6">
                @forelse ($services as $service)
                    <article class="rounded-xl border border-white/10 bg-black/20 p-5">
                        <div class="mb-4 flex items-center justify-between gap-4">
                            <h3 class="font-medium text-gray-200">{{ $service->title }}</h3>
                            <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Delete this service card?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-300 transition hover:text-red-200">Delete</button>
                            </form>
                        </div>
                        <form method="POST" action="{{ route('admin.services.update', $service) }}" class="grid gap-4 md:grid-cols-2">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="service-title-{{ $service->id }}" class="mb-2 block text-sm text-gray-300">Title</label>
                                <input id="service-title-{{ $service->id }}" name="title" value="{{ $service->title }}" required maxlength="120"
                                    class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-500">
                            </div>
                            <div>
                                <label for="service-icon-{{ $service->id }}" class="mb-2 block text-sm text-gray-300">Icon</label>
                                <select id="service-icon-{{ $service->id }}" name="icon" required class="w-full rounded-lg border border-white/10 bg-[#141418] px-4 py-3 text-white outline-none focus:border-blue-500">
                                    @foreach ($serviceIcons as $icon => $label)
                                        <option value="{{ $icon }}" @selected($service->icon === $icon)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label for="service-description-{{ $service->id }}" class="mb-2 block text-sm text-gray-300">Description</label>
                                <textarea id="service-description-{{ $service->id }}" name="description" rows="3" required maxlength="1000"
                                    class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-500">{{ $service->description }}</textarea>
                            </div>
                            <div>
                                <label for="service-cta-label-{{ $service->id }}" class="mb-2 block text-sm text-gray-300">Button text</label>
                                <input id="service-cta-label-{{ $service->id }}" name="cta_label" value="{{ $service->cta_label }}" required maxlength="80"
                                    class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-500">
                            </div>
                            <div>
                                <label for="service-cta-url-{{ $service->id }}" class="mb-2 block text-sm text-gray-300">Button link (#contact or https://...)</label>
                                <input id="service-cta-url-{{ $service->id }}" name="cta_url" value="{{ $service->cta_url }}" required maxlength="2048"
                                    class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-500">
                            </div>
                            <div class="md:col-span-2">
                                <button type="submit" class="rounded-full border border-white/15 px-5 py-2.5 text-sm font-medium transition hover:border-blue-400 hover:text-blue-300">Save card</button>
                            </div>
                        </form>
                    </article>
                @empty
                    <p class="rounded-xl border border-dashed border-white/15 p-5 text-sm text-gray-400">No service cards yet. Add your first card below.</p>
                @endforelse
            </div>

            <div class="mt-8 border-t border-white/10 pt-6">
                <h3 class="font-medium">Add a service card</h3>
                <form method="POST" action="{{ route('admin.services.store') }}" class="mt-4 grid gap-4 md:grid-cols-2">
                    @csrf
                    <div>
                        <label for="new-service-title" class="mb-2 block text-sm text-gray-300">Title</label>
                        <input id="new-service-title" name="title" value="{{ old('title') }}" required maxlength="120"
                            class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label for="new-service-icon" class="mb-2 block text-sm text-gray-300">Icon</label>
                        <select id="new-service-icon" name="icon" required class="w-full rounded-lg border border-white/10 bg-[#141418] px-4 py-3 text-white outline-none focus:border-blue-500">
                            @foreach ($serviceIcons as $icon => $label)
                                <option value="{{ $icon }}" @selected(old('icon', 'shapes') === $icon)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label for="new-service-description" class="mb-2 block text-sm text-gray-300">Description</label>
                        <textarea id="new-service-description" name="description" rows="3" required maxlength="1000"
                            class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-500">{{ old('description') }}</textarea>
                    </div>
                    <div>
                        <label for="new-service-cta-label" class="mb-2 block text-sm text-gray-300">Button text</label>
                        <input id="new-service-cta-label" name="cta_label" value="{{ old('cta_label', 'Discuss for Projects') }}" required maxlength="80"
                            class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label for="new-service-cta-url" class="mb-2 block text-sm text-gray-300">Button link (#contact or https://...)</label>
                        <input id="new-service-cta-url" name="cta_url" value="{{ old('cta_url', '#contact') }}" required maxlength="2048"
                            class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-500">
                    </div>
                    <div class="md:col-span-2">
                        <button type="submit" class="rounded-full bg-gradient-to-r from-blue-600 to-purple-600 px-5 py-3 text-sm font-semibold transition hover:brightness-110">Add service card</button>
                    </div>
                </form>
            </div>
        </section>

        <section id="projects" class="mt-8 rounded-2xl border border-white/10 bg-white/[0.03] p-6 sm:p-8">
            <div>
                <h2 class="text-xl font-medium">Completed projects</h2>
                <p class="mt-2 text-sm leading-6 text-gray-400">Add project previews to the public portfolio. Project images may be JPG, PNG, or WebP up to 5 MB.</p>
            </div>

            @error('title')
                <p role="alert" class="mt-5 rounded-lg border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-300">{{ $message }}</p>
            @enderror
            @error('category')
                <p role="alert" class="mt-5 rounded-lg border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-300">{{ $message }}</p>
            @enderror
            @error('url')
                <p role="alert" class="mt-5 rounded-lg border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-300">{{ $message }}</p>
            @enderror
            @error('image')
                <p role="alert" class="mt-5 rounded-lg border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-300">{{ $message }}</p>
            @enderror

            <div class="mt-6 space-y-6">
                @forelse ($projects as $project)
                    <article class="rounded-xl border border-white/10 bg-black/20 p-5">
                        <div class="mb-4 flex items-center justify-between gap-4">
                            <div class="flex min-w-0 items-center gap-4">
                                <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($project->image_path) }}" alt="" class="h-16 w-24 rounded-lg object-cover">
                                <h3 class="truncate font-medium text-gray-200">{{ $project->title }}</h3>
                            </div>
                            <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('Delete this project?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-300 transition hover:text-red-200">Delete</button>
                            </form>
                        </div>
                        <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data" class="grid gap-4 md:grid-cols-2">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="project-title-{{ $project->id }}" class="mb-2 block text-sm text-gray-300">Title</label>
                                <input id="project-title-{{ $project->id }}" name="title" value="{{ $project->title }}" required maxlength="120"
                                    class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-500">
                            </div>
                            <div>
                                <label for="project-category-{{ $project->id }}" class="mb-2 block text-sm text-gray-300">Category</label>
                                <input id="project-category-{{ $project->id }}" name="category" value="{{ $project->category }}" required maxlength="80"
                                    class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-500">
                            </div>
                            <div>
                                <label for="project-url-{{ $project->id }}" class="mb-2 block text-sm text-gray-300">Project link (optional)</label>
                                <input id="project-url-{{ $project->id }}" name="url" type="url" value="{{ $project->url }}" maxlength="2048"
                                    class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-500">
                            </div>
                            <div>
                                <label for="project-image-{{ $project->id }}" class="mb-2 block text-sm text-gray-300">Replace preview image (optional)</label>
                                <input id="project-image-{{ $project->id }}" name="image" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                    class="block w-full rounded-lg border border-white/10 bg-black/30 text-sm text-gray-300 file:mr-4 file:border-0 file:bg-white/10 file:px-4 file:py-3 file:text-white">
                            </div>
                            <div class="md:col-span-2">
                                <button type="submit" class="rounded-full border border-white/15 px-5 py-2.5 text-sm font-medium transition hover:border-blue-400 hover:text-blue-300">Save project</button>
                            </div>
                        </form>
                    </article>
                @empty
                    <p class="rounded-xl border border-dashed border-white/15 p-5 text-sm text-gray-400">No projects yet. Add your first project below.</p>
                @endforelse
            </div>

            <div class="mt-8 border-t border-white/10 pt-6">
                <h3 class="font-medium">Add a project</h3>
                <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" class="mt-4 grid gap-4 md:grid-cols-2">
                    @csrf
                    <div>
                        <label for="new-project-title" class="mb-2 block text-sm text-gray-300">Title</label>
                        <input id="new-project-title" name="title" value="{{ old('title') }}" required maxlength="120"
                            class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label for="new-project-category" class="mb-2 block text-sm text-gray-300">Category</label>
                        <input id="new-project-category" name="category" value="{{ old('category', 'Portfolio') }}" required maxlength="80"
                            class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label for="new-project-url" class="mb-2 block text-sm text-gray-300">Project link (optional)</label>
                        <input id="new-project-url" name="url" type="url" value="{{ old('url') }}" maxlength="2048"
                            class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label for="new-project-image" class="mb-2 block text-sm text-gray-300">Preview image</label>
                        <input id="new-project-image" name="image" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" required
                            class="block w-full rounded-lg border border-white/10 bg-black/30 text-sm text-gray-300 file:mr-4 file:border-0 file:bg-white/10 file:px-4 file:py-3 file:text-white">
                    </div>
                    <div class="md:col-span-2">
                        <button type="submit" class="rounded-full bg-gradient-to-r from-blue-600 to-purple-600 px-5 py-3 text-sm font-semibold transition hover:brightness-110">Add project</button>
                    </div>
                </form>
            </div>
        </section>

        <section id="portfolio" class="mt-8 rounded-2xl border border-white/10 bg-white/[0.03] p-6 sm:p-8">
            <div>
                <h2 class="text-xl font-medium">Portfolio cards</h2>
                <p class="mt-2 text-sm leading-6 text-gray-400">Manage the cards below Projects. Add a cover image, project details, and comma-separated tools such as Figma, Laravel, or Tailwind CSS. Images may be JPG, PNG, or WebP up to 5 MB.</p>
            </div>

            @if ($errors->any())
                <div role="alert" class="mt-5 rounded-lg border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-300">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="mt-6 space-y-6">
                @forelse ($portfolios as $portfolio)
                    <article class="rounded-xl border border-white/10 bg-black/20 p-5">
                        <div class="mb-4 flex items-center justify-between gap-4">
                            <div class="flex min-w-0 items-center gap-4">
                                <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($portfolio->image_path) }}" alt="" class="h-16 w-24 rounded-lg object-cover">
                                <h3 class="truncate font-medium text-gray-200">{{ $portfolio->title }}</h3>
                            </div>
                            <form method="POST" action="{{ route('admin.portfolios.destroy', $portfolio) }}" onsubmit="return confirm('Delete this portfolio card?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-300 transition hover:text-red-200">Delete</button>
                            </form>
                        </div>
                        <form method="POST" action="{{ route('admin.portfolios.update', $portfolio) }}" enctype="multipart/form-data" class="grid gap-4 md:grid-cols-2">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="portfolio-title-{{ $portfolio->id }}" class="mb-2 block text-sm text-gray-300">Title</label>
                                <input id="portfolio-title-{{ $portfolio->id }}" name="title" value="{{ $portfolio->title }}" required maxlength="120"
                                    class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-500">
                            </div>
                            <div>
                                <label for="portfolio-category-{{ $portfolio->id }}" class="mb-2 block text-sm text-gray-300">Category</label>
                                <input id="portfolio-category-{{ $portfolio->id }}" name="category" value="{{ $portfolio->category }}" required maxlength="80"
                                    class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-500">
                            </div>
                            <div class="md:col-span-2">
                                <label for="portfolio-description-{{ $portfolio->id }}" class="mb-2 block text-sm text-gray-300">Description</label>
                                <textarea id="portfolio-description-{{ $portfolio->id }}" name="description" rows="3" required maxlength="1000"
                                    class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-500">{{ $portfolio->description }}</textarea>
                            </div>
                            <div>
                                <label for="portfolio-tools-{{ $portfolio->id }}" class="mb-2 block text-sm text-gray-300">Tools (comma-separated)</label>
                                <input id="portfolio-tools-{{ $portfolio->id }}" name="tools" value="{{ $portfolio->tools }}" required maxlength="1000" placeholder="Figma, Laravel, Tailwind CSS"
                                    class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-500">
                            </div>
                            <div>
                                <label for="portfolio-url-{{ $portfolio->id }}" class="mb-2 block text-sm text-gray-300">Project link (optional)</label>
                                <input id="portfolio-url-{{ $portfolio->id }}" name="url" type="url" value="{{ $portfolio->url }}" maxlength="2048"
                                    class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-500">
                            </div>
                            <div>
                                <label for="portfolio-image-{{ $portfolio->id }}" class="mb-2 block text-sm text-gray-300">Replace image (optional)</label>
                                <input id="portfolio-image-{{ $portfolio->id }}" name="image" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                    class="block w-full rounded-lg border border-white/10 bg-black/30 text-sm text-gray-300 file:mr-4 file:border-0 file:bg-white/10 file:px-4 file:py-3 file:text-white">
                            </div>
                            <div class="md:col-span-2">
                                <button type="submit" class="rounded-full border border-white/15 px-5 py-2.5 text-sm font-medium transition hover:border-blue-400 hover:text-blue-300">Save portfolio card</button>
                            </div>
                        </form>
                    </article>
                @empty
                    <p class="rounded-xl border border-dashed border-white/15 p-5 text-sm text-gray-400">No portfolio cards yet. Add your first one below.</p>
                @endforelse
            </div>

            <div class="mt-8 border-t border-white/10 pt-6">
                <h3 class="font-medium">Add a portfolio card</h3>
                <form method="POST" action="{{ route('admin.portfolios.store') }}" enctype="multipart/form-data" class="mt-4 grid gap-4 md:grid-cols-2">
                    @csrf
                    <div>
                        <label for="new-portfolio-title" class="mb-2 block text-sm text-gray-300">Title</label>
                        <input id="new-portfolio-title" name="title" value="{{ old('title') }}" required maxlength="120"
                            class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label for="new-portfolio-category" class="mb-2 block text-sm text-gray-300">Category</label>
                        <input id="new-portfolio-category" name="category" value="{{ old('category') }}" required maxlength="80"
                            class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-500">
                    </div>
                    <div class="md:col-span-2">
                        <label for="new-portfolio-description" class="mb-2 block text-sm text-gray-300">Description</label>
                        <textarea id="new-portfolio-description" name="description" rows="3" required maxlength="1000"
                            class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-500">{{ old('description') }}</textarea>
                    </div>
                    <div>
                        <label for="new-portfolio-tools" class="mb-2 block text-sm text-gray-300">Tools (comma-separated)</label>
                        <input id="new-portfolio-tools" name="tools" value="{{ old('tools') }}" required maxlength="1000" placeholder="Figma, Laravel, Tailwind CSS"
                            class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label for="new-portfolio-url" class="mb-2 block text-sm text-gray-300">Project link (optional)</label>
                        <input id="new-portfolio-url" name="url" type="url" value="{{ old('url') }}" maxlength="2048"
                            class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label for="new-portfolio-image" class="mb-2 block text-sm text-gray-300">Cover image</label>
                        <input id="new-portfolio-image" name="image" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" required
                            class="block w-full rounded-lg border border-white/10 bg-black/30 text-sm text-gray-300 file:mr-4 file:border-0 file:bg-white/10 file:px-4 file:py-3 file:text-white">
                    </div>
                    <div class="md:col-span-2">
                        <button type="submit" class="rounded-full bg-gradient-to-r from-blue-600 to-purple-600 px-5 py-3 text-sm font-semibold transition hover:brightness-110">Add portfolio card</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
