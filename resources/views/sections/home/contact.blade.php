{{-- Contact section: copy + form validated on submit with jQuery (no backend). --}}
@php
    $points = ['advice', 'training', 'orders'];
    $fields = [
        ['key' => 'name', 'type' => 'text', 'autocomplete' => 'name', 'hint' => true],
        ['key' => 'email', 'type' => 'email', 'autocomplete' => 'email', 'hint' => true],
    ];
    $i18n = [
        'errors' => __('home.contact.errors'),
        'successText' => __('home.contact.successText', ['name' => ':name', 'email' => ':email']),
    ];
@endphp
<section id="contatti" class="contact" aria-labelledby="contatti-title">
    <div class="container contact__inner ds-reveal-children">
        <div class="contact__intro">
            <span class="eyebrow">{{ __('home.contact.eyebrow') }}</span>
            <h2 id="contatti-title" class="contact__title">{{ __('home.contact.title') }}</h2>
            <p class="contact__text">{{ __('home.contact.text') }}</p>
            <ul class="contact__points">
                @foreach ($points as $point)
                    <li class="contact__point">
                        <span class="contact__point-icon">@include('partials.icon', ['name' => 'check', 'size' => 16])</span>
                        {{ __('home.contact.points.'.$point) }}
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="contact__panel" data-contact>
            <script type="application/json" data-contact-i18n>@json($i18n)</script>

            <form class="contact-form" novalidate aria-label="{{ __('home.contact.formLabel') }}" data-contact-form>
                @foreach ($fields as $field)
                    <div class="field">
                        <label for="contact-{{ $field['key'] }}" class="field__label">
                            {{ __('home.contact.'.$field['key']) }}<span class="field__hint">{{ __('home.contact.required') }}</span>
                        </label>
                        <input id="contact-{{ $field['key'] }}" name="{{ $field['key'] }}" type="{{ $field['type'] }}"
                               class="field__control" autocomplete="{{ $field['autocomplete'] }}"
                               required aria-required="true"
                               placeholder="{{ __('home.contact.'.$field['key'].'Placeholder') }}">
                        <p id="contact-{{ $field['key'] }}-error" class="field__error" hidden></p>
                    </div>
                @endforeach
                <div class="field">
                    <label for="contact-message" class="field__label">{{ __('home.contact.message') }} {{ __('home.contact.required') }}</label>
                    <textarea id="contact-message" name="message" rows="5"
                              class="field__control field__control--textarea"
                              required aria-required="true"
                              placeholder="{{ __('home.contact.messagePlaceholder') }}"></textarea>
                    <p id="contact-message-error" class="field__error" hidden></p>
                </div>
                <button type="submit" class="btn btn--primary btn--lg contact-form__submit">{{ __('home.contact.submit') }}</button>
            </form>

            <div class="contact-success" role="status" tabindex="-1" data-contact-success hidden>
                <span class="contact-success__icon">@include('partials.icon', ['name' => 'check', 'size' => 24])</span>
                <h3 class="contact-success__title">{{ __('home.contact.successTitle') }}</h3>
                <p class="contact-success__text" data-contact-success-text></p>
                <button type="button" class="btn btn--outline" data-contact-reset>{{ __('home.contact.sendAnother') }}</button>
            </div>
        </div>
    </div>
</section>
