<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#09090b] pt-[78px] lg:pt-[117px]">
    <header id="site-header" class="game-navbar fixed inset-x-0 top-0 z-50 isolate overflow-hidden border-t-[5px] border-b border-[#353535] border-b-white/10 bg-[#08080dcc] text-white">
        <div aria-hidden="true" class="game-navbar-scanline pointer-events-none absolute inset-0 z-0"></div>
        <div aria-hidden="true" class="game-scroll-progress fixed left-0 top-0 z-[60] h-[2px] w-full origin-left scale-x-0 bg-gradient-to-r from-cyan-400 via-blue-500 to-fuchsia-500"></div>
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
                    <li><a data-section-link href="#home" class="transition hover:text-cyan-300">Home</a></li>
                    <li><a data-section-link href="#services" class="transition hover:text-cyan-300">Services</a></li>
                    <li><a href="#projects" class="transition hover:text-white">Projects</a></li>
                    <li><a data-section-link href="#about" class="transition hover:text-cyan-300">About</a></li>
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
                    <li><a href="#services" class="transition hover:text-white">Services</a></li>
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
                <div data-scroll-reveal class="relative z-20 max-w-xl pb-10 lg:pb-0">
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

                <div data-scroll-reveal class="relative mx-auto flex h-[360px] w-full max-w-md items-end justify-center lg:absolute lg:inset-y-0 lg:right-0 lg:h-full lg:max-w-[48%]">
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

        <section id="about" class="relative overflow-hidden px-6 py-20 pb-32 text-white sm:py-24 lg:pb-48">
            <div aria-hidden="true" class="pointer-events-none absolute inset-0">
                <div class="absolute inset-x-0 top-1/2 h-px bg-white/[0.025]"></div>
                <div class="absolute inset-x-0 bottom-0 h-1/2 bg-[radial-gradient(ellipse_at_center,rgba(255,255,255,0.02),transparent_70%)]"></div>
            </div>

            <div class="relative mx-auto max-w-6xl">
                <div data-scroll-reveal class="mx-auto max-w-xl text-center">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-gray-500">About me</p>
                    <h2 class="mt-4 text-3xl font-light sm:text-4xl">
                        My <span class="font-medium text-blue-600">work process</span>
                    </h2>
                    <p class="mt-4 text-sm leading-6 text-gray-500 sm:text-base">
                        I follow a thoughtful process to turn ideas into clear, effective design.
                    </p>
                </div>

                <ol class="relative mt-16 grid grid-cols-1 justify-items-center gap-x-5 gap-y-12 sm:grid-cols-2 lg:mt-20 lg:grid-cols-6 lg:gap-y-0">
                    @foreach (['Empathize', 'Ideate', 'Qualitative test', 'Define', 'Prototype', 'Quantitative test'] as $index => $step)
                        <li data-scroll-reveal class="relative flex h-52 w-full max-w-[190px] items-center justify-center {{ $index % 2 === 1 ? 'lg:translate-y-36' : '' }}">
                            <div aria-hidden="true" class="absolute h-40 w-40 rotate-45 border border-dashed border-gray-500/50"></div>
                            <div aria-hidden="true" class="absolute h-32 w-32 rotate-45 rounded-xl border border-gray-400/35 bg-[#0c0c0f]/90 shadow-[0_0_35px_rgba(255,255,255,0.025)] transition duration-300 hover:border-blue-500/60"></div>
                            <span class="relative z-10 max-w-24 text-center text-base font-medium leading-5 text-gray-200">
                                {{ $step }}
                            </span>
                            @if ($index < 5)
                                <svg aria-hidden="true"
                                    class="absolute -right-4 hidden h-8 w-8 text-blue-600 lg:block {{ $index % 2 === 0 ? 'top-[68%]' : 'top-[18%]' }}"
                                    viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="1.6"
                                    stroke-linecap="square" stroke-linejoin="miter">
                                    @if ($index % 2 === 0)
                                        <path d="M3 3 25 25M15 25h10V15"></path>
                                    @else
                                        <path d="M3 29 25 7M15 7h10v10"></path>
                                    @endif
                                </svg>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </div>
        </section>

        <section id="services" class="relative overflow-hidden px-6 pb-24 pt-20 text-white sm:pt-24">
            <div aria-hidden="true" class="pointer-events-none absolute inset-0">
                <div class="absolute inset-x-0 top-[42%] h-px bg-white/[0.035]"></div>
                <div class="absolute inset-x-0 bottom-0 h-1/2 bg-[radial-gradient(ellipse_at_center,rgba(255,255,255,0.025),transparent_70%)]"></div>
            </div>

            <div class="relative mx-auto max-w-6xl">
                <div data-scroll-reveal class="mx-auto max-w-xl text-center">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-gray-500">Services</p>
                    <h2 class="mt-4 text-3xl font-light sm:text-4xl">
                        My <span class="font-medium text-blue-600">other services</span>
                    </h2>
                    <p class="mt-4 text-sm leading-6 text-gray-500 sm:text-base">
                        Thoughtful creative services to help your brand stand out and grow.
                    </p>
                </div>

                <div class="mt-24 grid gap-12 sm:grid-cols-2 lg:grid-cols-3 lg:gap-5">
                    @foreach ($services as $service)
                        <article data-scroll-reveal class="group relative mt-8 border border-white/[0.035] bg-[#101014]/90 px-7 pb-7 pt-14 text-center transition hover:border-blue-600/30">
                            <div class="absolute left-1/2 top-0 flex h-16 w-16 -translate-x-1/2 -translate-y-1/2 rotate-45 items-center justify-center border border-white/[0.07] bg-[#0b0b0e] transition group-hover:border-blue-600/50">
                                <div class="-rotate-45 text-gray-200">
                                    @switch($service->icon)
                                        @case('palette')
                                            <svg aria-hidden="true" class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a9 9 0 1 0 0 18h1.2a1.8 1.8 0 0 0 1.3-3.1 1.8 1.8 0 0 1 1.3-3.1H18a3 3 0 0 0 3-3c0-4.9-4-8.8-9-8.8Z"></path><circle cx="7.5" cy="11" r="1"></circle><circle cx="10" cy="7.5" r="1"></circle><circle cx="14" cy="7.5" r="1"></circle><circle cx="17" cy="11" r="1"></circle></svg>
                                            @break
                                        @case('pen-tool')
                                            <svg aria-hidden="true" class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19 7-7 3 3-7 7-3-3Z"></path><path d="m18 13-3-3 2-2a3 3 0 0 0-4.2-4.2l-2 2 3 3"></path><path d="M11 9 4 16v4h4l7-7"></path><circle cx="6" cy="18" r=".7" fill="currentColor"></circle></svg>
                                            @break
                                        @case('code')
                                            <svg aria-hidden="true" class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m8 8-4 4 4 4M16 8l4 4-4 4M14 5l-4 14"></path></svg>
                                            @break
                                        @case('megaphone')
                                            <svg aria-hidden="true" class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m3 11 18-5v12L3 13v-2Z"></path><path d="m11 15 2 6H8l-2-7M5 11v2"></path></svg>
                                            @break
                                        @case('camera')
                                            <svg aria-hidden="true" class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7h3l2-3h6l2 3h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2Z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                                            @break
                                        @default
                                            <svg aria-hidden="true" class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3 2.1 6.9L21 12l-6.9 2.1L12 21l-2.1-6.9L3 12l6.9-2.1L12 3Z"></path><path d="m19 2 .8 2.2L22 5l-2.2.8L19 8l-.8-2.2L16 5l2.2-.8L19 2Z"></path></svg>
                                    @endswitch
                                </div>
                            </div>
                            <h3 class="text-lg font-medium text-gray-200">{{ $service->title }}</h3>
                            <div class="mx-auto mt-3 flex w-8 items-center gap-1">
                                <span class="h-0.5 flex-1 bg-blue-600"></span>
                                <span class="h-0.5 flex-1 bg-purple-600"></span>
                            </div>
                            <p class="mt-5 min-h-12 text-sm leading-5 text-gray-500">{{ $service->description }}</p>
                            <a href="{{ $service->cta_url }}" class="mt-5 inline-flex items-center gap-4 rounded-full bg-[#1b1b20] px-4 py-2.5 text-xs font-medium text-gray-200 transition hover:bg-blue-600">
                                {{ $service->cta_label }}
                                <span aria-hidden="true" class="text-lg leading-none">→</span>
                            </a>
                            <div aria-hidden="true" class="pointer-events-none absolute bottom-0 left-0 h-12 w-12 opacity-30 [background:repeating-linear-gradient(45deg,#555_0_5px,transparent_5px_10px)]"></div>
                        </article>
                    @endforeach
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
