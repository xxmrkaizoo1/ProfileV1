const header = document.querySelector('#site-header');
const progress = document.querySelector('.game-scroll-progress');
const revealItems = document.querySelectorAll('[data-scroll-reveal]');
const sectionLinks = document.querySelectorAll('[data-section-link]');
const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

let scrollFrame = 0;

// Update the fixed header style and top-of-page scroll progress indicator.
const updateScrollState = () => {
    const scrollableHeight = document.documentElement.scrollHeight - window.innerHeight;
    const scrollProgress = scrollableHeight > 0 ? window.scrollY / scrollableHeight : 0;

    header?.classList.toggle('is-scrolled', window.scrollY > 24);

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
        item.style.transitionDelay = `${Math.min(index % 6, 5) * 70}ms`;
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
