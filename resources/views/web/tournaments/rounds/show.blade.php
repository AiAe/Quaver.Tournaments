@extends('web.tournaments.parts.base')

@push('cover')
    <div class="col-lg-12">
        <header class="page-cover smaller">
            <h1>{{ $round->name }}</h1>
        </header>
    </div>
@endpush

@section('section')

    @can('delete', $tournament)
        <div class="d-flex justify-content-end mb-3">
            {{ Form::open(['url' => route('web.tournaments.rounds.destroy', [$tournament, $round]), 'class' => 'd-flex']) }}
            @method('DELETE')
            {{ Form::submit(__('Delete Round'), ['class' => 'btn btn-danger btn-sm']) }}
            {{ Form::close() }}
        </div>
    @endcan

    @if($round->round_text)
        <div class="card mb-3">
            <div class="card-header">
                {{ __('Round information') }}
            </div>
            <div class="card-body">
                {{ $round->round_text??"" }}
            </div>
        </div>
    @endif

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
