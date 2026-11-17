{{--
    Product search. Without JS it submits to the home catalog (?q=…#catalogo);
    with JS the home grid filters live while typing (see resources/js/pages/home/catalog.js).
--}}
<form role="search" action="{{ route('home') }}#catalogo" method="get" class="search {{ $class ?? '' }}" data-search-form>
    <label for="{{ $id }}" class="sr-only">{{ __('common.header.searchLabel') }}</label>
    @include('partials.icon', ['name' => 'search', 'size' => 18, 'class' => 'search__icon'])
    <input id="{{ $id }}" name="q" type="search" class="search__input" data-search-input
           value="{{ request()->routeIs('home') ? request('q') : '' }}"
           placeholder="{{ __('common.header.searchPlaceholder') }}" autocomplete="off">
</form>
