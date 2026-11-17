/**
 * Product page buy box (jQuery): edition radios, quantity stepper, live totals
 * and cart actions. The server already rendered the first edition with
 * quantity 1, so this only reacts to changes. Data and translated templates
 * come from the JSON script tag [data-product-data].
 */
import { cart } from '../modules/cart';
import { clampQuantity, editionTotals, fill, formatPrice } from './product/pricing';

const STATUS_TIMEOUT_MS = 5000;

/** Restarts a CSS animation class (ds-pulse, ds-pop) on an element. */
function replay($element, className) {
    $element.removeClass(className);
    void $element[0].offsetWidth;
    $element.addClass(className);
}

export function initProduct($root) {
    const $box = $root.find('[data-buy-box]');
    if (!$box.length) return;

    let data;
    try {
        data = JSON.parse($box.find('[data-product-data]').text());
    } catch (e) {
        return; /* malformed data: keep the server-rendered state */
    }

    const { i18n } = data;
    const state = { edition: data.editions[0], quantity: 1 };
    let statusTimer = null;

    const $radios = $box.find('[data-edition-radio]');
    const $decrease = $box.find('[data-quantity-step="-1"]');
    const $increase = $box.find('[data-quantity-step="1"]');
    const $pricing = $box.find('[data-buy-pricing]');
    const $status = $box.find('[data-buy-status]');

    function render() {
        const { edition, quantity } = state;
        const totals = editionTotals(edition, quantity);

        $box.find('[data-quantity-value]').text(quantity);
        $box.find('[data-quantity-label]').text(fill(i18n.quantityValue, { COUNT: quantity }));
        $decrease.prop('disabled', quantity <= data.min);
        $increase.prop('disabled', quantity >= data.max);

        // The price partial keeps its sr-only prefix; only the amount text node changes.
        const setAmount = ($element, amount) => {
            const $label = $element.children('.sr-only').detach();
            $element.text(formatPrice(amount)).prepend($label);
        };
        setAmount($pricing.find('[data-buy-total]'), totals.total);
        const $original = $pricing.find('[data-buy-list-total]');
        if ($original.length) {
            setAmount($original, totals.listTotal);
            $original.prop('hidden', totals.listTotal <= totals.total);
        }

        $pricing
            .find('[data-buy-unit-price]')
            .text(quantity > 1 ? ` · ${fill(i18n.unitPrice, { PRICE: formatPrice(edition.salePrice) })}` : '')
            .prop('hidden', quantity <= 1);
        $pricing
            .find('[data-buy-savings]')
            .text(fill(i18n.savings, { AMOUNT: formatPrice(totals.savings), PERCENT: totals.discountPercent }))
            .prop('hidden', totals.savings <= 0);

        replay($pricing, 'ds-pulse');
    }

    $radios.on('change', function () {
        const id = String($(this).val());
        state.edition = data.editions.find((edition) => edition.id === id) || data.editions[0];
        $radios.each(function () {
            $(this).closest('.edition-selector__option').toggleClass('edition-selector__option--checked', this.checked);
        });
        render();
    });

    $box.find('[data-quantity-step]').on('click', function () {
        const next = clampQuantity(state.quantity + Number($(this).data('quantity-step')), data.min, data.max);
        if (next === state.quantity) return;
        state.quantity = next;
        render();
    });

    const addToCart = () => cart.add(data.productId, state.edition.id, state.quantity);

    $box.find('[data-buy-add]').on('click', () => {
        addToCart();
        const template = state.quantity === 1 ? i18n.addedOne : i18n.addedOther;
        const $message = $('<span class="buy-box__confirmation ds-pop"></span>').text(fill(template, { COUNT: state.quantity }));
        $message.prepend($box.find('[data-icon-template]').clone().removeAttr('hidden data-icon-template'));
        $status.empty().append($message);

        clearTimeout(statusTimer);
        statusTimer = setTimeout(() => $status.empty(), STATUS_TIMEOUT_MS);
    });

    $box.find('[data-buy-checkout]').on('click', () => {
        addToCart();
        window.location.assign(data.checkoutUrl);
    });
}
