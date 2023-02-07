@extends('web.tournament.parts.base')

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
                    <th>
                        {{ __('Team name') }}
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
@endsection
