@extends('web.tournaments.parts.base')

@section('section')
    <header class="py-5">
        @if($tournament->format == \App\Enums\TournamentFormat::Team)
            <h1>{{ __('Teams') }}</h1>
        @else
            <h1>{{ __('Players') }}</h1>
        @endif
    </header>

    <div class="container mt-3">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover table-dark table-link">
                    <thead>
                    <tr>
                        <th style="width: 10%;">{{ __('#') }}</th>
                        <th>
                            @if($tournament->format == \App\Enums\TournamentFormat::Team)
                                {{ __('Team') }}
                            @else
                                {{ __('Player') }}
                            @endif
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tournament->teams as $team)
                        <tr data-route="{{ route('web.tournaments.teams.show', ['tournament' => $tournament->slug, 'team' => $team->slug]) }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $team->name }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
