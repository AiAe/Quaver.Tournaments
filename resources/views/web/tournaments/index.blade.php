@extends('web.layout.base')

@push('seo')
    {!! seo()->for($SEOData) !!}
@endpush

@section('content')
    <div class="container">
        <header class="page-cover">
            <div>
                <h1>{{ __('Tournaments') }}</h1>
                <p class="mb-0">
                    {{ __('Find the perfect tournaments for you.') }}
                </p>
                <p>
                    {{ __('Head to head matches where you pick the mode, rules and prize.') }}
                </p>
            </div>
        </header>
    </div>

    <div class="container">
        @livewire('tournaments.search', key('search'))
    </div>
@endsection
