{{--
    Client-side checkout: the server renders every state (loading, empty,
    form, confirmation) and resources/js/pages/checkout.js switches between
    them from the cart in localStorage. No payment gateway is called.
--}}
@extends('layouts.app')

@section('title', __('checkout.meta.title'))
@section('description', __('checkout.meta.description'))

@push('meta')
    <meta name="robots" content="noindex">
@endpush

@section('content')
    <div class="checkout container" data-page="checkout">
        @include('sections.checkout.header')

        @include('sections.checkout.states')

        <div data-checkout-main hidden>
            <div class="checkout__layout">
                <details class="checkout__mobile-summary mobile-summary">
                    <summary class="mobile-summary__toggle">
                        <span class="mobile-summary__label">
                            {{ __('checkout.summary.toggle') }}
                            @include('partials.icon', ['name' => 'chevron-down', 'size' => 18, 'class' => 'mobile-summary__chevron'])
                        </span>
                        <span class="mobile-summary__total tabular" data-total="total"></span>
                    </summary>
                    <div class="mobile-summary__body">
                        @include('sections.checkout.summary')
                    </div>
                </details>

                @include('sections.checkout.form')

                <aside class="checkout__summary" aria-labelledby="checkout-summary-title">
                    <h2 id="checkout-summary-title" class="checkout__summary-title">
                        {{ __('checkout.summary.title') }}
                        <span class="checkout__summary-count" data-summary-count></span>
                    </h2>
                    @include('sections.checkout.summary')
                </aside>
            </div>

            <div class="checkout__bar">
                <p class="checkout__bar-total">
                    <span class="checkout__bar-caption">{{ __('checkout.summary.total') }} · {{ __('checkout.summary.vatIncluded') }}</span>
                    <span class="checkout__bar-amount tabular" data-total="total"></span>
                </p>
                @include('sections.checkout.pay-button', ['form' => 'checkout-form'])
            </div>
        </div>

        @include('sections.checkout.confirmation')

        @include('sections.checkout.templates')

        <script type="application/json" id="checkout-data">@json($clientData)</script>
    </div>
@endsection
