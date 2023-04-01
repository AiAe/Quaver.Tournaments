@extends('web.tournaments.parts.base')

@push('seo')
    {!! seo()->for($tournament) !!}
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
                        <p>
                            {{ $tournament->getMeta('information') }}
                        </p>
                    @endif
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <div>
                    </div>
                    <div>
                        @if($tournament->getMeta('spreadsheet'))
                            <a href="{{ $tournament->getMeta('spreadsheet') }}" class="btn btn-secondary btn-sm"
                               target="_blank"
                               rel="noreferrer">
                                <i class="bi bi-list"></i>
                                {{ __('Spreadsheet') }}
                            </a>
                        @endif
                        @if($tournament->getMeta('discord'))
                            <a href="{{ $tournament->getMeta('discord') }}" class="btn btn-secondary btn-sm" target="_blank"
                               rel="noreferrer">
                                <i class="bi bi-discord"></i>
                                {{ __('Discord') }}
                            </a>
                        @endif
                        @if($tournament->getMeta('twitch'))
                            <a href="{{ $tournament->getMeta('twitch') }}" class="btn btn-secondary btn-sm"
                               target="_blank"
                               rel="noreferrer">
                                <i class="bi bi-twitch"></i>
                                {{ __('Twitch') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{--        <div class="col-lg-6">--}}
        {{--            <h3>Schedule</h3>--}}
        {{--        </div>--}}
        {{--        <div class="col-lg-6">--}}
        {{--            <h3>Prizes</h3>--}}
        {{--        </div>--}}
    </div>
@endsection
