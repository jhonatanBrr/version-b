/**
 * Light/dark theme stored in localStorage and applied on <html data-theme>.
 * The switch reveals the new theme in a circle from the click point using
 * the View Transitions API; without it (or with reduced motion) it is instant.
 */
const STORAGE_KEY = 'gp-theme';

const current = () => (document.documentElement.dataset.theme === 'dark' ? 'dark' : 'light');

function apply(theme) {
    document.documentElement.dataset.theme = theme;
    try {
        localStorage.setItem(STORAGE_KEY, theme);
    } catch (e) {
        /* storage unavailable: the theme still applies for this visit */
    }
}

function syncToggle($toggle) {
    const dark = current() === 'dark';
    $toggle
        .attr('aria-pressed', String(dark))
        .attr('aria-label', dark ? $toggle.data('label-light') : $toggle.data('label-dark'));
}

export function initThemeToggle() {
    const $toggle = $('[data-theme-toggle]');
    syncToggle($toggle);

    $toggle.on('click', (event) => {
        const next = current() === 'dark' ? 'light' : 'dark';
        const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        if (!document.startViewTransition || reduceMotion) {
            apply(next);
            syncToggle($toggle);
            return;
        }

        // Keyboard activation has no pointer position: reveal from the button.
        const rect = event.currentTarget.getBoundingClientRect();
        const x = event.clientX || rect.left + rect.width / 2;
        const y = event.clientY || rect.top + rect.height / 2;
        const radius = Math.hypot(Math.max(x, innerWidth - x), Math.max(y, innerHeight - y));

        const transition = document.startViewTransition(() => {
            apply(next);
            syncToggle($toggle);
        });

        transition.ready
            .then(() => {
                document.documentElement.animate(
                    { clipPath: [`circle(0px at ${x}px ${y}px)`, `circle(${radius}px at ${x}px ${y}px)`] },
                    { duration: 700, easing: 'cubic-bezier(.4, 0, .2, 1)', pseudoElement: '::view-transition-new(root)' },
                );
            })
            .catch(() => {});
    });
}
