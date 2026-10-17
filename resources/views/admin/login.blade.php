<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen items-center justify-center bg-[#09090b] px-6 py-12 text-white">
    <main class="w-full max-w-md rounded-2xl border border-white/10 bg-white/[0.03] p-8 shadow-2xl shadow-black/30">
        <a href="{{ url('/') }}" class="text-sm text-gray-400 transition hover:text-white">&larr; Back to portfolio</a>
        <h1 class="mt-8 text-3xl font-semibold">Admin login</h1>
        <p class="mt-2 text-sm text-gray-400">Sign in to manage your portfolio image.</p>

        @if ($errors->any())
            <div role="alert" class="mt-6 rounded-lg border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-300">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.store') }}" class="mt-7 space-y-5">
            @csrf
            <div>
                <label for="email" class="mb-2 block text-sm text-gray-300">Email address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none transition placeholder:text-gray-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
            </div>
            <div>
                <label for="password" class="mb-2 block text-sm text-gray-300">Password</label>
                <input id="password" name="password" type="password" required autocomplete="current-password"
                    class="w-full rounded-lg border border-white/10 bg-black/30 px-4 py-3 text-white outline-none transition placeholder:text-gray-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
            </div>
            <button type="submit" class="w-full rounded-full bg-gradient-to-r from-blue-600 to-purple-600 px-5 py-3 text-sm font-semibold transition hover:brightness-110">
                Sign in
            </button>
        </form>
    </main>
</body>
</html>
