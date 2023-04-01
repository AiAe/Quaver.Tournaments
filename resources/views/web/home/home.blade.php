@extends('web.layout.base')

@push('seo')
    {!! seo()->for($SEOData) !!}
@endpush

@section('content')
    <div class="container">
        <header class="page-cover">
            <h1>{{ __('Quaver Tournaments') }}</h1>
        </header>
    </div>
@endsection
