{{-- Editable list of cart lines followed by the order totals (rendered twice: mobile and desktop). --}}
<div class="order-summary">
    <ul class="order-summary__lines" data-summary-lines></ul>
    <dl class="summary-totals">
        <div class="summary-totals__row">
            <dt class="summary-totals__term">{{ __('checkout.summary.subtotal') }}</dt>
            <dd class="tabular" data-total="subtotal"></dd>
        </div>
        <div class="summary-totals__row" data-discount-row hidden>
            <dt class="summary-totals__term">{{ __('checkout.summary.discount') }}</dt>
            <dd class="summary-totals__value summary-totals__value--accent tabular" data-total="discount"></dd>
        </div>
        <div class="summary-totals__row">
            <dt class="summary-totals__term">{{ __('checkout.summary.shipping') }}</dt>
            <dd class="summary-totals__value summary-totals__value--accent">{{ __('checkout.summary.free') }}</dd>
        </div>
        <div class="summary-totals__row summary-totals__row--total">
            <dt class="summary-totals__total-term">
                {{ __('checkout.summary.total') }}
                <span class="summary-totals__vat">{{ __('checkout.summary.vatIncluded') }}</span>
            </dt>
            <dd class="summary-totals__grand tabular" data-total="total"></dd>
        </div>
    </dl>
</div>
