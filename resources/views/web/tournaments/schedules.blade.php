@php use App\Enums\TournamentStageFormat; @endphp
@extends('web.tournaments.parts.base')

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
                @php($matches = collect($round->matches()->with(['team1', 'team2'])->orderBy('timestamp')->get())->groupBy('timestamp'))

                <x-matches.list :matches="$matches" :class="'alt'"/>
            </div>
        </div>
    @empty
        <div class="card">
            No schedules...
        </div>
    @endforelse
@endsection
