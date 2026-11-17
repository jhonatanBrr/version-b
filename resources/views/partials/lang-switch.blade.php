{{-- IT / ES switch: plain links to the same page in the other locale (works without JS). --}}
<nav class="lang-switch {{ ($compact ?? false) ? 'lang-switch--compact' : '' }}" aria-label="{{ __('common.header.language') }}">
    @foreach (config('app.supported_locales') as $code)
        <a href="{{ \App\Support\LocaleUrl::switchTo($code) }}"
           class="lang-switch__option"
           hreflang="{{ $code }}"
           lang="{{ $code }}"
           title="{{ __('common.header.languages.'.$code) }}"
           @if ($code === app()->getLocale()) aria-current="true" @endif>{{ $code }}</a>
    @endforeach
</nav>
