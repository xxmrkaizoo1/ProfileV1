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
    <!-- Header section: site navigation, contact shortcuts, and admin access. -->
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
                <a href="mailto:firasumairisgood@gmail.com" class="flex items-center gap-3 transition hover:text-white">
                    <svg aria-hidden="true" class="h-4 w-4 fill-current" viewBox="0 0 24 24">
                        <path d="M3 4v16l18-8z"></path>
                    </svg>
                    <span>firasumairisgood@gmail.com</span>
                </a>
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
                    <li><a data-section-link href="#projects" class="transition hover:text-cyan-300">Projects</a></li>
                    <li><a data-section-link href="#about" class="transition hover:text-cyan-300">About</a></li>
                    <li><a data-section-link href="#portfolio" class="transition hover:text-white">Portfolio</a></li>
                    <li><a data-section-link href="#contact" class="transition hover:text-white">Contact</a></li>
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
                    <li><a data-section-link href="#projects" class="transition hover:text-white">Projects</a></li>
                    <li><a href="#about" class="transition hover:text-white">About</a></li>
                    <li><a data-section-link href="#portfolio" class="transition hover:text-white">Portfolio</a></li>
                    <li><a data-section-link href="#contact" class="transition hover:text-white">Contact</a></li>
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
        <!-- Home section: introduction, hero portrait, and primary calls to action. -->
        <section id="home" class="relative isolate min-h-[650px] overflow-hidden px-6 py-20 text-white sm:py-24">
            <div aria-hidden="true" class="pointer-events-none absolute inset-0 -z-10">
                <div class="ambient-orb absolute left-1/2 top-0 h-80 w-80 -translate-x-1/2 rounded-full bg-blue-950/10 blur-3xl"></div>
                <div class="ambient-orb ambient-orb-delayed absolute right-[8%] top-1/3 h-56 w-56 rounded-full bg-purple-950/10 blur-3xl"></div>
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
                        <a href="#contact" class="motion-button inline-flex rounded-full bg-gradient-to-r from-blue-600 to-purple-600 px-5 py-3 text-sm font-medium text-white hover:brightness-110">
                            Discuss for Projects
                        </a>
                        <a href="#portfolio" class="text-sm font-medium text-gray-200 transition hover:text-blue-400">
                            View Portfolios
                        </a>
                        <a href="#portfolio" aria-label="View portfolios" class="text-3xl leading-none text-white transition hover:translate-x-1 hover:text-blue-400">
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

        <!-- About section: explains the design process. -->
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

                <ol class="relative mt-12 grid grid-cols-1 justify-items-center gap-x-5 gap-y-4 sm:mt-16 lg:mt-20 lg:grid-cols-6 lg:gap-y-0">
                    @foreach (['Empathize', 'Ideate', 'Qualitative test', 'Define', 'Prototype', 'Quantitative test'] as $index => $step)
                        <li data-scroll-reveal class="relative flex h-40 w-full items-center justify-center sm:h-52 sm:max-w-[190px] {{ $index % 2 === 1 ? 'lg:translate-y-36' : '' }}">
                            <div aria-hidden="true" class="absolute h-28 w-28 rotate-45 border border-dashed border-gray-500/50 sm:h-40 sm:w-40"></div>
                            <div aria-hidden="true" class="absolute h-24 w-24 rotate-45 rounded-xl border border-gray-400/35 bg-[#0c0c0f]/90 shadow-[0_0_35px_rgba(255,255,255,0.025)] transition duration-300 hover:border-blue-500/60 sm:h-32 sm:w-32"></div>
                            <span class="relative z-10 max-w-20 text-center text-sm font-medium leading-5 text-gray-200 sm:max-w-24 sm:text-base">
                                {{ $step }}
                            </span>
                            @if ($index < 5)
                                <svg aria-hidden="true" class="absolute bottom-0 left-1/2 h-5 w-5 -translate-x-1/2 text-blue-600 lg:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 3v17m0 0-6-6m6 6 6-6"></path>
                                </svg>
                            @endif
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

        <!-- Services section: displays admin-managed service cards. -->
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
                        <article data-scroll-reveal class="motion-card group relative mt-8 border border-white/[0.035] bg-[#101014]/90 px-7 pb-7 pt-14 text-center hover:border-blue-600/30">
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

        <!-- Projects section: displays admin-managed project previews. -->
        <section id="projects" class="relative isolate overflow-hidden px-6 py-24 text-white sm:py-28"
            @if ($projectsBackgroundImage)
                style="background-image: linear-gradient(180deg, rgba(7, 7, 10, .90), rgba(7, 7, 10, .82)), url('{{ $projectsBackgroundImage }}'); background-position: center; background-size: cover;"
            @else
                style="background-image: radial-gradient(ellipse at 50% 0%, rgba(36, 47, 110, .16), transparent 58%), linear-gradient(180deg, #09090b, #0b0b12 52%, #09090b);"
            @endif>
            <div aria-hidden="true" class="pointer-events-none absolute inset-0 -z-10 bg-[linear-gradient(90deg,rgba(255,255,255,.018)_1px,transparent_1px),linear-gradient(rgba(255,255,255,.018)_1px,transparent_1px)] bg-[size:64px_64px] opacity-40"></div>

            <div class="relative mx-auto max-w-6xl">
                <div data-scroll-reveal class="mx-auto max-w-xl text-center">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-gray-400">Projects</p>
                    <h2 class="mt-4 text-3xl font-light sm:text-4xl">
                        My <span class="font-medium text-blue-500">completed projects</span>
                    </h2>
                    <p class="mt-4 text-sm leading-6 text-gray-300/70 sm:text-base">
                        A selection of projects shaped through thoughtful design and creative problem-solving.
                    </p>
                </div>

                <div data-scroll-reveal class="mt-10 text-center">
                    <a href="#project-grid" class="motion-button inline-flex items-center justify-center rounded-full bg-gradient-to-r from-blue-600 to-purple-600 px-8 py-3 text-sm font-semibold text-white shadow-[0_8px_30px_rgba(79,70,229,.28)] hover:brightness-110">
                        View all Projects
                    </a>
                </div>

                <div id="project-grid" class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse ($projects as $project)
                        <article data-scroll-reveal class="motion-card group overflow-hidden border border-white/10 bg-[#111116]/80 shadow-[0_18px_55px_rgba(0,0,0,.28)] hover:border-blue-400/40">
                            @if ($project->url)
                                <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer" class="block focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-400">
                            @else
                                <div>
                            @endif
                                    <div class="relative aspect-[16/10] overflow-hidden bg-gradient-to-br from-blue-950 via-[#151522] to-purple-950">
                                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($project->image_path) }}"
                                            alt="{{ $project->title }} project preview"
                                            loading="lazy"
                                            class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.04]">
                                        <div aria-hidden="true" class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-white/[0.03]"></div>
                                        <span class="absolute bottom-4 left-4 rounded-full border border-white/15 bg-black/45 px-3 py-1 text-[10px] font-semibold uppercase tracking-[0.18em] text-gray-200 backdrop-blur-sm">
                                            {{ $project->category }}
                                        </span>
                                        @if ($project->url)
                                            <span aria-hidden="true" class="absolute right-4 top-4 flex h-9 w-9 items-center justify-center rounded-full border border-white/20 bg-black/40 text-white transition group-hover:border-blue-300 group-hover:bg-blue-600">↗</span>
                                        @endif
                                    </div>
                                    <div class="flex items-center justify-between gap-4 px-5 py-4">
                                        <h3 class="font-medium text-gray-100">{{ $project->title }}</h3>
                                        @if ($project->url)
                                            <span class="shrink-0 text-xs text-blue-300">View project</span>
                                        @endif
                                    </div>
                            @if ($project->url)
                                </a>
                            @else
                                </div>
                            @endif
                        </article>
                    @empty
                        <div class="rounded-2xl border border-dashed border-white/15 bg-black/25 px-6 py-12 text-center text-sm text-gray-400 sm:col-span-2 lg:col-span-3">
                            New projects are on the way.
                        </div>
                    @endforelse
                </div>

            </div>
        </section>

        <!-- Portfolio section: displays admin-managed work, descriptions, and tools. -->
        <section id="portfolio" class="relative isolate overflow-hidden px-6 py-24 text-white sm:py-28">
            <div aria-hidden="true" class="pointer-events-none absolute inset-0 -z-10 bg-[radial-gradient(ellipse_at_50%_0%,rgba(37,99,235,.12),transparent_55%),linear-gradient(180deg,#09090b,#0d0d14_50%,#09090b)]"></div>
            <div aria-hidden="true" class="pointer-events-none absolute inset-x-0 top-1/2 -z-10 h-px bg-white/[0.04]"></div>

            <div class="mx-auto max-w-6xl">
                <div data-scroll-reveal class="mx-auto max-w-xl text-center">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-gray-400">Portfolio</p>
                    <h2 class="mt-4 text-3xl font-light sm:text-4xl">
                        Thoughtful ideas, <span class="font-medium text-blue-500">made visible</span>
                    </h2>
                    <p class="mt-4 text-sm leading-6 text-gray-400 sm:text-base">
                        A closer look at the creative disciplines behind memorable brands and digital experiences.
                    </p>
                </div>

                <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse ($portfolios as $portfolio)
                        <article data-scroll-reveal class="motion-card group overflow-hidden border border-white/10 bg-[#111116]/80 shadow-[0_18px_55px_rgba(0,0,0,.28)] hover:border-blue-400/40">
                            @if ($portfolio->url)
                                <a href="{{ $portfolio->url }}" target="_blank" rel="noopener noreferrer" class="block focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-400">
                            @else
                                <div>
                            @endif
                                    <div class="relative aspect-[16/10] overflow-hidden bg-gradient-to-br from-blue-950 via-[#151522] to-purple-950">
                                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($portfolio->image_path) }}"
                                            alt="{{ $portfolio->title }} portfolio preview"
                                            loading="lazy"
                                            class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.04]">
                                        <div aria-hidden="true" class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-white/[0.03]"></div>
                                        <span class="absolute bottom-4 left-4 rounded-full border border-white/15 bg-black/45 px-3 py-1 text-[10px] font-semibold uppercase tracking-[0.18em] text-gray-200 backdrop-blur-sm">
                                            {{ $portfolio->category }}
                                        </span>
                                    </div>
                                    <div class="px-5 py-5">
                                        <div class="flex items-start justify-between gap-4">
                                            <h3 class="font-medium text-gray-100">{{ $portfolio->title }}</h3>
                                            @if ($portfolio->url)
                                                <span aria-hidden="true" class="shrink-0 text-blue-300">↗</span>
                                            @endif
                                        </div>
                                        <p class="mt-3 text-sm leading-6 text-gray-400">{{ $portfolio->description }}</p>
                                        <div class="mt-4 flex flex-wrap gap-2">
                                            @foreach (array_filter(array_map('trim', explode(',', $portfolio->tools))) as $tool)
                                                <span class="rounded-full border border-white/10 bg-white/[0.04] px-2.5 py-1 text-xs text-gray-300">{{ $tool }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                            @if ($portfolio->url)
                                </a>
                            @else
                                </div>
                            @endif
                        </article>
                    @empty
                        <p class="rounded-xl border border-dashed border-white/15 px-6 py-12 text-center text-sm text-gray-400 sm:col-span-2 lg:col-span-3">
                            Portfolio pieces are coming soon.
                        </p>
                    @endforelse
                </div>
            </div>
        </section>
    </main>

    <!-- Contact section: provides direct email contact and a project inquiry link. -->
    <section id="contact" aria-labelledby="contact-heading" class="relative isolate overflow-hidden px-6 py-20 text-white sm:py-24">
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 -z-10 bg-[radial-gradient(ellipse_at_50%_45%,rgba(37,99,235,.12),transparent_58%)]"></div>
        <div aria-hidden="true" class="pointer-events-none absolute inset-x-0 top-0 -z-10 h-px bg-gradient-to-r from-transparent via-blue-400/30 to-transparent"></div>

        <div class="mx-auto max-w-6xl">
            <div data-scroll-reveal class="motion-card relative overflow-hidden border border-white/[0.08] bg-[#111116]/90 px-7 py-12 text-center shadow-[0_18px_55px_rgba(0,0,0,.28)] sm:px-12 sm:py-16">
                <div aria-hidden="true" class="pointer-events-none absolute inset-0 opacity-20 [background:linear-gradient(90deg,transparent_48%,rgba(255,255,255,.06)_49%,transparent_50%),linear-gradient(rgba(255,255,255,.04)_1px,transparent_1px)] [background-size:120px_100%,100%_36px]"></div>
                <div aria-hidden="true" class="pointer-events-none absolute inset-0 bg-gradient-to-r from-blue-950/35 via-transparent to-purple-950/35"></div>

                <div class="relative mx-auto max-w-2xl">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-cyan-300">Contact</p>
                    <h2 id="contact-heading" class="mt-4 text-3xl font-light tracking-tight sm:text-4xl">
                        Have a project <span class="font-medium text-blue-400">in mind?</span>
                    </h2>
                    <p class="mx-auto mt-4 max-w-xl text-sm leading-6 text-gray-400 sm:text-base">
                        I’d love to hear what you’re working on. Get in touch and let’s make something great together.
                    </p>
                    <a href="mailto:firasumairisgood@gmail.com" class="mt-6 inline-flex items-center gap-2 text-sm font-medium text-gray-200 transition hover:text-cyan-300">
                        <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                            <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                            <path d="m4 7 8 6 8-6"></path>
                        </svg>
                        firasumairisgood@gmail.com
                    </a>
                    <div class="mt-8">
                        <a href="mailto:firasumairisgood@gmail.com?subject=Project%20inquiry" class="motion-button inline-flex items-center justify-center gap-3 rounded-full bg-gradient-to-r from-blue-600 to-purple-600 px-8 py-3 text-sm font-semibold text-white shadow-[0_8px_28px_rgba(79,70,229,.25)] hover:brightness-110">
                            Start a conversation
                            <span aria-hidden="true" class="text-lg leading-none">→</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer section: secondary navigation, contact details, and copyright. -->
    <footer class="border-t border-white/[0.07] bg-[#08080b] px-6 pb-8 pt-10 text-white sm:pt-12">
        <div class="mx-auto max-w-6xl">
            <div class="grid gap-10 border-b border-white/[0.07] pb-9 sm:grid-cols-2 lg:grid-cols-[1.4fr_1fr_1fr]">
                <div>
                    <a href="#home" class="inline-flex items-center gap-2.5 text-base font-bold tracking-[0.08em] transition hover:text-cyan-300">
                        <svg aria-hidden="true" class="h-6 w-6 text-blue-500" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2" stroke-dasharray="3 2"></circle>
                            <path d="M12 6v6l4 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        designer
                    </a>
                    <p class="mt-4 max-w-sm text-sm leading-6 text-gray-500">Creative design and digital experiences, made with care from first idea to final detail.</p>
                </div>

                <div>
                    <h2 class="text-xs font-semibold uppercase tracking-[0.2em] text-gray-400">Explore</h2>
                    <nav aria-label="Footer navigation" class="mt-4 grid grid-cols-2 gap-x-6 gap-y-3 text-sm text-gray-500">
                        <a href="#home" class="transition hover:text-cyan-300">Home</a>
                        <a href="#services" class="transition hover:text-cyan-300">Services</a>
                        <a href="#about" class="transition hover:text-cyan-300">About</a>
                        <a href="#projects" class="transition hover:text-cyan-300">Projects</a>
                        <a href="#portfolio" class="transition hover:text-cyan-300">Portfolio</a>
                    </nav>
                </div>

                <div>
                    <h2 class="text-xs font-semibold uppercase tracking-[0.2em] text-gray-400">Get in touch</h2>
                    <a href="mailto:firasumairisgood@gmail.com" class="mt-4 inline-flex items-center gap-2 text-sm text-gray-300 transition hover:text-cyan-300">
                        <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                            <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                            <path d="m4 7 8 6 8-6"></path>
                        </svg>
                        firasumairisgood@gmail.com
                    </a>
                </div>
            </div>

            <div class="flex flex-col items-center justify-between gap-4 pt-6 text-xs text-gray-600 sm:flex-row">
                <p>&copy; {{ now()->year }} designer. All rights reserved.</p>
                <a href="#home" class="inline-flex items-center gap-2 transition hover:text-cyan-300">
                    Back to top <span aria-hidden="true">↑</span>
                </a>
            </div>
        </div>
    </footer>

    <aside class="welcome-mascot fixed bottom-4 right-4 z-40 flex max-w-[calc(100vw-2rem)] items-end gap-2 sm:bottom-6 sm:right-6 sm:gap-3" aria-label="Friendly robot welcome character">
        <div id="welcome-message" class="mb-3 max-w-44 rounded-2xl rounded-br-sm border border-cyan-300/20 bg-[#10121a]/95 px-4 py-3 text-xs leading-5 text-gray-100 shadow-[0_12px_40px_rgba(0,0,0,.5),0_0_22px_rgba(34,211,238,.08)] backdrop-blur-md transition duration-300 sm:max-w-52 sm:px-5 sm:py-4 sm:text-sm">
            <p class="font-semibold text-cyan-200">Beep boop, welcome!</p>
            <p class="mt-1 text-gray-300">I’m your friendly robot guide. Take a look around!</p>
        </div>
        <button id="welcome-mascot-toggle" type="button" aria-controls="welcome-message" aria-expanded="true" aria-label="Hide welcome message" class="group relative flex h-[104px] w-[78px] shrink-0 items-end justify-center overflow-hidden rounded-t-[2rem] border border-cyan-300/20 bg-gradient-to-b from-[#101a2b]/90 to-[#090b12]/95 shadow-[0_0_28px_rgba(37,99,235,.16)] outline-none transition hover:-translate-y-1 hover:border-cyan-300/50 focus-visible:ring-2 focus-visible:ring-cyan-300 sm:h-[132px] sm:w-[96px]">
            <svg aria-hidden="true" class="welcome-robot relative z-10 h-full w-full max-h-[126px] max-w-[94px]" viewBox="0 0 128 160" fill="none">
                <defs>
                    <linearGradient id="robot-metal" x1="25" y1="30" x2="100" y2="138" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5E7EB"></stop>
                        <stop offset=".48" stop-color="#9299A3"></stop>
                        <stop offset="1" stop-color="#555B65"></stop>
                    </linearGradient>
                    <linearGradient id="robot-panel" x1="34" y1="85" x2="94" y2="138" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#D1D5DB"></stop>
                        <stop offset="1" stop-color="#777E88"></stop>
                    </linearGradient>
                    <linearGradient id="robot-red" x1="54" y1="3" x2="72" y2="22" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#FF7777"></stop>
                        <stop offset="1" stop-color="#B91C1C"></stop>
                    </linearGradient>
                    <linearGradient id="robot-blue" x1="38" y1="101" x2="62" y2="130" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#22D3EE"></stop>
                        <stop offset="1" stop-color="#0284C7"></stop>
                    </linearGradient>
                    <radialGradient id="robot-eye" cx="0" cy="0" r="1" gradientTransform="matrix(0 9 -9 0 55 48)" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#FFF7AE"></stop>
                        <stop offset="1" stop-color="#FBBF24"></stop>
                    </radialGradient>
                </defs>

                <g class="welcome-robot-body">
                    <path d="M64 20v9" stroke="#AEB4BD" stroke-width="5" stroke-linecap="round"></path>
                    <circle cx="64" cy="13" r="9" fill="url(#robot-red)" stroke="#17191E" stroke-width="3"></circle>
                    <path d="M55 31c2-5 6-7 9-7s7 2 9 7" fill="#8B929C" stroke="#252830" stroke-width="2"></path>

                    <path d="M26 44h8v20h-8zM94 44h8v20h-8z" fill="#626973" stroke="#202329" stroke-width="3"></path>
                    <rect x="33" y="31" width="62" height="45" rx="4" fill="url(#robot-metal)" stroke="#17191E" stroke-width="3"></rect>
                    <path d="M39 37h50v4H39z" fill="#F8FAFC" fill-opacity=".25"></path>
                    <circle cx="52" cy="49" r="9" fill="#343941" stroke="#17191E" stroke-width="2"></circle>
                    <circle cx="76" cy="49" r="9" fill="#343941" stroke="#17191E" stroke-width="2"></circle>
                    <circle cx="52" cy="49" r="6.5" fill="url(#robot-eye)"></circle>
                    <circle cx="76" cy="49" r="6.5" fill="url(#robot-eye)"></circle>
                    <circle cx="50" cy="47" r="2" fill="white"></circle>
                    <circle cx="74" cy="47" r="2" fill="white"></circle>
                    <rect x="47" y="62" width="34" height="7" rx="1" fill="#17191E" stroke="#3D424A" stroke-width="2"></rect>

                    <rect x="56" y="77" width="16" height="10" rx="4" fill="url(#robot-blue)" stroke="#111827" stroke-width="2"></rect>
                    <path d="M29 89h70l9 39-17 10H37l-17-10 9-39Z" fill="url(#robot-panel)" stroke="#17191E" stroke-width="3"></path>
                    <path d="M35 94h32v25H35z" fill="#075985" stroke="#242830" stroke-width="2"></path>
                    <path d="M38 97h26v19H38z" fill="url(#robot-blue)"></path>
                    <path d="M70 94h20v25H70z" fill="#FBBF24" stroke="#242830" stroke-width="2"></path>
                    <path d="M74 97h12v19H74z" fill="#FDE68A"></path>
                    <circle cx="94" cy="100" r="6" fill="url(#robot-red)" stroke="#17191E" stroke-width="2"></circle>
                    <circle cx="94" cy="115" r="6" fill="url(#robot-eye)" stroke="#17191E" stroke-width="2"></circle>
                    <circle cx="40" cy="125" r="3" fill="#06B6D4" stroke="#17212B"></circle>
                    <circle cx="49" cy="125" r="3" fill="#06B6D4" stroke="#17212B"></circle>
                    <circle cx="58" cy="125" r="3" fill="#06B6D4" stroke="#17212B"></circle>

                    <path d="M43 138v9m14-9v9m14-9v9m14-9v9" stroke="#323740" stroke-width="2" stroke-linecap="round"></path>
                    <path d="M45 138v12h-8v-12m46 0v12h8v-12" fill="url(#robot-metal)" stroke="#17191E" stroke-width="3" stroke-linejoin="round"></path>
                    <path d="m37 149-4 7h22l-2-7-8-4-8 4Zm42 0-2 7h22l-4-7-8-4-8 4Z" fill="url(#robot-red)" stroke="#17191E" stroke-width="3" stroke-linejoin="round"></path>

                    <path d="M28 94H12v14h16m72-14h16v14h-16" fill="url(#robot-metal)" stroke="#17191E" stroke-width="3" stroke-linejoin="round"></path>
                    <path d="M10 108v8m0 0-5 5m5-5 5 5m103-13v8m0 0-5 5m5-5 5 5" stroke="#DC2626" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                    <circle cx="10" cy="108" r="4" fill="#EF4444" stroke="#17191E" stroke-width="2"></circle>
                    <circle cx="118" cy="108" r="4" fill="#EF4444" stroke="#17191E" stroke-width="2"></circle>
                </g>
            </svg>
        </button>
    </aside>

    <script>
        // Toggle the mobile navigation menu and keep its accessibility state in sync.
        const menuButton = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        menuButton.addEventListener('click', () => {
            const isExpanded = menuButton.getAttribute('aria-expanded') === 'true';
            menuButton.setAttribute('aria-expanded', String(!isExpanded));
            mobileMenu.classList.toggle('hidden', isExpanded);
        });

        // Close the mobile menu after a visitor selects any menu link.
        mobileMenu.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                menuButton.setAttribute('aria-expanded', 'false');
            });
        });

        const welcomeToggle = document.getElementById('welcome-mascot-toggle');
        const welcomeMessage = document.getElementById('welcome-message');

        // Show or hide the mascot's welcome message and update button accessibility text.
        welcomeToggle.addEventListener('click', () => {
            const isExpanded = welcomeToggle.getAttribute('aria-expanded') === 'true';
            welcomeToggle.setAttribute('aria-expanded', String(!isExpanded));
            welcomeToggle.setAttribute('aria-label', isExpanded ? 'Show welcome message' : 'Hide welcome message');
            welcomeMessage.classList.toggle('welcome-message-hidden', isExpanded);
        });
    </script>
</body>

</html>
