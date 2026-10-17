<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#09090b] px-6 py-10 text-white">
    <main class="mx-auto max-w-3xl">
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
    </main>
</body>
</html>
