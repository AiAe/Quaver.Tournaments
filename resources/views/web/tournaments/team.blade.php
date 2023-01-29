@extends('web.tournaments.parts.base')

@section('section')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="mb-0">{{ __('My Team') }}</h1>
            </div>
            <div>
                {{--ToDo if team is full remove button--}}
                @if($team->captain()->is($loggedUser))
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#tournamentTeamInvite">{{ __('Invite Player') }}</button>
                    @push('modals')
                        <livewire:tournament.team.invite wire:key="{{ key('tournamentTeamInvite') }}"
                                                         :tournament_id="$tournament->id"></livewire:tournament.team.invite>
                    @endpush
                @endif
            </div>
        </div>

        <div class="mt-3">
            <div class="card">
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
                            <td>1</td>
                            <td>{{ $member->username }}</td>
                            <td>
                                @if($member->pivot->is_captain)
                                    {{ __('Captain') }}
                                @else
                                    {{ __('Player') }}
                                @endif
                            </td>
                            <td>
                                @if(!$member->pivot->is_captain && $team->captain()->is($loggedUser))
                                    <button class="btn btn-danger btn-sm">{{ __('Remove') }}</button>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @foreach($team->invites as $invite)
                        <tr>
                            <td>-</td>
                            <td>{{ $invite->username }}</td>
                            <td>{{ __('Pending Invite') }}</td>
                            <td>
                                @if($team->captain()->is($loggedUser))
                                    <button class="btn btn-danger btn-sm">{{ __('Remove') }}</button>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
