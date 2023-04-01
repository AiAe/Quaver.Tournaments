@php use App\Enums\TournamentStageFormat; @endphp
@extends('web.tournaments.parts.base')

@push('seo')
    {!! seo()->for($tournament) !!}
@endpush

@push('cover')
    <div class="col-lg-12">
        <header class="page-cover smaller">
            <h1>{{ __('Schedules') }}</h1>
        </header>
    </div>
@endpush

@section('section')
    @forelse(
        $tournament->stages()
            ->whereNot('stage_format', TournamentStageFormat::Registration)
            ->with('rounds', 'rounds.matches', 'rounds.matches.team1', 'rounds.matches.team2')
            ->get()
            ->flatMap
            ->rounds
        as $round
    )
        <div class="card mb-3">
            <div class="card-header">
                {{$round->name}}
            </div>

            <div class="card-body">
                @php($matches = collect($round->matches)->groupBy('timestamp'))

                <x-matches.list :matches="$matches" :class="'alt'"/>
            </div>
        </div>
    @empty
        <div class="card">
            No schedules...
        </div>
    @endforelse
@endsection
