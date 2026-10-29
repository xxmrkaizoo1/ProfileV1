import { initAdmin } from './admin';
import { initRobotAssistant } from './robot-assistant';

const header = document.querySelector('#site-header');
const progress = document.querySelector('.game-scroll-progress');
const revealItems = document.querySelectorAll('[data-scroll-reveal]');
const sectionLinks = document.querySelectorAll('[data-section-link]');
const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const finePointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;

let scrollFrame = 0;

// Update the header style and the top-of-page scroll progress indicator.
const updateScrollState = () => {
    const scrollableHeight = document.documentElement.scrollHeight - window.innerHeight;
    const scrollProgress = scrollableHeight > 0 ? window.scrollY / scrollableHeight : 0;

    header?.classList.toggle('is-scrolled', window.scrollY > 16);

    if (progress) {
        progress.style.transform = `scaleX(${scrollProgress})`;
    }

    scrollFrame = 0;
};

window.addEventListener('scroll', () => {
    if (!scrollFrame) {
        scrollFrame = window.requestAnimationFrame(updateScrollState);
    }
}, { passive: true });

updateScrollState();

// Reveal content as it enters the viewport, or show it immediately when motion is reduced.
if (reducedMotion || !('IntersectionObserver' in window)) {
    revealItems.forEach((item) => item.classList.add('is-visible'));
} else {
    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

    revealItems.forEach((item, index) => {
        item.classList.add('scroll-reveal-ready');
        item.style.transitionDelay = `${Math.min(index % 4, 3) * 80}ms`;
        revealObserver.observe(item);
    });
}

// Keep desktop and mobile section links highlighted as their sections enter view.
if ('IntersectionObserver' in window) {
    const sections = [...sectionLinks]
        .map((link) => document.querySelector(link.getAttribute('href')))
        .filter((section) => section);

    const activeSectionObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                return;
            }

            sectionLinks.forEach((link) => {
                const isActive = link.getAttribute('href') === `#${entry.target.id}`;
                link.classList.toggle('is-active', isActive);

                if (isActive) {
                    link.setAttribute('aria-current', 'location');
                } else {
                    link.removeAttribute('aria-current');
                }
            });
        });
    }, { rootMargin: '-25% 0px -60% 0px' });

    sections.forEach((section) => activeSectionObserver.observe(section));
}

// Move each card's spotlight with the pointer, and rotate [data-tilt] cards toward it in 3D.
if (finePointer && !reducedMotion) {
    document.querySelectorAll('.spotlight-card, [data-tilt]').forEach((card) => {
        const maxTilt = Number(card.dataset.tilt) || 0;
        let cardRect = null;
        let tiltFrame = 0;

        card.addEventListener('pointerenter', () => {
            cardRect = card.getBoundingClientRect();
            card.classList.add('is-tilting');
        });

        card.addEventListener('pointermove', (event) => {
            cardRect ??= card.getBoundingClientRect();
            const offsetX = event.clientX - cardRect.left;
            const offsetY = event.clientY - cardRect.top;

            window.cancelAnimationFrame(tiltFrame);
            tiltFrame = window.requestAnimationFrame(() => {
                card.style.setProperty('--mx', `${offsetX}px`);
                card.style.setProperty('--my', `${offsetY}px`);

                if (maxTilt) {
                    card.style.setProperty('--rx', `${((0.5 - offsetY / cardRect.height) * maxTilt * 2).toFixed(2)}deg`);
                    card.style.setProperty('--ry', `${((offsetX / cardRect.width - 0.5) * maxTilt * 2).toFixed(2)}deg`);
                }
            });
        });

        card.addEventListener('pointerleave', () => {
            window.cancelAnimationFrame(tiltFrame);
            cardRect = null;
            card.classList.remove('is-tilting');
            card.style.removeProperty('--rx');
            card.style.removeProperty('--ry');
        });
    });
}

// Tip the hero scene back in 3D as the visitor scrolls past it.
const heroScrollLayer = document.querySelector('[data-hero-scroll]');

if (heroScrollLayer && !reducedMotion) {
    let heroFrame = 0;

    const updateHeroScroll = () => {
        const heroProgress = Math.min(Math.max(window.scrollY / (window.innerHeight * 0.9), 0), 1);
        heroScrollLayer.style.setProperty('--hero-scroll', heroProgress.toFixed(3));
        heroFrame = 0;
    };

    window.addEventListener('scroll', () => {
        if (!heroFrame) {
            heroFrame = window.requestAnimationFrame(updateHeroScroll);
        }
    }, { passive: true });

    updateHeroScroll();
}

// Spin the 3D tech cube on its own, and let visitors drag it around with momentum.
const techCube = document.querySelector('[data-tech-cube]');

if (techCube) {
    let rotationX = -22;
    let rotationY = 35;
    let velocityX = 0;
    let velocityY = reducedMotion ? 0 : 0.18;
    let isDragging = false;
    let isVisible = false;
    let lastPointer = null;
    let cubeFrame = 0;

    const renderCube = () => {
        techCube.style.setProperty('--cube-x', `${rotationX.toFixed(2)}deg`);
        techCube.style.setProperty('--cube-y', `${rotationY.toFixed(2)}deg`);
    };

    const spinCube = () => {
        if (!isDragging) {
            rotationX += velocityX;
            rotationY += velocityY;
            velocityX *= 0.94;
            velocityY = reducedMotion ? velocityY * 0.9 : velocityY * 0.96 + 0.18 * 0.04;
            rotationX += (-22 - rotationX) * 0.02;
        }

        renderCube();
        cubeFrame = isVisible ? window.requestAnimationFrame(spinCube) : 0;
    };

    techCube.addEventListener('pointerdown', (event) => {
        isDragging = true;
        lastPointer = { x: event.clientX, y: event.clientY };
        techCube.setPointerCapture(event.pointerId);
        techCube.classList.add('is-dragging');
    });

    techCube.addEventListener('pointermove', (event) => {
        if (!isDragging) {
            return;
        }

        velocityY = (event.clientX - lastPointer.x) * 0.4;
        velocityX = -(event.clientY - lastPointer.y) * 0.4;
        rotationY += velocityY;
        rotationX = Math.min(Math.max(rotationX + velocityX, -80), 80);
        lastPointer = { x: event.clientX, y: event.clientY };
    });

    const releaseCube = () => {
        isDragging = false;
        techCube.classList.remove('is-dragging');
    };

    techCube.addEventListener('pointerup', releaseCube);
    techCube.addEventListener('pointercancel', releaseCube);

    if ('IntersectionObserver' in window) {
        new IntersectionObserver((entries) => {
            isVisible = entries.some((entry) => entry.isIntersecting);

            if (isVisible && !cubeFrame) {
                cubeFrame = window.requestAnimationFrame(spinCube);
            }
        }).observe(techCube);
    } else {
        renderCube();
    }
}

// Toggle the mobile navigation menu, and close it after a link is chosen.
const menuButton = document.getElementById('menu-btn');
const mobileMenu = document.getElementById('mobile-menu');

if (menuButton && mobileMenu) {
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
}

initRobotAssistant();
initAdmin();

// Switch between the light and dark themes, remember the choice, and reveal the new theme in a circle from the button.
const themeToggles = document.querySelectorAll('[data-theme-toggle]');

const syncThemeToggles = () => {
    const isLight = document.documentElement.dataset.theme === 'light';

    themeToggles.forEach((toggle) => {
        toggle.setAttribute('aria-label', isLight ? 'Switch to dark mode' : 'Switch to light mode');
    });
};

const applyTheme = (theme) => {
    document.documentElement.dataset.theme = theme;
    syncThemeToggles();

    try {
        localStorage.setItem('theme', theme);
    } catch (error) {
        // Storage can be unavailable (private mode); the theme still applies for this visit.
    }
};

themeToggles.forEach((toggle) => {
    toggle.addEventListener('click', (event) => {
        const nextTheme = document.documentElement.dataset.theme === 'light' ? 'dark' : 'light';

        if (reducedMotion || !document.startViewTransition) {
            applyTheme(nextTheme);

            return;
        }

        const toggleRect = toggle.getBoundingClientRect();
        const originX = event.clientX || toggleRect.left + toggleRect.width / 2;
        const originY = event.clientY || toggleRect.top + toggleRect.height / 2;
        const radius = Math.hypot(
            Math.max(originX, window.innerWidth - originX),
            Math.max(originY, window.innerHeight - originY),
        );

        const transition = document.startViewTransition(() => applyTheme(nextTheme));

        transition.ready.then(() => {
            document.documentElement.animate(
                { clipPath: [`circle(0px at ${originX}px ${originY}px)`, `circle(${radius}px at ${originX}px ${originY}px)`] },
                { duration: 700, easing: 'cubic-bezier(0.2, 0.75, 0.25, 1)', pseudoElement: '::view-transition-new(root)' },
            );
        });
    });
});

syncThemeToggles();

// Cycle through a list of words, swapping the text while it is faded out.
if (!reducedMotion) {
    document.querySelectorAll('[data-word-rotator]').forEach((rotator) => {
        const words = JSON.parse(rotator.dataset.words ?? '[]');

        if (words.length < 2) {
            return;
        }

        let wordIndex = 0;

        window.setInterval(() => {
            rotator.classList.remove('is-flipping');
            void rotator.offsetWidth;
            rotator.classList.add('is-flipping');

            window.setTimeout(() => {
                wordIndex = (wordIndex + 1) % words.length;
                rotator.textContent = words[wordIndex];
            }, 300);
        }, 2600);
    });
}

// Type out the terminal commands once the terminal scrolls into view.
const terminal = document.querySelector('[data-terminal]');

if (terminal && !reducedMotion && 'IntersectionObserver' in window) {
    const terminalBody = terminal.querySelector('[data-terminal-body]');
    const sessions = JSON.parse(terminal.dataset.terminal ?? '[]');
    const pause = (milliseconds) => new Promise((resolve) => window.setTimeout(resolve, milliseconds));

    const createLine = (className = '') => {
        const line = document.createElement('p');
        line.className = className;
        terminalBody.appendChild(line);

        return line;
    };

    const playTerminal = async () => {
        terminalBody.replaceChildren();
        const caret = document.createElement('span');
        caret.className = 'terminal-caret';
        caret.setAttribute('aria-hidden', 'true');

        for (const session of sessions) {
            const commandLine = createLine('text-ink');
            const prompt = document.createElement('span');
            prompt.className = 'text-primary';
            prompt.textContent = '$ ';
            const command = document.createElement('span');
            commandLine.append(prompt, command, caret);

            for (const character of session.command) {
                command.textContent += character;
                await pause(45 + Math.random() * 50);
            }

            await pause(250);

            session.output.forEach((outputText) => {
                createLine('text-muted').textContent = outputText;
            });

            await pause(450);
        }

        const finalLine = createLine('text-ink');
        const prompt = document.createElement('span');
        prompt.className = 'text-primary';
        prompt.textContent = '$ ';
        finalLine.append(prompt, caret);
    };

    const terminalObserver = new IntersectionObserver((entries, observer) => {
        if (entries.some((entry) => entry.isIntersecting)) {
            observer.disconnect();
            playTerminal();
        }
    }, { threshold: 0.4 });

    terminalObserver.observe(terminal);
}
