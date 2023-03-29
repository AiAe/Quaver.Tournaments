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
            {{ __('Info') }}
        </div>
        {{-- TODO: Description with best of, number of bans, etc --}}
        <div class="card-body">
            Best of 7, 2 bans per player/team
        </div>
    </div>

    @php($matches = collect($round->matches()->with(['team1', 'team2'])->orderBy('timestamp')->get())->groupBy('timestamp'))

    <x-matches.list :matches="$matches"/>

    <div class="mappools mt-3">
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
