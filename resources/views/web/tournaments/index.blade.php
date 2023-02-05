@extends('web.layout.base')

@section('content')
    <header class="py-5 border-bottom text-center">
        <h1>{{ __('Tournaments') }}</h1>
        <p class="mb-0">
            {{ __('Find the perfect tournaments for you.') }}
        </p>
        <p>
            {{ __('Head to head matches where you pick the mode, rules and prize.') }}
        </p>
    </header>

    <div class="container">
        @livewire('tournaments.search', key('search'))
    </div>
@endsection
