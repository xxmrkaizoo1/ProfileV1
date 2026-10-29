const jokes = [
    'Why do programmers prefer dark mode? Because light attracts bugs. 🐛',
    'I told my code a joke about recursion… it told me the same joke back. Then again. Then again.',
    'There are 10 kinds of people: those who understand binary and those who don’t.',
    'A SQL query walks into a bar, walks up to two tables and asks: “Can I join you?”',
    'My PHP code doesn’t have bugs. It just develops random features. ✨',
];

const sectionHints = {
    stack: 'Psst, you can drag the cube to spin it! 🧊',
    projects: 'These are real projects. Click one to explore.',
    contact: 'Ready to talk? Email is the fastest way to reach him.',
};

/**
 * Wire up Kai, the floating robot assistant: eye tracking, blinking, hints, and the quick-action chat panel.
 */
export function initRobotAssistant() {
    const robot = document.querySelector('[data-robot]');

    if (!robot) {
        return;
    }

    const profile = JSON.parse(robot.dataset.robot);
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const toggleButton = robot.querySelector('[data-robot-toggle]');
    const closeButton = robot.querySelector('[data-robot-close]');
    const messageList = robot.querySelector('[data-robot-messages]');
    const actionButtons = robot.querySelectorAll('[data-robot-action]');
    const teaserText = robot.querySelector('[data-robot-teaser-text]');
    const eyes = robot.querySelector('[data-robot-eyes]');
    const pause = (milliseconds) => new Promise((resolve) => window.setTimeout(resolve, milliseconds));

    let hasGreeted = false;
    let isBusy = false;
    let teaserTimer = 0;
    let moodTimer = 0;

    const readStorage = (key) => {
        try {
            return localStorage.getItem(key);
        } catch (error) {
            return null;
        }
    };

    const writeStorage = (key, value) => {
        try {
            localStorage.setItem(key, value);
        } catch (error) {
            // Storage can be unavailable (private mode); the assistant still works for this visit.
        }
    };

    const setMood = (mood, duration = 1600) => {
        window.clearTimeout(moodTimer);
        robot.classList.remove('is-happy', 'is-thinking');

        if (mood) {
            robot.classList.add(`is-${mood}`);
            moodTimer = window.setTimeout(() => robot.classList.remove(`is-${mood}`), duration);
        }
    };

    const wave = () => {
        robot.classList.remove('is-waving');
        void robot.offsetWidth;
        robot.classList.add('is-waving');
    };

    const showTeaser = (text, duration = 0) => {
        if (robot.classList.contains('is-open')) {
            return;
        }

        window.clearTimeout(teaserTimer);
        teaserText.textContent = text;
        robot.classList.add('is-teasing');

        if (duration) {
            teaserTimer = window.setTimeout(() => robot.classList.remove('is-teasing'), duration);
        }
    };

    const hideTeaser = () => {
        window.clearTimeout(teaserTimer);
        robot.classList.remove('is-teasing');
    };

    const addMessage = (text, author = 'bot') => {
        const message = document.createElement('p');
        message.className = `robot-message robot-message-${author}`;
        message.textContent = text;
        messageList.appendChild(message);
        messageList.scrollTop = messageList.scrollHeight;
    };

    const botSay = async (lines) => {
        for (const line of lines) {
            const typing = document.createElement('p');
            typing.className = 'robot-message robot-message-bot robot-typing';
            typing.setAttribute('aria-label', 'Kai is typing');
            typing.innerHTML = '<span></span><span></span><span></span>';
            messageList.appendChild(typing);
            messageList.scrollTop = messageList.scrollHeight;
            robot.classList.add('is-thinking');

            await pause(reducedMotion ? 150 : 550 + Math.min(line.length * 8, 700));

            typing.remove();
            robot.classList.remove('is-thinking');
            addMessage(line);
        }

        setMood('happy');
    };

    const scrollToSection = (sectionId) => {
        document.getElementById(sectionId)?.scrollIntoView({ behavior: reducedMotion ? 'auto' : 'smooth', block: 'start' });
    };

    const replies = {
        about: () => [
            `${profile.name} is a ${profile.role}.`,
            profile.bio,
        ],
        stack: () => [
            'His main stack is Laravel, PHP, JavaScript, Node.js and MySQL.',
            'For AI & IoT he plays with Python, Ollama and ESP32 boards.',
        ],
        projects: () => [
            `He has featured projects here plus ${profile.repositoryCount} highlighted repos from GitHub. Taking you there now! 🚀`,
        ],
        contact: () => [
            `You can email him at ${profile.email}.`,
            profile.openToWork ? `${profile.firstName} is currently open to work, so now's a great time to say hi!` : 'He replies as soon as he can.',
        ],
        theme: () => {
            const nextTheme = document.documentElement.dataset.theme === 'light' ? 'dark' : 'light';
            document.querySelector('[data-theme-toggle]')?.click();

            return [`Done! Switched to ${nextTheme} mode. 🌗`];
        },
        joke: () => [jokes[Math.floor(Math.random() * jokes.length)]],
    };

    const sectionForAction = { about: 'about', stack: 'stack', projects: 'projects', contact: 'contact' };

    const openPanel = async () => {
        hideTeaser();
        robot.classList.add('is-open');
        robot.classList.remove('has-badge');
        toggleButton.setAttribute('aria-expanded', 'true');
        toggleButton.setAttribute('aria-label', 'Close Kai, the site assistant');
        writeStorage('robot-teaser-dismissed', '1');
        wave();

        if (!hasGreeted) {
            hasGreeted = true;
            await botSay([`Hi, I’m Kai 👋, ${profile.firstName}’s site assistant.`, 'Pick a topic below and I’ll show you around.']);
        }
    };

    const closePanel = () => {
        robot.classList.remove('is-open');
        toggleButton.setAttribute('aria-expanded', 'false');
        toggleButton.setAttribute('aria-label', 'Open Kai, the site assistant');
    };

    toggleButton.addEventListener('click', () => {
        if (robot.classList.contains('is-open')) {
            closePanel();
        } else {
            openPanel();
        }
    });

    closeButton.addEventListener('click', () => {
        closePanel();
        toggleButton.focus();
    });

    robot.querySelector('[data-robot-teaser-open]').addEventListener('click', openPanel);
    robot.querySelector('[data-robot-teaser-close]').addEventListener('click', () => {
        hideTeaser();
        writeStorage('robot-teaser-dismissed', '1');
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && robot.classList.contains('is-open')) {
            closePanel();
            toggleButton.focus();
        }
    });

    actionButtons.forEach((button) => {
        button.addEventListener('click', async () => {
            if (isBusy) {
                return;
            }

            isBusy = true;
            addMessage(button.textContent.trim(), 'user');
            await botSay(replies[button.dataset.robotAction]());
            isBusy = false;

            const sectionId = sectionForAction[button.dataset.robotAction];

            if (sectionId) {
                scrollToSection(sectionId);
            }
        });
    });

    toggleButton.addEventListener('pointerenter', wave);

    // Greet first-time visitors with a small speech bubble.
    if (!readStorage('robot-teaser-dismissed')) {
        window.setTimeout(() => {
            showTeaser('Hi, I’m Kai 👋 Want a quick tour?');
            robot.classList.add('has-badge');
            wave();
        }, 2200);
    }

    // Offer a one-time hint as key sections come into view.
    if ('IntersectionObserver' in window && window.matchMedia('(min-width: 640px)').matches) {
        const hintObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    observer.unobserve(entry.target);
                    showTeaser(sectionHints[entry.target.id], 4500);
                    setMood('happy', 1200);
                }
            });
        }, { threshold: 0.35 });

        Object.keys(sectionHints).forEach((sectionId) => {
            const section = document.getElementById(sectionId);

            if (section) {
                hintObserver.observe(section);
            }
        });
    }

    // Let the eyes follow the pointer.
    if (!reducedMotion && eyes) {
        let eyeFrame = 0;

        window.addEventListener('pointermove', (event) => {
            window.cancelAnimationFrame(eyeFrame);
            eyeFrame = window.requestAnimationFrame(() => {
                const rect = toggleButton.getBoundingClientRect();
                const deltaX = event.clientX - (rect.left + rect.width / 2);
                const deltaY = event.clientY - (rect.top + rect.height * 0.32);
                const distance = Math.hypot(deltaX, deltaY) || 1;
                const reach = Math.min(distance / 60, 1);
                eyes.style.transform = `translate(${((deltaX / distance) * 5 * reach).toFixed(2)}px, ${((deltaY / distance) * 3.5 * reach).toFixed(2)}px)`;
            });
        }, { passive: true });
    }
}
