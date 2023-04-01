@php use App\Enums\TournamentStageFormat; @endphp
@extends('web.tournaments.parts.base')

@push('seo')
    {!! seo()->for($tournament) !!}
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
            ->with(['rounds.maps.map'])
            ->get()
            ->flatMap
            ->rounds
        as $round
    )
        <div class="mappools">
            <div class="d-flex justify-content-between align-items-center round-name">
                <div class="d-flex align-items-center"><span></span>{{ $round->name }}</div>
                <div class="d-flex" style="gap: 10px;">
                    <div class="d-flex mapset-links" style="gap: 10px;">
                        <a href="#" class="btn btn-primary btn-sm">{{ __('Download') }}</a>
                        <a href="#" class="btn btn-primary btn-sm">{{ __('Download In-Game') }}</a>
                    </div>
                    <div>
                        <a data-bs-toggle="collapse" href="#mapsCollapse{{ $loop->index }}" role="button"
                           aria-expanded="false" aria-controls="mapsCollapse{{ $loop->index }}">
                            <i class="bi bi-chevron-down"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="collapse" id="mapsCollapse{{ $loop->index }}">
                <x-mappool.map-list :maps="$round->maps"/>
            </div>
        </div>
    @empty
        <div class="card">
            {{ __('No mappools...') }}
        </div>
    @endforelse
@endsection
