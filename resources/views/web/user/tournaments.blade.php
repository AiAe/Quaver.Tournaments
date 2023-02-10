@extends('web.layout.base')

@section('content')
    <div class="container">
        <header class="page-cover">
            <div>
                <h1>{{ $seo['title'] }}</h1>
            </div>
        </header>
    </div>

    <div class="container">
        @livewire('tournaments.search', ['user' => $user, 'show_unlisted' => $show_unlisted], key('search'))
    </div>
@endsection
