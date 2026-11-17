/**
 * Checkout page behaviour (jQuery). The server renders every state; this
 * module reads the cart from localStorage, shows the matching state, keeps
 * the order summary in sync, validates the form on submit and simulates the
 * payment. No payment gateway is called and no card data is requested.
 */
import { cart, MAX_QUANTITY } from '../modules/cart';
import { createOrderNumber } from './checkout/order-number';
import { formatPrice, installmentAmount, orderTotals, pricedLines } from './checkout/totals';
import { CHECKOUT_FIELDS, validateCheckout } from './checkout/validate';

const MIN_QUANTITY = 1;
/** Simulated processing time of the fake payment. */
const PROCESSING_DELAY_MS = 800;
const STEPS = ['cart', 'payment', 'confirm'];

/** Replaces ":name" tokens of a translated string. */
const fill = (template, values) =>
    String(template).replace(/:(\w+)/g, (match, key) => (key in values ? values[key] : match));

const lineKey = (line) => `${line.productId}:${line.editionId}`;
const fieldId = (field) => `checkout-${field}`;

/** Clones the first element of a <template>. */
const cloneTemplate = ($template) => $($template[0].content.firstElementChild.cloneNode(true));

export function initCheckout($root) {
    const { products, texts } = JSON.parse($root.find('#checkout-data').text());
    const $form = $root.find('[data-checkout-form]');
    const $payButtons = $root.find('[data-pay-button]');
    const $lineTemplate = $root.find('[data-line-template]');
    const $confirmationLineTemplate = $root.find('[data-confirmation-line-template]');
    const views = {
        loading: $root.find('[data-checkout-skeleton]'),
        empty: $root.find('[data-checkout-empty]'),
        main: $root.find('[data-checkout-main]'),
        confirmation: $root.find('[data-checkout-confirmation]'),
    };

    const state = {
        lines: [],
        totals: orderTotals([]),
        method: String($form.find('[name="payment-method"]:checked').val()),
        submitted: false,
        processing: false,
        confirmed: false,
    };

    const show = (name) => {
        Object.entries(views).forEach(([key, $view]) => $view.prop('hidden', key !== name));
    };

    /* ---------- Summary ---------- */

    const updateLine = ($item, line) => {
        const name = line.product.name;
        $item.attr('data-key', lineKey(line));
        $item.find('[data-line-image]').attr({ src: line.product.image, alt: line.product.imageAlt });
        $item.find('[data-line-name]').text(name);
        $item.find('[data-line-meta]').text(`${line.edition.label} · ${line.product.format}`);
        $item.find('[data-line-total]').text(formatPrice(line.lineTotal));
        $item.find('[data-line-original]').text(formatPrice(line.lineListTotal));
        $item.find('[data-line-original-wrap]').prop('hidden', line.lineListTotal <= line.lineTotal);
        $item.find('[data-line-stepper]').attr('aria-label', fill(texts.quantityOf, { name }));
        $item.find('[data-line-quantity]').text(line.quantity);
        $item
            .find('[data-quantity-step="-1"]')
            .attr('aria-label', fill(texts.decrease, { name }))
            .prop('disabled', line.quantity <= MIN_QUANTITY);
        $item
            .find('[data-quantity-step="1"]')
            .attr('aria-label', fill(texts.increase, { name }))
            .prop('disabled', line.quantity >= MAX_QUANTITY);
        $item.find('[data-line-remove]').attr('aria-label', fill(texts.removeItem, { name }));
    };

    // Lines are updated in place (keyed) so the focused stepper button keeps focus.
    const renderLines = () => {
        const keys = state.lines.map(lineKey);
        $root.find('[data-summary-lines]').each(function () {
            const $list = $(this);
            $list.children().each(function () {
                if (!keys.includes(this.dataset.key)) $(this).remove();
            });
            state.lines.forEach((line) => {
                let $item = $list.children().filter((_, el) => el.dataset.key === lineKey(line));
                if (!$item.length) $item = cloneTemplate($lineTemplate).appendTo($list);
                updateLine($item, line);
            });
        });

        const count = state.lines.reduce((sum, line) => sum + line.quantity, 0);
        $root.find('[data-summary-count]').text(fill(count === 1 ? texts.itemsOne : texts.itemsOther, { count }));
    };

    const renderTotals = () => {
        const { subtotal, discount, total } = state.totals;
        $root.find('[data-total="subtotal"]').text(formatPrice(subtotal));
        $root.find('[data-total="discount"]').text(`−${formatPrice(discount)}`);
        $root.find('[data-discount-row]').prop('hidden', discount <= 0);
        $root.find('[data-total="total"]').text(formatPrice(total));
    };

    /* ---------- Payment method & pay button ---------- */

    const renderPayment = () => {
        const method = texts.methods[state.method];
        const installment = formatPrice(installmentAmount(state.totals.total));
        const amount = state.method === 'installments' ? installment : formatPrice(state.totals.total);

        $root.find('[data-method-description]').text(fill(method.description, { amount: installment }));
        $root.find('[data-pay-label]').text(state.processing ? texts.processing : fill(method.cta, { amount }));
    };

    const setProcessing = (processing) => {
        state.processing = processing;
        $payButtons.prop('disabled', processing);
        if (processing) {
            $payButtons.attr('aria-busy', 'true');
        } else {
            $payButtons.removeAttr('aria-busy');
        }
        renderPayment();
    };

    /* ---------- Whole page ---------- */

    const render = () => {
        if (state.confirmed) return;
        state.lines = pricedLines(cart.lines(), products);
        state.totals = orderTotals(state.lines);

        if (state.lines.length === 0) {
            show('empty');
            return;
        }
        renderLines();
        renderTotals();
        renderPayment();
        show('main');
    };

    /* ---------- Validation ---------- */

    const readValues = () =>
        Object.fromEntries(CHECKOUT_FIELDS.map((field) => [field, String($form.find(`#${fieldId(field)}`).val())]));

    const renderErrors = (errors) => {
        CHECKOUT_FIELDS.forEach((field) => {
            const $input = $form.find(`#${fieldId(field)}`);
            const $error = $form.find(`[data-error-for="${field}"]`);
            const code = errors[field];

            $input.toggleClass('field__control--error', Boolean(code));
            if (code) {
                $error.text(texts.errors[code]).prop('hidden', false);
                $input.attr({ 'aria-invalid': 'true', 'aria-describedby': `${fieldId(field)}-error` });
            } else {
                $error.text('').prop('hidden', true);
                $input.removeAttr('aria-invalid aria-describedby');
            }
        });

        const $summary = $form.find('[data-error-summary]');
        $summary.text(Object.keys(errors).length > 0 ? $summary.data('message') : '');
    };

    /* ---------- Steps & confirmation ---------- */

    const setStep = (current) => {
        const currentIndex = STEPS.indexOf(current);
        $root.find('[data-checkout-steps] [data-step]').each(function () {
            const index = STEPS.indexOf(this.dataset.step);
            const status = index < currentIndex ? 'done' : index === currentIndex ? 'active' : 'todo';
            $(this)
                .removeClass('checkout-steps__step--done checkout-steps__step--active checkout-steps__step--todo')
                .addClass(`checkout-steps__step--${status}`)
                .attr('aria-current', status === 'active' ? 'step' : null);
            $(this).find('[data-step-completed]').prop('hidden', status !== 'done');
        });
    };

    const showConfirmation = (order) => {
        const $panel = views.confirmation;
        $panel.find('[data-confirmation-number]').text(order.number);
        $panel.find('[data-confirmation-email]').text(fill(texts.confirmationEmail, { email: order.email }));
        $panel.find('[data-confirmation-method]').text(texts.methods[order.method].label);
        $panel.find('[data-confirmation-total]').text(formatPrice(order.total));

        const $list = $panel.find('[data-confirmation-lines]').empty();
        order.lines.forEach((line) => {
            const $item = cloneTemplate($confirmationLineTemplate);
            $item.find('[data-line-name]').text(line.product.name);
            $item.find('[data-line-meta]').text(`${line.edition.label} · ×${line.quantity}`);
            $item.find('[data-line-total]').text(formatPrice(line.lineTotal));
            $list.append($item);
        });

        state.confirmed = true;
        show('confirmation');
        setStep('confirm');
        $panel.find('#checkout-confirmation-title').trigger('focus');
    };

    /* ---------- Events ---------- */

    $root.on('click', '[data-quantity-step]', function () {
        const key = $(this).closest('[data-key]').attr('data-key');
        const line = state.lines.find((l) => lineKey(l) === key);
        if (!line) return;
        const quantity = line.quantity + Number($(this).data('quantity-step'));
        cart.setQuantity(line.productId, line.editionId, Math.min(MAX_QUANTITY, Math.max(MIN_QUANTITY, quantity)));
    });

    $root.on('click', '[data-line-remove]', function () {
        const key = $(this).closest('[data-key]').attr('data-key');
        const line = state.lines.find((l) => lineKey(l) === key);
        if (line) cart.remove(line.productId, line.editionId);
    });

    $form.on('change', '[name="payment-method"]', function () {
        state.method = String($(this).val());
        renderPayment();
    });

    // Validation starts on the first submit; afterwards errors update live so fixed fields clear.
    $form.on('input', '.field__control', () => {
        if (state.submitted) renderErrors(validateCheckout(readValues()));
    });

    $form.on('submit', (event) => {
        event.preventDefault();
        if (state.processing) return;

        const values = readValues();
        const errors = validateCheckout(values);
        state.submitted = true;
        renderErrors(errors);

        const firstInvalid = CHECKOUT_FIELDS.find((field) => errors[field]);
        if (firstInvalid) {
            $form.find(`#${fieldId(firstInvalid)}`).trigger('focus');
            return;
        }

        const submittedAt = Date.now();
        setProcessing(true);
        setTimeout(() => {
            const order = {
                number: createOrderNumber(submittedAt),
                email: values.email.trim(),
                method: state.method,
                total: state.totals.total,
                lines: state.lines,
            };
            setProcessing(false);
            showConfirmation(order);
            cart.clear();
        }, PROCESSING_DELAY_MS);
    });

    $(document).on('cart:change', render);
    // Keep several open tabs in sync.
    $(window).on('storage', render);

    render();
}
