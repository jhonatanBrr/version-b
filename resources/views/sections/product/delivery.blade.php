{{-- Delivery promise (paper / digital / course) and the qualification note for tests. --}}
<ul class="product-delivery">
    <li class="product-delivery__item">
        @include('partials.icon', ['name' => 'truck', 'size' => 18, 'class' => 'product-delivery__icon'])
        {{ __('product.delivery.'.$page->deliveryKind()) }}
    </li>
    @if ($product->isTest())
        <li class="product-delivery__item product-delivery__item--muted">
            @include('partials.icon', ['name' => 'shield', 'size' => 18, 'class' => 'product-delivery__icon'])
            {{ __('product.qualificationNote', ['level' => $product->qualification]) }}
        </li>
    @endif
</ul>
