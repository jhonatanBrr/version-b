{{--
    One checkout text field. The error paragraph is filled by the script;
    aria-invalid and aria-describedby are set only while the field has an error.
    @include('sections.checkout.field', ['name' => 'email', 'type' => 'email', 'autocomplete' => 'email', 'wide' => true])
--}}
@php($id = 'checkout-'.$name)
@php($optional = $optional ?? false)
<div class="field checkout-form__field {{ ($wide ?? false) ? 'checkout-form__field--wide' : '' }}">
    <label class="field__label" for="{{ $id }}">
        {{ __("checkout.form.$name") }}
        @if ($optional)
            <span class="field__hint">{{ __('checkout.form.optional') }}</span>
        @endif
    </label>
    <input class="field__control" id="{{ $id }}" name="{{ $name }}" type="{{ $type ?? 'text' }}"
           autocomplete="{{ $autocomplete }}"
           @isset($inputmode) inputmode="{{ $inputmode }}" @endisset
           @isset($maxlength) maxlength="{{ $maxlength }}" @endisset
           @unless ($optional) required @endunless>
    <p class="field__error" id="{{ $id }}-error" data-error-for="{{ $name }}" hidden></p>
</div>
