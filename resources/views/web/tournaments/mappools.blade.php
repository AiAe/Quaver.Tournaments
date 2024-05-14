@php use App\Enums\TournamentStageFormat; @endphp
@extends('web.tournaments.parts.base')

@push('seo')
    {!! seo()->for(new \RalphJSmit\Laravel\SEO\Support\SEOData(title: __('Mappools') . " :: " . $tournament->name)) !!}
@endpush

@push('cover')
    <div class="col-lg-12">
        <header class="page-cover smaller">
            <h1>{{ __('Mappools') }}</h1>
        </header>
    </div>
@endpush

@section('section')
    @forelse(
        $tournament->stages()
            ->whereNot('stage_format', TournamentStageFormat::Registration)
            ->with(['rounds', 'rounds.maps', 'rounds.maps.map'])
            ->get()
            ->flatMap
            ->rounds
        as $round
    )
        @if(($loggedUser && $loggedUser->can('updateMappool', [$tournament, $round])) || $round->mappool_visible == 1)
            <div class="mappools">
                <div class="d-flex justify-content-between align-items-center round-name position-relative">
                    <div class="d-flex align-items-center"><span></span>{{ $round->name }}</div>
                    <div class="d-flex" style="gap: 10px;">
                        <x-mappool.mappool-actions :tournament="$tournament"
                                                   :round="$round"></x-mappool.mappool-actions>
                        <div>
                            <a data-bs-toggle="collapse" href="#mapsCollapse{{ $loop->index }}" role="button"
                               aria-expanded="false" aria-controls="mapsCollapse{{ $loop->index }}" class="stretched-link">
                                <i class="bi bi-chevron-down"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="collapse" id="mapsCollapse{{ $loop->index }}">
                    <x-mappool.map-list :maps="$round->maps"/>
                </div>
            </div>
        @endif
    @empty
        <div class="card">
            <div class="card-body text-center">
                {{ __('No mappools...') }}
            </div>
        </div>
    @endforelse
@endsection
