{{-- Placeholder shown until the cart was read from localStorage. --}}
<div class="checkout-skeleton" aria-busy="true" data-checkout-skeleton>
    <span class="sr-only" role="status">{{ __('checkout.loading') }}</span>
    <div class="checkout-skeleton__main" aria-hidden="true">
        <div class="checkout-skeleton__block checkout-skeleton__block--short"></div>
        <div class="checkout-skeleton__block checkout-skeleton__block--tall"></div>
    </div>
    <div class="checkout-skeleton__block checkout-skeleton__block--side" aria-hidden="true"></div>
</div>

{{-- Shown when the cart has no items. --}}
<div class="checkout-empty" data-checkout-empty hidden>
    <span class="checkout-empty__icon" aria-hidden="true">
        @include('partials.icon', ['name' => 'cart', 'size' => 30])
    </span>
    <h2 class="checkout-empty__title">{{ __('checkout.empty.title') }}</h2>
    <p class="checkout-empty__text">{{ __('checkout.empty.text') }}</p>
    <a class="btn btn--primary" href="{{ route('home') }}#catalogo">{{ __('checkout.empty.cta') }}</a>
</div>
