{{-- Name, people, spec line, description and highlights, kept together for scanning. --}}
<div class="product-summary">
    <p class="product-summary__eyebrow">
        @if ($product->isNew){{ __('product.isNew') }} · @endif{{ __('common.kinds.'.$product->kind) }} · {{ $categoryLabel }}
    </p>
    <h1 class="product-summary__title">{{ $product->name }}</h1>
    <p class="product-summary__people">
        <span class="product-summary__muted">{{ $product->isTest() ? __('common.product.authors') : __('common.product.teacher') }}: </span>
        <span class="product-summary__strong">{{ implode(', ', $product->people) }}</span>
    </p>
    <p class="product-summary__specs">
        <span class="sr-only">{{ __('product.spec.label') }}: </span>{{ implode(' · ', array_column($page->specs(), 'text')) }}
    </p>
    <p class="product-summary__description">{{ $product->descriptionText() }}</p>
    <div>
        <h2 class="sr-only">{{ __('product.highlights') }}</h2>
        <ul class="product-summary__highlights">
            @foreach ($product->highlightList() as $item)
                <li class="product-summary__highlight">
                    @include('partials.icon', ['name' => 'check', 'size' => 16, 'class' => 'product-summary__highlight-icon'])
                    {{ $item }}
                </li>
            @endforeach
        </ul>
    </div>
</div>
