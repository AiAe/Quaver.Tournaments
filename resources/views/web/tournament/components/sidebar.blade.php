@php use App\Enums\TournamentFormat; @endphp
<aside class="sidebar-menu d-flex flex-column flex-shrink-0 text-white bg-dark">
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a href="{{ route('web.tournaments.show', $tournament) }}"
               class="nav-link {{ routeIs('web.tournaments.show') }}">
                <i class="bi bi-info-square-fill"></i>
                {{ __('Information') }}
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('web.tournaments.rules.show', $tournament) }}"
               class="nav-link {{ routeIs('web.tournaments.rules.show') }}">
                <i class="bi bi-hammer"></i>
                {{ __('Rules') }}
            </a>
        </li>

        <hr>

        @auth()
            @php($team = $loggedUser->teams()->firstWhere('tournament_id', $tournament->id))
            @if($team == null)
                <li class="nav-item">
                    <a class="nav-link" href="#tournamentRegister" data-bs-toggle="modal"
                       data-bs-target="#tournamentRegister">
                        <i class="bi bi-box-arrow-right"></i>
                        {{ __('Register') }}
                    </a>
                </li>
                <hr>
                @push('modals')
                    @livewire('tournament.register', ['tournament' => $tournament], key($tournament))
                @endpush
            @elseif($tournament->format == TournamentFormat::Team)
                <li class="nav-item">
                    <a class="nav-link {{ routeIs('web.tournaments.teams.show') }}"
                       href="{{ route('web.tournaments.teams.show', ['tournament' => $tournament, 'team' => $team]) }}">
                        <i class="bi bi-people"></i>
                        {{ __('My Team') }}
                    </a>
                </li>
                <hr>
            @endif
        @endauth
        @guest()
            <li class="nav-item">
                <a class="nav-link" href="{{route('web.auth.oauth', 'quaver')}}">
                    <i class="bi bi-box-arrow-right"></i>
                    {{ __('Register') }}
                </a>
            </li>
            <hr>
        @endguest
        <li class="nav-item">
            @if($tournament->format == TournamentFormat::Team)
                <a href="{{ route('web.tournaments.teams.index', ['tournament' => $tournament]) }}"
                   class="nav-link {{ routeIs('web.tournaments.teams.index') }}">
                    <i class="bi bi-controller"></i>
                    {{ __('Teams') }}
                </a>
            @else
                <a href="#" class="nav-link">
                    <i class="bi bi-controller"></i>
                    {{ __('Players') }}
                </a>
            @endif
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-music-note-beamed"></i>
                {{ __('Mappool') }}
            </a>
        </li>
        <hr>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-journal"></i>
                {{ __('Bracket') }}
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-calendar"></i>
                {{ __('Schedules') }}
            </a>
        </li>
        <hr>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-globe"></i>
                {{ __('Suggest Maps') }}
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-shield-fill"></i>
                {{ __('Apply for Staff') }}
            </a>
        </li>
        <hr>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-people-fill"></i>
                {{ __('Staff') }}
            </a>
        </li>
        <hr>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-wrench"></i>
                {{ __('Settings') }}
            </a>
        </li>
    </ul>
</aside>
