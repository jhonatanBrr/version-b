/** Demo order id "GP-<year>-<5 digits>" derived from a submit timestamp. */
export function createOrderNumber(timestamp) {
    const year = new Date(timestamp).getFullYear();
    const digits = String(Math.floor(timestamp) % 100000).padStart(5, '0');
    return `GP-${year}-${digits}`;
}
