@extends('web.tournaments.parts.base')

@push('cover')
    <div class="col-lg-12">
        <header class="page-cover smaller">
            <h1>{{ $team->name }}</h1>
        </header>
    </div>
@endpush

@section('section')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                {{ __('Players') }}
            </div>
            {{--ToDo if team is full remove button--}}
            @can('update', $team)
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#tournamentTeamInvite">{{ __('Invite Player') }}</button>
                @push('modals')
                    @livewire('tournaments.team.invite', ['tournament_id' => $tournament->id, 'team_id' => $team->id], key($tournament))
                @endpush
            @endcan
        </div>

        <table class="table table-hover table-dark mb-0">
            <thead>
            <tr>
                <th style="width: 10%;">{{ __('Rank') }}</th>
                <th>{{ __('Player') }}</th>
                <th style="width: 20%;">{{ __('Status') }}</th>
                <th style="width: 20%">{{ __('Action') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($team->members as $member)
                <tr>
                    <td>-</td>
                    <td>{{ $member->username }}</td>
                    <td>
                        @if($member->pivot->is_captain)
                            {{ __('Captain') }}
                        @else
                            {{ __('Player') }}
                        @endif
                    </td>
                    <td>
                        @can('update', $team)
                            @livewire('tournaments.team.player-actions', ['team' => $team, 'user' => $member], key($member))
                        @endcan
                    </td>
                </tr>
            @endforeach

            @foreach($team->invites as $invite)
                <tr>
                    <td>-</td>
                    <td>{{ $invite->username }}</td>
                    <td>{{ __('Pending Invite') }}</td>
                    <td>
                        @can('update', $team)
                            @livewire('tournaments.team.player-actions', ['team' => $team, 'user' => $invite], key($member))
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
