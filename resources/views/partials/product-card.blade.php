{{--
    Catalog card shared by the home grid and the related-products rail.
    @include('partials.product-card', ['product' => $product, 'categoryLabel' => '…', 'eager' => false])
--}}
@php
    $locale = app()->getLocale();
    if ($product->isTest()) {
        $metaLabel = __('common.product.age');
        $metaValue = isset($product->ageRange['max'])
            ? __('common.product.ageRange', ['min' => $product->ageRange['min'], 'max' => $product->ageRange['max']])
            : __('common.product.ageFrom', ['min' => $product->ageRange['min']]);
    } else {
        $metaLabel = __('common.product.start');
        $metaValue = \Illuminate\Support\Carbon::parse($product->startDate)->locale($locale)->isoFormat('D MMMM YYYY');
    }
    $edition = $product->editions[0];
@endphp
<article class="product-card">
    <div class="product-card__media">
        <img class="product-card__image"
             src="{{ $product->imageUrl(640) }}"
             srcset="{{ $product->imageUrl(480) }} 480w, {{ $product->imageUrl(800) }} 800w"
             sizes="(min-width: 1024px) 380px, (min-width: 640px) 50vw, 100vw"
             alt="{{ $product->imageAltText() }}"
             width="640" height="400"
             loading="{{ ($eager ?? false) ? 'eager' : 'lazy' }}" decoding="async">
        <div class="product-card__badges">
            <span class="badge badge--neutral">
                <span class="badge__dot" style="--dot: var(--ds-format-{{ $product->format }})" aria-hidden="true"></span>
                {{ __('common.formats.'.$product->format) }}
            </span>
            <span class="badge badge--inverse tabular">-{{ $product->discountPercent() }}%</span>
        </div>
    </div>

    <div class="product-card__body">
        <span class="product-card__eyebrow">{{ __('common.kinds.'.$product->kind) }} · {{ $categoryLabel }}</span>
        <h3 class="product-card__title">
            <a class="product-card__link" href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
        </h3>

        <dl class="product-card__meta">
            <dt class="product-card__meta-label">
                @include('partials.icon', ['name' => 'user', 'size' => 15])
                {{ $product->isTest() ? __('common.product.authors') : __('common.product.teacher') }}
            </dt>
            <dd class="product-card__meta-value">{{ implode(', ', $product->people) }}</dd>
            <dt class="product-card__meta-label">
                @include('partials.icon', ['name' => 'calendar', 'size' => 15])
                {{ $metaLabel }}
            </dt>
            <dd class="product-card__meta-value">{{ $metaValue }}</dd>
        </dl>

        <div class="product-card__footer">
            <div>
                @include('partials.price', ['amount' => $product->salePrice, 'original' => $product->price])
                <div class="product-card__vat">{{ __('common.product.vatIncluded') }}</div>
            </div>
            <div class="product-card__actions">
                <span class="product-card__details" aria-hidden="true">
                    {{ $detailsLabel ?? __('common.product.details') }}
                    @include('partials.icon', ['name' => 'arrow-right', 'size' => 14])
                </span>
                <button type="button" class="product-card__cart"
                        data-add-to-cart
                        data-product-id="{{ $product->id }}"
                        data-edition-id="{{ $edition['id'] }}"
                        data-added-label="{{ __('common.product.addedToCart', ['name' => $product->name]) }}"
                        aria-label="{{ __('common.product.addToCart', ['name' => $product->name]) }}">
                    <span data-icon-default>@include('partials.icon', ['name' => 'cart', 'size' => 20])</span>
                    <span data-icon-added hidden>@include('partials.icon', ['name' => 'check', 'size' => 20])</span>
                </button>
            </div>
        </div>
    </div>
</article>
