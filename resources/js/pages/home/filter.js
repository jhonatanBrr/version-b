/**
 * Pure catalog filtering rules (no DOM). Same rules as the server-side search
 * in HomeController: case-insensitive name substring, one category, formats OR-ed.
 *
 * @typedef {{ name: string, category: string, format: string }} CatalogItem
 * @typedef {{ query: string, category: string, formats: string[] }} CatalogFilters
 */

const normalize = (value) => value.trim().toLocaleLowerCase();

export function matchesQuery(item, query) {
    const needle = normalize(query);
    return needle === '' || item.name.toLocaleLowerCase().includes(needle);
}

export function matchesFormats(item, formats) {
    return formats.length === 0 || formats.includes(item.format);
}

/** @returns {boolean} whether the item passes every active filter. */
export function matchesFilters(item, { query, category, formats }) {
    return (
        matchesQuery(item, query) &&
        (category === 'all' || item.category === category) &&
        matchesFormats(item, formats)
    );
}

/**
 * Per-category counts under the other active filters (query + formats),
 * so each chip shows what clicking it would yield.
 */
export function countByCategory(items, { query, formats }) {
    const counts = { all: 0 };
    items.forEach((item) => {
        counts[item.category] = counts[item.category] ?? 0;
        if (!matchesQuery(item, query) || !matchesFormats(item, formats)) return;
        counts.all += 1;
        counts[item.category] += 1;
    });
    return counts;
}

/** Picks the plural form ("zero" | "one" | "other") and fills :count. */
export function formatResults(templates, count) {
    const template = count === 0 ? templates.zero : count === 1 ? templates.one : templates.other;
    return template.replace(':count', String(count));
}
