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
    </main>
</body>
</html>
