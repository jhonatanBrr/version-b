import { countByCategory, formatResults, matchesFilters } from './filter';

const MAX_STAGGER_STEPS = 8;
const STAGGER_MS = 60;

const readJson = ($scope, selector) => JSON.parse($scope.find(selector).text() || '{}');

/** Replays the CSS entrance animation by re-inserting the class after a reflow. */
function replayEntrance($cards) {
    $cards.removeClass('ds-enter');
    if ($cards.length) void $cards[0].offsetWidth;
    $cards.addClass('ds-enter');
}

/**
 * Client-side catalog: category chips, multi-select format chips and the
 * header name search, all without reloading the page.
 */
export function initCatalog($catalog) {
    const i18n = readJson($catalog, '[data-catalog-i18n]');
    const $results = $catalog.find('[data-results]');
    const $grid = $catalog.find('[data-catalog-grid]');
    const $empty = $catalog.find('[data-catalog-empty]');
    const $reset = $catalog.find('[data-catalog-reset]');
    const $categoryChips = $catalog.find('[data-category-chip]');
    const $formatChips = $catalog.find('[data-format-chip]');
    const $searchInputs = $('[data-search-input]');

    const items = $catalog
        .find('[data-catalog-item]')
        .toArray()
        .map((element) => ({
            $element: $(element),
            $card: $(element).find('[data-catalog-card]'),
            name: element.getAttribute('data-name'),
            category: element.getAttribute('data-category'),
            format: element.getAttribute('data-format'),
        }));

    const state = {
        query: String($catalog.attr('data-query') ?? ''),
        category: 'all',
        formats: [],
    };

    /** @param {{ replay?: boolean }} options replay the staggered entrance (category / format changes only). */
    function render({ replay = false } = {}) {
        const visible = items.filter((item) => matchesFilters(item, state));

        items.forEach((item) => item.$element.prop('hidden', !visible.includes(item)));
        visible.forEach((item, index) => {
            item.$card.css('--ds-delay', `${Math.min(index, MAX_STAGGER_STEPS) * STAGGER_MS}ms`);
        });
        if (replay) replayEntrance($(visible.map((item) => item.$card[0])));

        const counts = countByCategory(items, state);
        $categoryChips.each((_, chip) => {
            const $chip = $(chip);
            const id = $chip.attr('data-category-chip');
            $chip.attr('aria-pressed', String(id === state.category));
            $chip.find('[data-count]').text(counts[id] ?? 0);
        });
        $formatChips.each((_, chip) => {
            const $chip = $(chip);
            $chip.attr('aria-pressed', String(state.formats.includes($chip.attr('data-format-chip'))));
        });

        const query = state.query.trim();
        let text = formatResults(i18n.results, visible.length);
        if (query) text += ` ${i18n.searchingFor.replace(':query', query)}`;
        $results.text(text);

        $grid.prop('hidden', visible.length === 0);
        $empty.prop('hidden', visible.length > 0);
        $reset.prop('hidden', state.category === 'all' && state.formats.length === 0 && query === '');
    }

    function setQuery(value, source) {
        state.query = value;
        $searchInputs.not(source).val(value);

        const url = new URL(window.location.href);
        if (value.trim()) url.searchParams.set('q', value.trim());
        else url.searchParams.delete('q');
        window.history.replaceState(window.history.state, '', url);

        render();
    }

    $categoryChips.on('click', (event) => {
        const id = $(event.currentTarget).attr('data-category-chip');
        if (id === state.category) return;
        state.category = id;
        render({ replay: true });
    });

    $formatChips.on('click', (event) => {
        const format = $(event.currentTarget).attr('data-format-chip');
        state.formats = state.formats.includes(format)
            ? state.formats.filter((item) => item !== format)
            : [...state.formats, format];
        render({ replay: true });
    });

    $reset.on('click', (event) => {
        event.preventDefault();
        state.category = 'all';
        state.formats = [];
        if (state.query) setQuery('', null);
        render({ replay: true });
    });

    // Header search: filters live while typing; submitting just brings the catalog into view.
    $searchInputs.on('input', (event) => setQuery(event.currentTarget.value, event.currentTarget));
    $('[data-search-form]').on('submit', (event) => {
        event.preventDefault();
        const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        $catalog.closest('section')[0].scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth', block: 'start' });
    });

    render();
}
