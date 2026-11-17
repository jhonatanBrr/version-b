{{-- Success state shown after the simulated payment; the script fills it and focuses the heading. --}}
<section class="confirmation" role="status" aria-labelledby="checkout-confirmation-title" data-checkout-confirmation hidden>
    <span class="confirmation__icon" aria-hidden="true">
        @include('partials.icon', ['name' => 'check', 'size' => 28])
    </span>
    <div class="confirmation__intro">
        <h2 id="checkout-confirmation-title" class="confirmation__title" tabindex="-1">{{ __('checkout.confirmation.title') }}</h2>
        <p class="confirmation__email" data-confirmation-email></p>
    </div>
    <dl class="confirmation__facts">
        <div>
            <dt class="confirmation__term">{{ __('checkout.confirmation.orderNumber') }}</dt>
            <dd class="confirmation__order-number tabular" data-confirmation-number></dd>
        </div>
        <div>
            <dt class="confirmation__term">{{ __('checkout.confirmation.method') }}</dt>
            <dd class="confirmation__method" data-confirmation-method></dd>
        </div>
    </dl>
    <div>
        <h3 class="confirmation__subtitle">{{ __('checkout.confirmation.items') }}</h3>
        <ul class="confirmation__lines" data-confirmation-lines></ul>
        <p class="confirmation__total">
            <span>{{ __('checkout.confirmation.total') }}</span>
            <span class="tabular" data-confirmation-total></span>
        </p>
    </div>
    <p class="confirmation__demo">{{ __('checkout.confirmation.demo') }}</p>
    <a class="btn btn--primary confirmation__back" href="{{ route('home') }}#catalogo">{{ __('checkout.confirmation.back') }}</a>
</section>
