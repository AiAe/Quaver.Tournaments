@extends('web.tournaments.parts.base')

@push('seo')
    {!! seo()->for($tournament) !!}
@endpush

@push('cover')
    <div class="col-lg-12">
        <header class="page-cover smaller">
            <h1>{{ $title }}</h1>
        </header>
    </div>
@endpush

@section('section')
    <div class="card">
        <div class="card-header">
            {{ $title }}
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-dark table-link">
                <thead>
                <tr>
                    <th style="width: 10%;">{{ __('#') }}</th>
                    @if($tournament->format == \App\Enums\TournamentFormat::Team)
                        <th>{{ __('Team Name') }}</th>
                        <th>{{ __('Team Rank (avg.)') }}</th>
                    @else
                        {{-- TODO: Add country flag --}}
                        {{-- <th>{{ __('Country') }}</th> --}}
                        <th>{{ __('Player') }}</th>
                        <th>{{ __('Player Rank') }}</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($teams as $team)
                    @if($tournament->format == \App\Enums\TournamentFormat::Team)
                        <tr data-route="{{ route('web.tournaments.teams.show', ['tournament' => $tournament, 'team' => $team]) }}">
                            <td>{{ $loop->iteration + $teams->firstItem() - 1 }}</td>
                            <td>{{ $team->name }}</td>
                            <td>#{{ $team->teamRank?->{$tournament->mode->rankColumnName()} }}</td>
                        </tr>
                    @else
                        @php($captain = $team->captain())
                        <tr data-route="{{ $captain->quaverUrl() }}">
                            <td>{{ $loop->iteration + $teams->firstItem() - 1 }}</td>
                            {{-- TODO: Add country flag --}}
                            {{-- <td>{{ $captain->country }}</td> --}}
                            <td>{{ $captain->username }}</td>
                            <td>#{{ $captain->{$tournament->mode->rankColumnName()} }}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if($teams->hasPages())
        <div class="card mt-3 p-2">
            {{ $teams->links() }}
        </div>
    @endif
@endsection
