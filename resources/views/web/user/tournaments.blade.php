@extends('web.layout.base')

@push('seo')
    {!! seo()->for($SEOData) !!}
@endpush

@section('content')
    <div class="container">
        <header class="page-cover">
            <div>
                <h1>{{ $title }}</h1>
            </div>
        </header>
    </div>

    <div class="container">
        @livewire('tournaments.search', ['user' => $user, 'show_unlisted' => $show_unlisted], key('search'))
    </div>
@endsection
