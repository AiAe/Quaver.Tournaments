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
            ->with('rounds', 'rounds.matches', 'rounds.matches.team1', 'rounds.matches.team2', 'rounds.stage',
            'rounds.matches.ffaParticipants', 'rounds.matches.round')
            ->get()
            ->flatMap
            ->rounds
            ->filter(fn ($round) => $round)
        as $round
    )
        <div class="card mb-3">
            <div class="card-header">
                {{$round->name}}
            </div>

            <div class="card-body">
                @php($matches = collect($round->matches)->groupBy(function ($item) {
                    return $item->timestamp->format('d-M-y');
                }))

                <x-matches.list :matches="$matches" :class="'alt'"
                                :tournament="$tournament"
                                :qualifiers="($round->stage->stage_format == TournamentStageFormat::Qualifier)"/>
            </div>
        </div>
    @empty
        <div class="card">
            No schedules...
        </div>
    @endforelse
@endsection
