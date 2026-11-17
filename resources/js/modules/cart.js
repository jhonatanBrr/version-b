/**
 * Client-side cart persisted in localStorage (no backend in this test).
 * Lines are { productId, editionId, quantity }. Every change triggers a
 * "cart:change" event on document so any module can react (header badge,
 * checkout summary…).
 */
const STORAGE_KEY = 'gp-cart';
export const MAX_QUANTITY = 20;

const clamp = (value) => Math.min(MAX_QUANTITY, Math.max(1, Math.floor(Number(value) || 1)));

function read() {
    try {
        const saved = JSON.parse(localStorage.getItem(STORAGE_KEY) || 'null');
        if (saved && Array.isArray(saved.lines)) {
            return saved.lines.filter(
                (l) => typeof l.productId === 'string' && typeof l.editionId === 'string' && typeof l.quantity === 'number',
            );
        }
    } catch (e) {
        /* corrupted or unavailable storage: start with an empty cart */
    }
    return [];
}

function write(lines) {
    try {
        localStorage.setItem(STORAGE_KEY, JSON.stringify({ lines }));
    } catch (e) {
        /* storage unavailable: the cart lives only for this page */
    }
    $(document).trigger('cart:change', [lines]);
}

const same = (line, productId, editionId) => line.productId === productId && line.editionId === editionId;

export const cart = {
    lines: () => read(),

    count: () => read().reduce((sum, line) => sum + line.quantity, 0),

    add(productId, editionId, quantity = 1) {
        const lines = read();
        const existing = lines.find((l) => same(l, productId, editionId));
        if (existing) {
            existing.quantity = clamp(existing.quantity + quantity);
        } else {
            lines.push({ productId, editionId, quantity: clamp(quantity) });
        }
        write(lines);
    },

    setQuantity(productId, editionId, quantity) {
        write(read().map((l) => (same(l, productId, editionId) ? { ...l, quantity: clamp(quantity) } : l)));
    },

    remove(productId, editionId) {
        write(read().filter((l) => !same(l, productId, editionId)));
    },

    clear() {
        write([]);
    },
};

/** Keeps the header cart badge and its accessible label in sync. */
export function initCartBadge() {
    const $link = $('[data-cart-link]');
    const $badge = $link.find('[data-cart-count]');

    const render = () => {
        const count = cart.count();
        $badge.text(count).prop('hidden', count === 0);
        const label =
            count === 0
                ? $link.data('label-zero')
                : count === 1
                  ? $link.data('label-one')
                  : String($link.data('label-template')).replace('__COUNT__', count);
        $link.attr('aria-label', label);
    };

    render();
    $(document).on('cart:change', render);
    // Keep several open tabs in sync.
    $(window).on('storage', (event) => {
        if (event.originalEvent.key === STORAGE_KEY) render();
    });
}

/** "Add to cart" icon buttons on product cards (home grid, related products). */
export function initAddToCartButtons() {
    $(document).on('click', '[data-add-to-cart]', function () {
        const $button = $(this);
        cart.add(String($button.data('product-id')), String($button.data('edition-id')), 1);

        $button.addClass('product-card__cart--added');
        $button.find('[data-icon-default]').prop('hidden', true);
        // Re-insert the check icon so its pop animation replays on every click.
        const $check = $button.find('[data-icon-added]');
        $check.prop('hidden', false).removeClass('ds-pop');
        void $check[0].offsetWidth;
        $check.addClass('ds-pop');

        announce($button.data('added-label'));

        clearTimeout($button.data('timer'));
        $button.data(
            'timer',
            setTimeout(() => {
                $button.removeClass('product-card__cart--added');
                $button.find('[data-icon-default]').prop('hidden', false);
                $check.prop('hidden', true);
            }, 2000),
        );
    });
}

/** Polite screen-reader announcement through a shared live region. */
export function announce(message) {
    let $region = $('#sr-announcer');
    if (!$region.length) {
        $region = $('<div id="sr-announcer" class="sr-only" role="status" aria-live="polite"></div>').appendTo('body');
    }
    $region.text('');
    setTimeout(() => $region.text(message), 50);
}
