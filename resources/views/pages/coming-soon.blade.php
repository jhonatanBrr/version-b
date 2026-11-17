{{-- Placeholder for links that are out of scope for the technical test. --}}
@extends('layouts.app')

@section('title', __('common.comingSoon.metaTitle'))

@push('meta')
    <meta name="robots" content="noindex">
@endpush

@section('content')
    @include('sections.coming-soon.hero', ['section' => $section])
@endsection
