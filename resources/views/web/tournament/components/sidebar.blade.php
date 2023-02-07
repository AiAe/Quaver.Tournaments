<div class="list-group mb-2">
    <a href="{{ route('web.tournaments.show', $tournament) }}"
       class="list-group-item {{ routeIs('web.tournaments.show') }}">
        <i class="bi bi-info-square-fill"></i>
        {{ __('Information') }}
    </a>
    <a href="{{ route('web.tournaments.rules.show', $tournament) }}"
       class="list-group-item {{ routeIs('web.tournaments.rules.show') }}">
        <i class="bi bi-hammer"></i>
        {{ __('Rules') }}
    </a>
</div>


@can('create', [\App\Models\Team::class, $tournament])
    <div class="list-group mb-2">
        <a class="list-group-item" href="#tournamentRegister" data-bs-toggle="modal"
           data-bs-target="#tournamentRegister">
            <i class="bi bi-box-arrow-right"></i>
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
                <i class="bi bi-people"></i>
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
            <i class="bi bi-controller"></i>
            {{ __('Teams') }}
        </a>
    @else
        <a href="{{ route('web.tournaments.teams.index', ['tournament' => $tournament]) }}"
           class="list-group-item {{ routeIs('web.tournaments.teams.index') }}">
            <i class="bi bi-controller"></i>
            {{ __('Players') }}
        </a>
    @endif
</div>

<div class="list-group mb-2">
    <a href="#" class="list-group-item">
        <i class="bi bi-music-note-beamed"></i>
        {{ __('Mappool') }}
    </a>
    <a href="#" class="list-group-item">
        <i class="bi bi-journal"></i>
        {{ __('Bracket') }}
    </a>
    <a href="#" class="list-group-item">
        <i class="bi bi-calendar"></i>
        {{ __('Schedules') }}
    </a>
</div>

<div class="list-group mb-2">
    <a href="#" class="list-group-item">
        <i class="bi bi-globe"></i>
        {{ __('Suggest Maps') }}
    </a>
    <a href="#" class="list-group-item">
        <i class="bi bi-shield-fill"></i>
        {{ __('Apply for Staff') }}
    </a>
</div>

<div class="list-group mb-2">
    <a href="#" class="list-group-item">
        <i class="bi bi-people-fill"></i>
        {{ __('Staff') }}
    </a>
</div>

@can('update', $tournament)
    <div class="list-group">
        <a href="#" class="list-group-item">
            <i class="bi bi-wrench"></i>
            {{ __('Settings') }}
        </a>
    </div>
@endcan
