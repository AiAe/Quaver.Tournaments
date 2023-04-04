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
                        <th>{{ __('Team name') }}</th>
                    @else
                        {{-- TODO: Add country flag --}}
                        {{-- <th>{{ __('Country') }}</th> --}}
                        <th>{{ __('Player name') }}</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($tournament->teams as $team)
                    @if($tournament->format == \App\Enums\TournamentFormat::Team)
                        <tr data-route="{{ route('web.tournaments.teams.show', ['tournament' => $tournament, 'team' => $team]) }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $team->name }}</td>
                        </tr>
                    @else
                        @php($captain = $team->captain)
                        <tr data-route="{{ $captain->quaverUrl() }}">
                            <td>{{ $loop->index + 1 }}</td>
                            {{-- TODO: Add country flag --}}
                            {{-- <td>{{ $captain->country }}</td> --}}
                            <td>{{ $captain->username }}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
