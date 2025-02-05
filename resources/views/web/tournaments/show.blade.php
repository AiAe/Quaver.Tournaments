@extends('web.tournaments.parts.base')

@push('seo')
    {!! seo()->for(new \RalphJSmit\Laravel\SEO\Support\SEOData(title: $tournament->name)) !!}
@endpush

@push('cover')
    <div class="col-lg-12">
        <header class="page-cover" style="background: url('{{ asset('assets/img/cover_l_q.png') }}') center;"></header>
    </div>
@endpush

@section('section')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h1>{{ $tournament->name }}</h1>

                    @if($tournament->getMeta('information'))
                        <x-markdown>{{ $tournament->getMeta('information') }}</x-markdown>
                    @endif
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <div>
                    </div>
                    <div>
                        @if($tournament->getMeta('spreadsheet'))
                            <a href="{{ $tournament->getMeta('spreadsheet') }}" class="btn btn-spreadsheet btn-sm"
                               target="_blank"
                               rel="noreferrer">
                                <i class="bi bi-list"></i>
                                {{ __('Spreadsheet') }}
                            </a>
                        @endif
                        @if($tournament->getMeta('discord'))
                            <a href="{{ $tournament->getMeta('discord') }}" class="btn btn-discord btn-sm"
                               target="_blank"
                               rel="noreferrer">
                                <i class="bi bi-discord"></i>
                                {{ __('Discord') }}
                            </a>
                        @endif
                        @if($tournament->getMeta('twitter'))
                            <a href="{{ $tournament->getMeta('twitter') }}" class="btn btn-twitter btn-sm"
                               target="_blank"
                               rel="noreferrer">
                                <i class="bi bi-twitter"></i>
                                {{ __('Twitter') }}
                            </a>
                        @endif
                        @if($tournament->getMeta('twitch'))
                            <a href="{{ $tournament->getMeta('twitch') }}" class="btn btn-twitch btn-sm"
                               target="_blank"
                               rel="noreferrer">
                                <i class="bi bi-twitch"></i>
                                {{ __('Twitch') }}
                            </a>
                        @endif
                            @if($tournament->getMeta('youtube'))
                                <a href="{{ $tournament->getMeta('youtube') }}" class="btn btn-youtube btn-sm"
                                   target="_blank"
                                   rel="noreferrer">
                                    <i class="bi bi-youtube"></i>
                                    {{ __('YouTube') }}
                                </a>
                            @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 tournaments">
            <div class="tournament mt-3 pt-1">
                <x-tournament.details :tournament="$tournament"/>
            </div>
        </div>
    </div>
@endsection
