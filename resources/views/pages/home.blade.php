@extends('layouts.app')

@section('title', __('home.meta.title'))
@section('description', __('home.meta.description'))

@section('content')
    <div class="home" data-page="home">
        @include('sections.home.hero', ['featured' => $featured, 'productCount' => count($products)])
        @include('sections.home.catalog')
        @include('sections.home.contact')
    </div>
@endsection
