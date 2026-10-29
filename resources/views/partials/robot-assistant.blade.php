@php
    $robotProfile = [
        'name' => $profile['name'],
        'firstName' => strtok($profile['name'], ' '),
        'role' => $profile['role'],
        'bio' => $profile['bio'],
        'email' => $profile['email'],
        'openToWork' => $profile['open_to_work'],
        'repositoryCount' => count($profile['repositories']),
    ];
    $robotActions = [
        'about' => 'About Firas',
        'stack' => 'Tech stack',
        'projects' => 'Projects',
        'contact' => 'Contact',
        'theme' => 'Switch theme',
        'joke' => 'Tell a joke',
    ];
@endphp

<!-- Robot assistant: Kai, a floating helper that answers quick questions and guides visitors around the page. -->
<aside data-robot="{{ json_encode($robotProfile) }}" class="robot-assistant" aria-label="Kai, the site assistant">
    <div id="robot-panel" data-robot-panel role="dialog" aria-modal="false" aria-labelledby="robot-panel-title" class="robot-panel overflow-hidden rounded-2xl border border-edge/10 bg-surface/95 shadow-[0_24px_60px_var(--theme-shadow)] backdrop-blur-xl">
        <div class="flex items-center gap-3 border-b border-edge/10 px-4 py-3">
            <span aria-hidden="true" class="flex h-9 w-9 items-center justify-center gap-1 rounded-xl bg-[#07090c] ring-1 ring-primary/30">
                <span class="h-2.5 w-1.5 rounded-full bg-[#3ddc97]"></span>
                <span class="h-2.5 w-1.5 rounded-full bg-[#3ddc97]"></span>
            </span>
            <div class="min-w-0 flex-1">
                <p id="robot-panel-title" class="text-sm font-semibold text-ink">Kai</p>
                <p class="flex items-center gap-1.5 font-mono text-[11px] text-muted">
                    <span aria-hidden="true" class="h-1.5 w-1.5 rounded-full bg-primary"></span>
                    site assistant · online
                </p>
            </div>
            <button type="button" data-robot-close aria-label="Close assistant" class="flex h-8 w-8 items-center justify-center rounded-lg text-muted transition hover:bg-edge/5 hover:text-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-primary">
                <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"></path></svg>
            </button>
        </div>

        <div data-robot-messages aria-live="polite" class="robot-messages max-h-72 space-y-2.5 overflow-y-auto px-4 py-4 text-sm"></div>

        <div class="flex flex-wrap gap-2 border-t border-edge/10 px-4 py-3">
            @foreach ($robotActions as $action => $label)
                <button type="button" data-robot-action="{{ $action }}" class="rounded-full border border-edge/15 px-3 py-1.5 font-mono text-[11px] text-ink-soft transition hover:-translate-y-0.5 hover:border-primary/60 hover:text-primary focus:outline-none focus-visible:ring-2 focus-visible:ring-primary">
                    {{ $label }}
                </button>
            @endforeach
        </div>
    </div>

    <div data-robot-teaser class="robot-teaser flex max-w-60 items-start gap-2 rounded-2xl rounded-br-md border border-edge/10 bg-surface/95 py-3 pl-4 pr-2 text-sm shadow-[0_16px_40px_var(--theme-shadow)] backdrop-blur-xl">
        <button type="button" data-robot-teaser-open class="text-left text-ink-soft focus:outline-none">
            <span data-robot-teaser-text>Hi, I’m Kai 👋 Want a quick tour?</span>
        </button>
        <button type="button" data-robot-teaser-close aria-label="Dismiss message" class="flex h-6 w-6 shrink-0 items-center justify-center rounded-md text-faint transition hover:bg-edge/5 hover:text-ink">
            <svg aria-hidden="true" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"></path></svg>
        </button>
    </div>

    <button type="button" data-robot-toggle aria-expanded="false" aria-controls="robot-panel" aria-label="Open Kai, the site assistant" class="robot-button focus:outline-none focus-visible:ring-2 focus-visible:ring-primary">
        <span aria-hidden="true" data-robot-badge class="robot-badge"></span>
        <svg aria-hidden="true" class="robot-svg" viewBox="0 0 120 150" fill="none">
            <defs>
                <linearGradient id="robot-shell-gradient" x1="20" y1="18" x2="100" y2="122" gradientUnits="userSpaceOnUse">
                    <stop class="robot-stop-light" offset="0"></stop>
                    <stop class="robot-stop-dark" offset="1"></stop>
                </linearGradient>
                <linearGradient id="robot-jet-gradient" x1="60" y1="118" x2="60" y2="140" gradientUnits="userSpaceOnUse">
                    <stop class="robot-stop-glow" offset="0"></stop>
                    <stop class="robot-stop-glow" offset="1" stop-opacity="0"></stop>
                </linearGradient>
            </defs>

            <ellipse class="robot-shadow" cx="60" cy="145" rx="22" ry="3.5"></ellipse>

            <g class="robot-body-group">
                <path class="robot-jet" d="M51 119h18l-5 20h-8z" fill="url(#robot-jet-gradient)"></path>

                <path class="robot-line" d="M60 21V11" stroke-width="2.5" stroke-linecap="round"></path>
                <circle class="robot-antenna-light" cx="60" cy="8" r="4.5"></circle>

                <rect class="robot-shell-solid" x="11" y="40" width="11" height="22" rx="5.5"></rect>
                <rect class="robot-shell-solid" x="98" y="40" width="11" height="22" rx="5.5"></rect>
                <circle class="robot-screen-fill" cx="16.5" cy="51" r="2"></circle>
                <circle class="robot-screen-fill" cx="103.5" cy="51" r="2"></circle>

                <rect class="robot-outline" x="20" y="20" width="80" height="62" rx="26" fill="url(#robot-shell-gradient)"></rect>
                <rect class="robot-visor" x="29" y="32" width="62" height="38" rx="18"></rect>
                <rect class="robot-visor-shine" x="35" y="35.5" width="26" height="4" rx="2"></rect>

                <g data-robot-eyes class="robot-eyes">
                    <rect class="robot-eye" x="42" y="44" width="9" height="14" rx="4.5"></rect>
                    <rect class="robot-eye" x="69" y="44" width="9" height="14" rx="4.5"></rect>
                    <path class="robot-eye-happy" d="M41 54.5q5.5-7.5 11 0M68 54.5q5.5-7.5 11 0" stroke-width="3" stroke-linecap="round"></path>
                </g>

                <rect class="robot-joint" x="52" y="81" width="16" height="7" rx="3.5"></rect>

                <rect class="robot-arm robot-arm-left" x="22" y="90" width="10" height="24" rx="5"></rect>
                <rect class="robot-arm robot-arm-right" x="88" y="90" width="10" height="24" rx="5"></rect>

                <rect class="robot-outline" x="33" y="86" width="54" height="34" rx="16" fill="url(#robot-shell-gradient)"></rect>
                <circle class="robot-core" cx="60" cy="101" r="5"></circle>
                <path class="robot-seam" d="M47 112h26"></path>
            </g>
        </svg>
    </button>
</aside>
