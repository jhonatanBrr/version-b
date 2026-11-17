{{--
    Catalog: category / format chips, live result count and product grid.
    Every product is rendered; the server hides the ones that do not match the
    header search (?q=) so the page works without JavaScript, and the jQuery
    module (resources/js/pages/home.js) filters the same list client-side.
--}}
@php
    $locale = app()->getLocale();
    $categoryLabels = collect($categories)->mapWithKeys(fn ($category) => [$category['id'] => $category['label'][$locale]]);
    $visibleCount = count($visibleIds);
    $resultsText = trans_choice('home.catalog.results', $visibleCount)
        .($query !== '' ? ' '.__('home.catalog.searchingFor', ['query' => $query]) : '');
    $i18n = [
        'results' => [
            'zero' => trans_choice('home.catalog.results', 0),
            'one' => trans_choice('home.catalog.results', 1, ['count' => ':count']),
            'other' => trans_choice('home.catalog.results', 2, ['count' => ':count']),
        ],
        'searchingFor' => __('home.catalog.searchingFor', ['query' => ':query']),
    ];
@endphp
<section id="catalogo" class="catalog" aria-labelledby="catalogo-title">
    <div class="container catalog__inner">
        <header class="catalog__header ds-reveal">
            <span class="eyebrow">{{ __('home.catalog.eyebrow') }}</span>
            <h2 id="catalogo-title" class="catalog__title">{{ __('home.catalog.title') }}</h2>
        </header>

        <div class="catalog__browser" data-catalog data-query="{{ $query }}">
            <script type="application/json" data-catalog-i18n>@json($i18n)</script>

            <div class="catalog__filters">
                <div class="catalog__chips catalog__chips--scroll" role="group" aria-label="{{ __('home.catalog.categoriesLabel') }}">
                    <button type="button" class="chip chip--counted" aria-pressed="true" data-category-chip="all">
                        {{ __('home.catalog.all') }}
                        <span class="chip__count" data-count>{{ $categoryCounts['all'] }}</span>
                    </button>
                    @foreach ($categories as $category)
                        <button type="button" class="chip chip--counted" aria-pressed="false" data-category-chip="{{ $category['id'] }}">
                            {{ $category['label'][$locale] }}
                            <span class="chip__count" data-count>{{ $categoryCounts[$category['id']] }}</span>
                        </button>
                    @endforeach
                </div>
                <div class="catalog__chips" role="group" aria-label="{{ __('home.catalog.formatsLabel') }}">
                    @foreach ($formats as $format)
                        <button type="button" class="chip chip--soft" aria-pressed="false" data-format-chip="{{ $format }}">
                            <span class="chip__dot" style="--dot: var(--ds-format-{{ $format }})" aria-hidden="true"></span>
                            {{ __('common.formats.'.$format) }}
                        </button>
                    @endforeach
                </div>
            </div>

            <p class="catalog__results" aria-live="polite" data-results>{{ $resultsText }}</p>

            <ul class="catalog__grid" data-catalog-grid @if ($visibleCount === 0) hidden @endif>
                @foreach ($products as $product)
                    @php($visibleIndex = array_search($product->id, $visibleIds, true))
                    <li data-catalog-item data-name="{{ $product->name }}" data-category="{{ $product->category }}" data-format="{{ $product->format }}"
                        class="catalog__item ds-reveal"@if ($visibleIndex === false) hidden @endif>
                        <div class="catalog__card ds-enter" style="--ds-delay: {{ min($visibleIndex === false ? 0 : $visibleIndex, 8) * 60 }}ms" data-catalog-card>
                            @include('partials.product-card', [
                                'product' => $product,
                                'categoryLabel' => $categoryLabels[$product->category],
                                'detailsLabel' => __('home.catalog.details'),
                                'eager' => $visibleIndex !== false && $visibleIndex < 3,
                            ])
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="catalog__empty" data-catalog-empty @if ($visibleCount > 0) hidden @endif>
                <h3 class="catalog__empty-title">{{ __('home.catalog.emptyTitle') }}</h3>
                <p class="catalog__empty-text">{{ __('home.catalog.emptyText') }}</p>
                <a href="{{ route('home') }}#catalogo" class="btn btn--outline catalog__reset" data-catalog-reset
                   @if ($query === '') hidden @endif>{{ __('home.catalog.reset') }}</a>
            </div>
        </div>
    </div>
</section>
