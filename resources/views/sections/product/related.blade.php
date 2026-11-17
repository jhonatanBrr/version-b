{{-- Related products rail: 1 / 2 / 3 columns with the shared product card. --}}
@if (count($related) > 0)
    <section class="related-products" aria-labelledby="related-title">
        <h2 id="related-title" class="related-products__title">{{ __('product.related.title') }}</h2>
        <div class="related-products__grid">
            @foreach ($related as $item)
                @include('partials.product-card', [
                    'product' => $item,
                    'categoryLabel' => $categoryLabels[$item->category] ?? '',
                    'detailsLabel' => __('product.related.details'),
                ])
            @endforeach
        </div>
    </section>
@endif
