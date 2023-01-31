@extends('web.tournaments.parts.base')

@section('section')
    <header class="py-5">
        <h1>{{ $title }}</h1>
    </header>

    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                {{ $title }}
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-dark table-link">
                    <thead>
                    <tr>
                        <th style="width: 10%;">{{ __('#') }}</th>
                        <th>
                            {{ $title }}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tournament->teams as $team)
                        <tr data-route="{{ route('web.tournaments.teams.show', ['tournament' => $tournament, 'team' => $team]) }}">
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
