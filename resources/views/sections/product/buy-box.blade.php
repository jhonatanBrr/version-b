{{--
    Buy box: edition radios, quantity stepper, live totals and cart actions.
    The server renders the first edition with quantity 1; resources/js/pages/product.js
    recalculates with the data in the JSON script tag below.
--}}
@php
    $editions = $page->editions();
    $edition = $editions[0];
    $totals = \App\Catalog\ProductPresenter::totals($edition, 1);
    $buyData = [
        'productId' => $product->id,
        'checkoutUrl' => route('checkout'),
        'min' => \App\Catalog\ProductPresenter::QUANTITY_MIN,
        'max' => \App\Catalog\ProductPresenter::QUANTITY_MAX,
        'editions' => $editions,
        'i18n' => [
            'unitPrice' => __('product.buy.unitPrice', ['price' => '__PRICE__']),
            'savings' => __('product.buy.savings', ['amount' => '__AMOUNT__', 'percent' => '__PERCENT__']),
            'quantityValue' => __('product.buy.quantityValue', ['count' => '__COUNT__']),
            'addedOne' => trans_choice('product.buy.added', 1, ['count' => '__COUNT__']),
            'addedOther' => trans_choice('product.buy.added', 2, ['count' => '__COUNT__']),
        ],
    ];
@endphp
<section class="buy-box" aria-labelledby="buy-title" data-buy-box>
    <script type="application/json" data-product-data>@json($buyData, JSON_HEX_TAG | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)</script>
    <h2 id="buy-title" class="sr-only">{{ __('product.buy.title') }}</h2>

    @if (count($editions) > 1)
        <fieldset class="edition-selector">
            <legend class="edition-selector__legend">{{ __('product.buy.edition') }}</legend>
            @foreach ($editions as $option)
                <label class="edition-selector__option {{ $loop->first ? 'edition-selector__option--checked' : '' }}">
                    <input class="edition-selector__radio" type="radio" name="edition" value="{{ $option['id'] }}"
                           data-edition-radio @checked($loop->first)>
                    <span class="edition-selector__text">
                        <span class="edition-selector__label">{{ $option['label'] }}</span>
                        <span class="edition-selector__detail">{{ $option['detail'] }}</span>
                    </span>
                    <span class="edition-selector__price tabular">{{ \App\Support\PriceFormatter::format($option['salePrice']) }}</span>
                </label>
            @endforeach
        </fieldset>
    @endif

    <div class="quantity-stepper">
        <span id="quantity-label" class="quantity-stepper__label">{{ __('product.buy.quantity') }}</span>
        <div class="quantity-stepper__control" role="group" aria-labelledby="quantity-label">
            <button type="button" class="quantity-stepper__button quantity-stepper__button--decrease"
                    aria-label="{{ __('product.buy.decrease') }}" data-quantity-step="-1" disabled>
                <span aria-hidden="true">−</span>
            </button>
            <output class="quantity-stepper__value tabular" aria-live="polite">
                <span class="sr-only" data-quantity-label>{{ __('product.buy.quantityValue', ['count' => 1]) }}</span>
                <span aria-hidden="true" data-quantity-value>1</span>
            </output>
            <button type="button" class="quantity-stepper__button quantity-stepper__button--increase"
                    aria-label="{{ __('product.buy.increase') }}" data-quantity-step="1">
                <span aria-hidden="true">+</span>
            </button>
        </div>
    </div>

    <div class="buy-box__pricing ds-pulse" data-buy-pricing>
        @include('partials.price', [
            'amount' => $totals['total'],
            'original' => $totals['listTotal'],
            'size' => 'lg',
            'currentHook' => 'buy-total',
            'originalHook' => 'buy-list-total',
        ])
        <p class="buy-box__note">
            {{ __('common.product.vatIncluded') }}<span data-buy-unit-price hidden></span>
        </p>
        <p class="buy-box__savings" data-buy-savings @if ($totals['savings'] <= 0) hidden @endif>
            {{ __('product.buy.savings', ['amount' => \App\Support\PriceFormatter::format($totals['savings']), 'percent' => $totals['discountPercent']]) }}
        </p>
    </div>

    <div class="buy-box__actions">
        <button type="button" class="btn btn--outline btn--lg" data-buy-add>
            @include('partials.icon', ['name' => 'cart', 'size' => 18])
            {{ __('product.buy.addToCart') }}
        </button>
        <button type="button" class="btn btn--primary btn--lg" data-buy-checkout>
            {{ __('product.buy.checkout') }}
        </button>
    </div>
    <p class="buy-box__status" role="status" data-buy-status></p>
    <span class="buy-box__status-icon" data-icon-template hidden>@include('partials.icon', ['name' => 'check', 'size' => 16])</span>
</section>
