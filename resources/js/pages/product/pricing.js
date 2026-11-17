/**
 * Pure buy-box rules shared by the product page (no DOM): mirrors
 * App\Catalog\ProductPresenter and App\Support\PriceFormatter.
 */

const toCents = (amount) => Math.round(amount * 100);

/** Italian euro format used across the site: "1.250,00 €". */
export function formatPrice(amount) {
    const cents = toCents(amount);
    const sign = cents < 0 ? '-' : '';
    const abs = Math.abs(cents);
    const units = String(Math.floor(abs / 100)).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    const decimals = String(abs % 100).padStart(2, '0');
    return `${sign}${units},${decimals} €`;
}

export function clampQuantity(value, min, max) {
    const number = Math.round(Number(value));
    if (!Number.isFinite(number)) return min;
    return Math.min(max, Math.max(min, number));
}

/** Line totals in euros, computed in cents to avoid float noise. */
export function editionTotals(edition, quantity) {
    const total = toCents(edition.salePrice) * quantity;
    const listTotal = toCents(edition.price) * quantity;
    const savings = Math.max(0, listTotal - total);
    return {
        total: total / 100,
        listTotal: listTotal / 100,
        savings: savings / 100,
        discountPercent: listTotal > 0 ? Math.round((savings / listTotal) * 100) : 0,
    };
}

/** Replaces __TOKEN__ placeholders rendered by Blade in translated templates. */
export function fill(template, values) {
    return Object.entries(values).reduce((text, [key, value]) => text.split(`__${key}__`).join(value), template);
}
