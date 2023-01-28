@extends('web.tournaments.parts.base')

@section('section')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="mb-0">{{ __('My Team') }}</h1>
            </div>
            <div>
                {{--ToDo if team is full remove button--}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tournamentTeamInvite">{{ __('Invite Player') }}</button>
                @push('modals')
                    <livewire:tournament.team.invite wire:key="{{ key('tournamentTeamInvite') }}"
                                                     :tournament_id="$tournament->id"></livewire:tournament.team.invite>
                @endpush
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
                    <tr>
                        <td>1</td>
                        <td>AiAe</td>
                        <td>Accepted</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>IceDynamix</td>
                        <td>Pending</td>
                        <td><i class="bi bi-x"></i></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
