{{-- Contact, billing and payment-method sections; validated on submit by jQuery. --}}
<form id="checkout-form" class="checkout-form" novalidate aria-label="{{ __('checkout.form.label') }}" data-checkout-form>
    <fieldset class="checkout-form__section">
        <legend class="checkout-form__legend">{{ __('checkout.form.contact') }}</legend>
        <div class="checkout-form__grid">
            @include('sections.checkout.field', ['name' => 'email', 'type' => 'email', 'autocomplete' => 'email', 'inputmode' => 'email', 'wide' => true])
        </div>
    </fieldset>

    <fieldset class="checkout-form__section">
        <legend class="checkout-form__legend">{{ __('checkout.form.billing') }}</legend>
        <div class="checkout-form__grid">
            @include('sections.checkout.field', ['name' => 'firstName', 'autocomplete' => 'given-name'])
            @include('sections.checkout.field', ['name' => 'lastName', 'autocomplete' => 'family-name'])
            @include('sections.checkout.field', ['name' => 'taxId', 'autocomplete' => 'off', 'maxlength' => 16])
            @include('sections.checkout.field', ['name' => 'sdi', 'autocomplete' => 'off', 'optional' => true])
            @include('sections.checkout.field', ['name' => 'address', 'autocomplete' => 'street-address', 'wide' => true])
            @include('sections.checkout.field', ['name' => 'postalCode', 'autocomplete' => 'postal-code', 'inputmode' => 'numeric', 'maxlength' => 5])
            @include('sections.checkout.field', ['name' => 'city', 'autocomplete' => 'address-level2'])
        </div>
    </fieldset>

    <fieldset class="checkout-form__section">
        <legend id="checkout-payment-legend" class="checkout-form__legend">{{ __('checkout.form.payment') }}</legend>
        <div class="checkout-form__stack">
            @include('sections.checkout.payment-methods')
            <p class="checkout-form__note">
                @include('partials.icon', ['name' => 'shield', 'size' => 18, 'class' => 'checkout-form__note-icon'])
                {{ __('checkout.form.demoNote') }}
            </p>
        </div>
    </fieldset>

    <p class="checkout-form__error-summary" aria-live="polite" data-error-summary data-message="{{ __('checkout.form.errorSummary') }}"></p>

    <div class="checkout-form__submit">
        @include('sections.checkout.pay-button')
    </div>
</form>
