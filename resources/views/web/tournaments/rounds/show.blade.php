@extends('web.tournaments.parts.base')

@push('seo')
    {!! seo()->for($tournament) !!}
@endpush

@push('cover')
    <div class="col-lg-12">
        <header class="page-cover smaller">
            <h1>{{ $round->name }}</h1>
        </header>
    </div>
@endpush

@section('section')
    @canany(['update', 'delete'], $tournament)
        <div class="d-flex justify-content-between mb-3">
            @can('update', $tournament)
                <div>
                    <a href="#tournamentGenerate" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                       data-bs-target="#tournamentGenerate">{{ __('Generate Qualifiers Lobbies') }}</a>
                </div>

                @push('modals')
                    <livewire:tournaments.generate-qualifier-lobbies :tournament="$tournament" :round="$round">
                    </livewire:tournaments.generate-qualifier-lobbies>
                @endpush
            @endcan

            <div></div>

            @can('delete', $tournament)
                <div>
                    {{ Form::open(['url' => route('web.tournaments.rounds.destroy', [$tournament, $round]), 'class' => 'd-flex']) }}
                    @method('DELETE')
                    {{ Form::submit(__('Delete Round'), ['class' => 'btn btn-danger btn-sm']) }}
                    {{ Form::close() }}
                </div>
            @endcan
        </div>
    @endcanany

    @if(!empty($round->round_text))
        <div class="card mb-3">
            <div class="card-header">
                {{ __('Round information') }}
            </div>
            <div class="card-body">
                {{ $round->round_text }}
            </div>
        </div>
    @endif

    @php($matches = collect($round->matches()->with(['team1', 'team2', 'ffaParticipants', 'round', 'staff', 'staff.user'])
        ->orderBy('timestamp')->get())->groupBy(function ($item) {
        return $item->timestamp->format('d-M-y');
    }))

    <x-matches.list :matches="$matches" :tournament="$tournament" :qualifiers="$qualifiers"/>

    @if($round->mappool_visible)
        <div class="mappools mt-3">
            <div class="d-flex justify-content-between align-items-center round-name">
                <div class="d-flex align-items-center"><span></span>{{ __('Maps') }}</div>
                <div class="d-lg-flex d-md-flex d-sm-none d-none" style="gap: 10px;">
                    <div class="d-flex" style="gap: 10px;">
                        <a href="#" class="btn btn-primary btn-sm">{{ __('Download') }}</a>
                        <a href="#" class="btn btn-primary btn-sm">{{ __('Download In-Game') }}</a>
                    </div>
                </div>
            </div>

            <x-mappool.map-list :maps="$round->maps"/>
        </div>
    @endif
@endsection
