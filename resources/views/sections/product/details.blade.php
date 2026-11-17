{{-- Technical sheet and contents as native disclosure widgets (keyboard accessible without JS). --}}
@php
    $rows = [
        [__('product.details.labels.format'), __('common.formats.'.$product->format)],
        [__('product.details.labels.category'), $categoryLabel],
        ...array_map(fn (array $spec) => [$spec['label'], $spec['text']], $page->specs()),
    ];
    $contents = $product->isTest() ? $product->includeList() : $product->highlightList();
@endphp
<div class="product-details">
    <details class="product-details__section" open>
        <summary class="product-details__summary">
            {{ __('product.details.technical') }}
            @include('partials.icon', ['name' => 'chevron-down', 'size' => 18, 'class' => 'product-details__chevron'])
        </summary>
        <dl class="product-details__sheet">
            @foreach ($rows as [$label, $value])
                <dt class="product-details__term">{{ $label }}</dt>
                <dd class="product-details__value">{{ $value }}</dd>
            @endforeach
        </dl>
    </details>
    <details class="product-details__section">
        <summary class="product-details__summary">
            {{ $product->isTest() ? __('product.details.contents') : __('product.details.program') }}
            @include('partials.icon', ['name' => 'chevron-down', 'size' => 18, 'class' => 'product-details__chevron'])
        </summary>
        <ul class="product-details__list">
            @foreach ($contents as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </details>
</div>
