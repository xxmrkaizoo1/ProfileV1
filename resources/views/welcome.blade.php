<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#09090b]">
    <header class="relative isolate overflow-hidden border-t-[5px] border-b border-[#353535] border-b-white/10 bg-black/25 text-white">
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 z-0" style="background: radial-gradient(ellipse 18% 90% at 23% 18%, rgba(76, 38, 220, .58), transparent 100%), radial-gradient(ellipse 15% 85% at 55% 18%, rgba(89, 35, 210, .42), transparent 100%);"></div>

        <div class="relative z-10 mx-auto hidden h-11 max-w-6xl items-center justify-between px-6 lg:flex">
            <div class="flex items-center gap-3" aria-label="Social media">
                <a href="#contact" aria-label="LinkedIn"
                    class="flex h-7 w-7 items-center justify-center rounded-full bg-white/[0.04] text-sm font-bold text-gray-300 transition hover:bg-blue-600 hover:text-white">in</a>
                <a href="#contact" aria-label="Facebook"
                    class="flex h-7 w-7 items-center justify-center rounded-full bg-white/[0.04] text-sm font-bold text-gray-300 transition hover:bg-blue-600 hover:text-white">f</a>
                <a href="#contact" aria-label="Tumblr"
                    class="flex h-7 w-7 items-center justify-center rounded-full bg-white/[0.04] text-sm font-bold text-gray-300 transition hover:bg-blue-600 hover:text-white">t</a>
                <a href="#contact" aria-label="YouTube"
                    class="flex h-7 w-7 items-center justify-center rounded-full bg-white/[0.04] text-gray-300 transition hover:bg-blue-600 hover:text-white">
                    <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.8">
                        <rect x="3" y="6" width="18" height="12" rx="3"></rect>
                        <path stroke-linecap="round" stroke-linejoin="round" d="m10 9 5 3-5 3z"></path>
                    </svg>
                </a>
            </div>

            <div class="flex items-center gap-8 text-sm text-[#858589]">
                <a href="tel:+223456789" class="flex items-center gap-3 transition hover:text-white">
                    <svg aria-hidden="true" class="h-4 w-4 fill-current" viewBox="0 0 24 24">
                        <path
                            d="M6.6 10.8a15.5 15.5 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.2 11.4 11.4 0 0 0 3.6.6 1 1 0 0 1 1 1v3.5a1 1 0 0 1-1 1A18 18 0 0 1 3.7 5a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1 11.4 11.4 0 0 0 .6 3.6 1 1 0 0 1-.2 1z">
                        </path>
                    </svg>
                    <span>+223 456 789</span>
                </a>
                <a href="mailto:example@gmail.com" class="flex items-center gap-3 transition hover:text-white">
                    <svg aria-hidden="true" class="h-4 w-4 fill-current" viewBox="0 0 24 24">
                        <path d="M3 4v16l18-8z"></path>
                    </svg>
                    <span>example@gmail.com</span>
                </a>
                <span class="flex items-center gap-3">
                    <svg aria-hidden="true" class="h-4 w-4 fill-current" viewBox="0 0 24 24">
                        <path
                            d="M12 2a8 8 0 0 0-8 8c0 5.4 8 12 8 12s8-6.6 8-12a8 8 0 0 0-8-8zm0 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6z">
                        </path>
                    </svg>
                    <span>6391 Elgin St. Celina, Delaware</span>
                </span>
            </div>
        </div>

        <nav aria-label="Main navigation" class="relative z-10 mx-auto max-w-6xl px-6">
            <div class="flex h-[68px] items-center justify-between">
                <a href="#home" class="flex shrink-0 items-center gap-2.5" aria-label="Designer home">
                    <svg aria-hidden="true" class="h-6 w-6 text-blue-600" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"
                            stroke-dasharray="3 2"></circle>
                        <path d="M12 6v6l4 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path d="m7 3 2 2M17 19l2 2" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        </path>
                    </svg>
                    <span class="text-base font-bold tracking-[0.08em]">designer</span>
                </a>

                <ul class="hidden items-center gap-10 text-sm font-medium text-[#89898d] md:flex">
                    <li><a href="#home" class="transition hover:text-white">Home</a></li>
                    <li><a href="#services" class="transition hover:text-white">Service</a></li>
                    <li><a href="#projects" class="transition hover:text-white">Projects</a></li>
                    <li><a href="#about" class="transition hover:text-white">About</a></li>
                    <li><a href="#clients" class="transition hover:text-white">Client</a></li>
                    <li><a href="#contact" class="transition hover:text-white">Contact</a></li>
                </ul>

                <div class="hidden shrink-0 items-center gap-4 md:flex">
                    @auth
                        @if (auth()->user()->is_admin)
                            <a href="{{ route('admin.profile.edit') }}" class="rounded-full border border-white/15 px-4 py-2 text-sm text-gray-300 transition hover:border-blue-400 hover:text-white">Admin</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="rounded-full border border-white/15 px-4 py-2 text-sm text-gray-300 transition hover:border-blue-400 hover:text-white">Admin Login</a>
                    @endauth
                    <a href="#contact"
                        class="inline-flex rounded-full bg-gradient-to-r from-blue-600 to-purple-600 px-5 py-2.5 text-sm font-medium transition hover:brightness-110">
                        Discuss for Projects
                    </a>
                </div>

                <button id="menu-btn" type="button"
                    class="inline-flex items-center gap-2 rounded-full border border-gray-700 px-4 py-2 text-sm font-medium text-gray-200 transition hover:border-blue-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 md:hidden"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span>Menu</span>
                    <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <div id="mobile-menu" class="hidden border-t border-white/10 py-5 md:hidden">
                <ul class="flex flex-col items-center gap-4 text-sm font-medium text-gray-300">
                    <li><a href="#home" class="transition hover:text-white">Home</a></li>
                    <li><a href="#services" class="transition hover:text-white">Service</a></li>
                    <li><a href="#projects" class="transition hover:text-white">Projects</a></li>
                    <li><a href="#about" class="transition hover:text-white">About</a></li>
                    <li><a href="#clients" class="transition hover:text-white">Client</a></li>
                    <li><a href="#contact" class="transition hover:text-white">Contact</a></li>
                    @auth
                        @if (auth()->user()->is_admin)
                            <li><a href="{{ route('admin.profile.edit') }}" class="rounded-full border border-white/15 px-4 py-2 transition hover:border-blue-400 hover:text-white">Admin Dashboard</a></li>
                        @endif
                    @else
                        <li><a href="{{ route('login') }}" class="rounded-full border border-white/15 px-4 py-2 transition hover:border-blue-400 hover:text-white">Admin Login</a></li>
                    @endauth
                    <li>
                        <a href="#contact"
                            class="mt-2 inline-flex rounded-full bg-gradient-to-r from-blue-600 to-purple-600 px-5 py-2.5 font-medium text-white transition hover:brightness-110">
                            Discuss for Projects
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <section id="home" class="relative isolate min-h-[650px] overflow-hidden px-6 py-20 text-white sm:py-24">
            <div aria-hidden="true" class="pointer-events-none absolute inset-0 -z-10">
                <div class="absolute left-1/2 top-0 h-80 w-80 -translate-x-1/2 rounded-full bg-blue-950/10 blur-3xl"></div>
                <div class="absolute inset-x-0 bottom-0 h-1/2 bg-[radial-gradient(ellipse_at_center,rgba(255,255,255,0.035),transparent_70%)]"></div>
                <div class="absolute left-1/2 top-[42%] hidden h-80 w-[min(76vw,1100px)] -translate-x-1/2 border border-white/[0.035] lg:block"></div>
            </div>

            <div class="relative mx-auto grid min-h-[510px] max-w-6xl items-center lg:grid-cols-2">
                <div class="relative z-20 max-w-xl pb-10 lg:pb-0">
                    <h1 class="text-5xl font-light leading-[1.12] tracking-tight text-gray-200 sm:text-6xl">
                        This is your<br>
                        designer
                    </h1>
                    <p class="mt-2 text-5xl font-bold leading-tight tracking-tight text-blue-600 sm:text-6xl">
                        Esther Howard
                    </p>
                    <p class="mt-7 max-w-lg text-sm leading-6 text-gray-500 sm:text-base">
                        Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint.
                        Velit officia consequat duis enim velit mollit. Exercitation veniam consequat
                        sunt nostrud amet.
                    </p>

                    <div class="mt-10 flex flex-wrap items-center gap-x-7 gap-y-4">
                        <a href="#contact" class="inline-flex rounded-full bg-gradient-to-r from-blue-600 to-purple-600 px-5 py-3 text-sm font-medium text-white transition hover:brightness-110">
                            Discuss for Projects
                        </a>
                        <a href="#projects" class="text-sm font-medium text-gray-200 transition hover:text-blue-400">
                            View Portfolios
                        </a>
                        <a href="#projects" aria-label="View portfolios" class="text-3xl leading-none text-white transition hover:translate-x-1 hover:text-blue-400">
                            →
                        </a>
                    </div>
                </div>

                <div class="relative mx-auto flex h-[360px] w-full max-w-md items-end justify-center lg:absolute lg:inset-y-0 lg:right-0 lg:h-full lg:max-w-[48%]">
                    <div aria-hidden="true" class="absolute inset-x-0 bottom-0 h-[78%] border border-white/[0.035] bg-gradient-to-br from-white/[0.025] via-transparent to-white/[0.015]"></div>
                    <div class="relative z-10 flex h-[90%] w-[78%] items-center justify-center overflow-hidden border border-dashed border-white/15 bg-gradient-to-b from-white/[0.035] to-transparent text-center">
                        @if ($heroImage)
                            <img src="{{ $heroImage }}" alt="Portfolio portrait" class="absolute inset-0 h-full w-full object-cover object-top">
                            <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-t from-black/35 via-transparent to-transparent"></div>
                        @else
                            <div class="flex flex-col items-center">
                                <div aria-hidden="true" class="relative mb-5 h-28 w-28 overflow-hidden rounded-full border border-white/10 bg-gradient-to-br from-gray-600/40 to-gray-950/70">
                                    <div class="absolute bottom-[-20%] left-1/2 h-20 w-20 -translate-x-1/2 rounded-full bg-gray-400/20 blur-sm"></div>
                                </div>
                                <span class="text-xs uppercase tracking-[0.25em] text-gray-500">Your photo goes here</span>
                                <span class="mt-2 text-[11px] text-gray-600">Add your portrait when ready</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div aria-hidden="true" class="pointer-events-none absolute right-[5%] top-[8%] hidden h-14 w-14 rounded-full opacity-30 [background:repeating-linear-gradient(45deg,#737373_0_2px,transparent_2px_6px)] lg:block"></div>
                <svg aria-hidden="true" class="pointer-events-none absolute right-[4%] top-[23%] hidden h-10 w-10 text-purple-600 lg:block" viewBox="0 0 40 40" fill="currentColor">
                    <path d="M20 0C21.5 12 28 18.5 40 20 28 21.5 21.5 28 20 40 18.5 28 12 21.5 0 20 12 18.5 18.5 12 20 0Z"></path>
                </svg>

                <div class="pointer-events-none absolute bottom-[12%] right-[5%] z-20 hidden h-32 w-32 items-center justify-center rounded-full border border-purple-600 text-white lg:flex">
                    <svg aria-hidden="true" class="absolute inset-0 h-full w-full animate-[spin_24s_linear_infinite]" viewBox="0 0 100 100">
                        <defs>
                            <path id="badge-circle" d="M50,50 m-37,0 a37,37 0 1,1 74,0 a37,37 0 1,1 -74,0"></path>
                        </defs>
                        <text fill="currentColor" font-size="9" letter-spacing="3">
                            <textPath href="#badge-circle">100% SKILLED IN DESIGN • </textPath>
                        </text>
                    </svg>
                    <span class="text-3xl">✦</span>
                </div>
            </div>
        </section>
    </main>

    <script>
        const menuButton = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        menuButton.addEventListener('click', () => {
            const isExpanded = menuButton.getAttribute('aria-expanded') === 'true';
            menuButton.setAttribute('aria-expanded', String(!isExpanded));
            mobileMenu.classList.toggle('hidden', isExpanded);
        });

        mobileMenu.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                menuButton.setAttribute('aria-expanded', 'false');
            });
        });
    </script>
</body>

</html>
