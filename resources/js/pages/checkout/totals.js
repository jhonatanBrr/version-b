/** Order math in integer cents to avoid floating point noise (pure functions). */

export const INSTALLMENTS = 3;

const toCents = (amount) => Math.round(amount * 100);

/**
 * Joins cart lines with the catalog. Lines whose product or edition no longer
 * exists are dropped. Each priced line carries lineTotal (sale) and
 * lineListTotal (list price) for its quantity.
 */
export function pricedLines(cartLines, products) {
    return cartLines
        .map((line) => {
            const product = products.find((p) => p.id === line.productId);
            const edition = product && product.editions.find((e) => e.id === line.editionId);
            if (!edition) return null;
            return {
                ...line,
                product,
                edition,
                lineTotal: (toCents(edition.salePrice) * line.quantity) / 100,
                lineListTotal: (toCents(edition.price) * line.quantity) / 100,
            };
        })
        .filter(Boolean);
}

/** Subtotal at list price, discount, free shipping and final total. */
export function orderTotals(lines) {
    const subtotalCents = lines.reduce((sum, line) => sum + toCents(line.lineListTotal), 0);
    const totalCents = lines.reduce((sum, line) => sum + toCents(line.lineTotal), 0);
    return {
        subtotal: subtotalCents / 100,
        discount: (subtotalCents - totalCents) / 100,
        shipping: 0,
        total: totalCents / 100,
    };
}

/** Amount of each interest-free installment, rounded up to the cent. */
export function installmentAmount(total, installments = INSTALLMENTS) {
    return Math.ceil(toCents(total) / installments) / 100;
}

/** Italian euro format, same as App\Support\PriceFormatter: "1.250,00 €". */
export function formatPrice(amount) {
    const [integer, decimals] = Math.abs(amount).toFixed(2).split('.');
    const grouped = integer.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    return `${amount < 0 ? '-' : ''}${grouped},${decimals} €`;
}
