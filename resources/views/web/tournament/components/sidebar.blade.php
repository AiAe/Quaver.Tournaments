<div class="list-group mb-2">
    <a href="{{ route('web.tournaments.show', $tournament) }}"
       class="list-group-item {{ routeIs('web.tournaments.show') }}">
        {{ __('Information') }}
    </a>
    <a href="{{ route('web.tournaments.rules.show', $tournament) }}"
       class="list-group-item {{ routeIs('web.tournaments.rules.show') }}">
        {{ __('Rules') }}
    </a>
    <a href="#" class="list-group-item">
        {{ __('Staff') }}
    </a>
</div>

@can('create', [\App\Models\Team::class, $tournament])
    <div class="list-group mb-2">
        <a class="list-group-item" href="#tournamentRegister" data-bs-toggle="modal"
           data-bs-target="#tournamentRegister">
            {{ __('Register') }}
        </a>
    </div>
    @push('modals')
        @livewire('tournament.register', ['tournament' => $tournament], key($tournament))
    @endpush
@endcan
@auth()
    @php($team = $loggedUser->teams()->firstWhere('tournament_id', $tournament->id))
    @if($team && $tournament->format == TournamentFormat::Team)
        <div class="list-group mb-2">
            <a class="list-group-item {{ routeIs('web.tournaments.teams.show') }}"
               href="{{ route('web.tournaments.teams.show', ['tournament' => $tournament, 'team' => $team]) }}">
                {{ __('My Team') }}
            </a>
        </div>
    @endif
@endauth
@guest()
    <div class="list-group mb-2">
        <a class="list-group-item" href="{{route('web.auth.oauth', 'quaver')}}">
            <i class="bi bi-box-arrow-right"></i>
            {{ __('Register') }}
        </a>
    </div>
@endguest

<div class="list-group mb-2">
    @if($tournament->format == TournamentFormat::Team)
        <a href="{{ route('web.tournaments.teams.index', ['tournament' => $tournament]) }}"
           class="list-group-item {{ routeIs('web.tournaments.teams.index') }}">
            {{ __('Teams') }}
        </a>
    @else
        <a href="{{ route('web.tournaments.teams.index', ['tournament' => $tournament]) }}"
           class="list-group-item {{ routeIs('web.tournaments.teams.index') }}">
            {{ __('Players') }}
        </a>
    @endif
</div>

<div class="list-group mb-2">
    <a href="#" class="list-group-item">
        {{ __('Stages') }}
    </a>
    <a href="#" class="list-group-item">
        {{ __('Mappool') }}
    </a>
{{--    <a href="#" class="list-group-item">--}}
{{--        <i class="bi bi-journal"></i>--}}
{{--        {{ __('Bracket') }}--}}
{{--    </a>--}}
{{--    <a href="#" class="list-group-item">--}}
{{--        {{ __('Schedules') }}--}}
{{--    </a>--}}
</div>

<div class="list-group mb-2">
{{--    <a href="#" class="list-group-item">--}}
{{--        {{ __('Suggest Maps') }}--}}
{{--    </a>--}}
    <a href="#" class="list-group-item">
        {{ __('Apply for Staff') }}
    </a>
</div>

@can('update', $tournament)
    <div class="list-group">
        <a href="#" class="list-group-item">
            {{ __('Settings') }}
        </a>
    </div>
@endcan
