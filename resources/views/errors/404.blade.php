{{-- Localized, illustrated 404 (the locale is set by the fallback route). --}}
@extends('layouts.app')

@section('title', __('common.notFound.eyebrow'))

@section('content')
    <section class="not-found">
        <div class="not-found__inner container">
            <div class="not-found__content">
                <span class="not-found__eyebrow">{{ __('common.notFound.eyebrow') }}</span>
                <h1 class="not-found__title">{{ __('common.notFound.title') }}</h1>
                <p class="not-found__text">{{ __('common.notFound.text') }}</p>
                <div class="not-found__actions">
                    <a class="btn btn--primary btn--lg" href="{{ route('home') }}#catalogo">{{ __('common.notFound.back') }}</a>
                    <a class="btn btn--outline btn--lg" href="{{ route('home') }}#contatti">{{ __('common.notFound.contact') }}</a>
                </div>
            </div>
            @include('partials.illustrations.not-found', ['title' => __('common.notFound.illustration'), 'class' => 'not-found__illustration'])
        </div>
    </section>
@endsection
