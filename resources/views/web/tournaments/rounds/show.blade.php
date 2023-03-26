@extends('web.tournaments.parts.base')

@push('cover')
    <div class="col-lg-12">
        <header class="page-cover smaller">
            <h1>{{ $round->name }}</h1>
        </header>
    </div>
@endpush

@section('section')

    <div class="card">
        <div class="card-header">
            Info
        </div>
        {{-- TODO: Description with best of, number of bans, etc --}}
        <p>Best of 7, 2 bans per player/team</p>
    </div>

    <div class="card">
        <div class="card-header">
            Matches
        </div>
        <x-matches.list :matches="$round->matches"/>
    </div>

    <div class="mappools mt-2">
        <div class="d-flex justify-content-between align-items-center round-name">
            <div class="d-flex align-items-center"><span></span>{{ __('Maps') }}</div>
            <div class="d-flex" style="gap: 10px;">
                <div class="d-flex" style="gap: 10px;">
                    <a href="#" class="btn btn-primary btn-sm">{{ __('Download') }}</a>
                    <a href="#" class="btn btn-primary btn-sm">{{ __('Download In-Game') }}</a>
                </div>
            </div>
        </div>

        <x-mappool.map-list :maps="$round->maps"/>
    </div>
@endsection
