/** Mobile navigation toggle. */
export function initMobileMenu() {
    const $toggle = $('[data-menu-toggle]');
    const $menu = $('#mobile-menu');

    const setOpen = (open) => {
        $menu.prop('hidden', !open);
        $toggle
            .attr('aria-expanded', String(open))
            .attr('aria-label', open ? $toggle.data('label-close') : $toggle.data('label-open'));
        $toggle.find('[data-menu-icon="open"]').prop('hidden', open);
        $toggle.find('[data-menu-icon="close"]').prop('hidden', !open);
    };

    $toggle.on('click', () => setOpen($menu.prop('hidden')));
    $menu.on('click', 'a', () => setOpen(false));
    $(document).on('keydown', (event) => {
        if (event.key === 'Escape' && !$menu.prop('hidden')) {
            setOpen(false);
            $toggle.trigger('focus');
        }
    });
}
